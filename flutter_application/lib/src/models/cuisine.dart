import '../helpers/custom_trace.dart';
import '../models/media.dart';

class Cuisine {
  String id;
  String name;
  String description;
  Media image;
  bool selected;

  Cuisine();

  Cuisine.fromJSON(Map<String, dynamic> jsonMap) {
    try {
      id = jsonMap['id'].toString();
      name = jsonMap['name'];
      description = jsonMap['description'];
      image = jsonMap['media'] != null && (jsonMap['media'] as List).length > 0 ? Media.fromJSON(jsonMap['media'][0]) : new Media();
      selected = jsonMap['selected'] ?? false;
    } catch (e) {
      id = '';
      name = '';
      description = '';
      image = new Media();
      selected = false;
      print(CustomTrace(StackTrace.current, message: e));
    }
  }

  Map<String, dynamic> toMap() {
    var map = new Map<String, dynamic>();
    map['id'] = id;
    return map;
  }

  @override
  bool operator ==(dynamic other) {
    return other.id == this.id;
  }

  @override
  int get hashCode => super.hashCode;
}
