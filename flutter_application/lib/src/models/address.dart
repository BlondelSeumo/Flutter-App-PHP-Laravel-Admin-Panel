import 'package:location/location.dart';

import '../helpers/custom_trace.dart';

class Address {
  String id;
  String description;
  String address;
  double latitude;
  double longitude;
  bool isDefault;
  String userId;

  Address();

  Address.fromJSON(Map<String, dynamic> jsonMap) {
    try {
      id = jsonMap['id'].toString();
      description = jsonMap['description'] != null ? jsonMap['description'].toString() : null;
      address = jsonMap['address'] != null ? jsonMap['address'] : null;
      latitude = jsonMap['latitude'] != null ? jsonMap['latitude'].toDouble() : null;
      longitude = jsonMap['longitude'] != null ? jsonMap['longitude'].toDouble() : null;
      isDefault = jsonMap['is_default'] ?? false;
    } catch (e) {
      print(CustomTrace(StackTrace.current, message: e));
    }
  }

  bool isUnknown() {
    return latitude == null || longitude == null || id == null || id == 'null';
  }

  Map toMap() {
    var map = new Map<String, dynamic>();
    map["id"] = id;
    map["description"] = description;
    map["address"] = address;
    map["latitude"] = latitude;
    map["longitude"] = longitude;
    map["is_default"] = isDefault;
    map["user_id"] = userId;
    return map;
  }

  LocationData toLocationData() {
    return LocationData.fromMap({
      "latitude": latitude,
      "longitude": longitude,
    });
  }
}
