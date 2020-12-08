import '../helpers/custom_trace.dart';
import '../models/media.dart';
import '../models/restaurant.dart';
import 'food.dart';

class Slide {
  String id;
  int order;
  String text;
  String button;
  String textPosition;
  String textColor;
  String buttonColor;
  String backgroundColor;
  String indicatorColor;
  Media image;
  String imageFit;
  Food food;
  Restaurant restaurant;
  bool enabled;

  Slide();

  Slide.fromJSON(Map<String, dynamic> jsonMap) {
    try {
      id = jsonMap['id'].toString();
      order = jsonMap['order'] != null ? jsonMap['order'] : 0;
      text = jsonMap['text'] != null ? jsonMap['text'].toString() : '';
      button = jsonMap['button'] != null ? jsonMap['button'].toString() : '';
      textPosition = jsonMap['text_position'] != null ? jsonMap['text_position'].toString() : '';
      textColor = jsonMap['text_color'] != null ? jsonMap['text_color'].toString() : '';
      buttonColor = jsonMap['button_color'] != null ? jsonMap['button_color'].toString() : '';
      backgroundColor = jsonMap['background_color'] != null ? jsonMap['background_color'].toString() : '';
      indicatorColor = jsonMap['indicator_color'] != null ? jsonMap['indicator_color'].toString() : '';
      imageFit = jsonMap['image_fit'] != null ? jsonMap['image_fit'].toString() : 'cover';
      enabled = jsonMap['enabled'] ?? false;
      restaurant = jsonMap['restaurant'] != null ? Restaurant.fromJSON(jsonMap['restaurant']) : Restaurant.fromJSON({});
      food = jsonMap['food'] != null ? Food.fromJSON(jsonMap['food']) : Food.fromJSON({});
      image = jsonMap['media'] != null && (jsonMap['media'] as List).length > 0 ? Media.fromJSON(jsonMap['media'][0]) : new Media();
    } catch (e) {
      id = '';
      order = 0;
      text = '';
      button = '';
      textPosition = '';
      textColor = '';
      buttonColor = '';
      backgroundColor = '';
      indicatorColor = '';
      imageFit = '';
      enabled = false;
      restaurant = Restaurant.fromJSON({});
      food = Food.fromJSON({});
      image = Media();
      print(CustomTrace(StackTrace.current, message: e));
    }
  }

  Map toMap() {
    var map = new Map<String, dynamic>();
    map["id"] = id;
    map["text"] = text;
    map["order"] = order;
    map["button"] = button;
    map["text_position"] = textPosition;
    map["text_color"] = textColor;
    map["button_color"] = buttonColor;
    return map;
  }

  @override
  bool operator ==(dynamic other) {
    return other.id == this.id;
  }

  @override
  int get hashCode => this.id.hashCode;
}
