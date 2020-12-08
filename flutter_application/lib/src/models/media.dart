import 'package:global_configuration/global_configuration.dart';

import '../helpers/custom_trace.dart';

class Media {
  String id;
  String name;
  String url;
  String thumb;
  String icon;
  String size;

  Media() {
    url = "${GlobalConfiguration().getValue('base_url')}images/image_default.png";
    thumb = "${GlobalConfiguration().getValue('base_url')}images/image_default.png";
    icon = "${GlobalConfiguration().getValue('base_url')}images/image_default.png";
  }

  Media.fromJSON(Map<String, dynamic> jsonMap) {
    try {
      id = jsonMap['id'].toString();
      name = jsonMap['name'];
      url = jsonMap['url'];
      thumb = jsonMap['thumb'];
      icon = jsonMap['icon'];
      size = jsonMap['formated_size'];
    } catch (e) {
      url = "${GlobalConfiguration().getValue('base_url')}images/image_default.png";
      thumb = "${GlobalConfiguration().getValue('base_url')}images/image_default.png";
      icon = "${GlobalConfiguration().getValue('base_url')}images/image_default.png";
      print(CustomTrace(StackTrace.current, message: e));
    }
  }

  Map toMap() {
    var map = new Map<String, dynamic>();
    map["id"] = id;
    map["name"] = name;
    map["url"] = url;
    map["thumb"] = thumb;
    map["icon"] = icon;
    map["formated_size"] = size;
    return map;
  }

  @override
  String toString() {
    return this.toMap().toString();
  }
}
