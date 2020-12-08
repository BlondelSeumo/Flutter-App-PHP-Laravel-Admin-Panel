import 'package:mvc_pattern/mvc_pattern.dart';

import '../models/address.dart';
import '../models/food.dart';
import '../models/restaurant.dart';
import '../repository/food_repository.dart';
import '../repository/restaurant_repository.dart';
import '../repository/search_repository.dart';
import '../repository/settings_repository.dart';

class SearchController extends ControllerMVC {
  List<Restaurant> restaurants = <Restaurant>[];
  List<Food> foods = <Food>[];

  SearchController() {
    listenForRestaurants();
    listenForFoods();
  }

  void listenForRestaurants({String search}) async {
    if (search == null) {
      search = await getRecentSearch();
    }
    Address _address = deliveryAddress.value;
    final Stream<Restaurant> stream = await searchRestaurants(search, _address);
    stream.listen((Restaurant _restaurant) {
      setState(() => restaurants.add(_restaurant));
    }, onError: (a) {
      print(a);
    }, onDone: () {});
  }

  void listenForFoods({String search}) async {
    if (search == null) {
      search = await getRecentSearch();
    }
    Address _address = deliveryAddress.value;
    final Stream<Food> stream = await searchFoods(search, _address);
    stream.listen((Food _food) {
      setState(() => foods.add(_food));
    }, onError: (a) {
      print(a);
    }, onDone: () {});
  }

  Future<void> refreshSearch(search) async {
    setState(() {
      restaurants = <Restaurant>[];
      foods = <Food>[];
    });
    listenForRestaurants(search: search);
    listenForFoods(search: search);
  }

  void saveSearch(String search) {
    setRecentSearch(search);
  }
}
