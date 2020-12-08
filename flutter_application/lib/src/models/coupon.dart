import 'discountable.dart';

class Coupon {
  String id;
  String code;
  double discount;
  String discountType;
  List<Discountable> discountables;
  String discountableId;
  bool enabled;

  bool valid;

  Coupon();

  Coupon.fromJSON(Map<String, dynamic> jsonMap) {
    try {
      id = jsonMap['id'] != null ? jsonMap['id'].toString() : null;
      code = jsonMap['code'] != null ? jsonMap['code'].toString() : '';
      discount = jsonMap['discount'] != null ? jsonMap['discount'].toDouble() : 0.0;
      discountType = jsonMap['discount_type'] != null ? jsonMap['discount_type'].toString() : null;
      discountables = jsonMap['discountables'] != null ? List.from(jsonMap['discountables']).map((element) => Discountable.fromJSON(element)).toList() : [];
      valid = jsonMap['valid'];
    } catch (e) {
      id = '';
      code = '';
      discount = 0.0;
      discountType = '';
      discountables = [];
      valid = null;
    }
  }

  Map toMap() {
    var map = new Map<String, dynamic>();
    map["id"] = id;
    map["code"] = code;
    map["discount"] = discount;
    map["discount_type"] = discountType;
    map["valid"] = valid;
    map["discountables"] = discountables.map((element) => element.toMap()).toList();

    return map;
  }

  @override
  bool operator ==(dynamic other) {
    return other.id == this.id;
  }

  @override
  int get hashCode => this.id.hashCode;
}
