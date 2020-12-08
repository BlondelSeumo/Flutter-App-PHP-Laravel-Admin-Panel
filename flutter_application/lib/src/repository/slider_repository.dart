import 'dart:convert';

import 'package:http/http.dart' as http;

import '../helpers/custom_trace.dart';
import '../helpers/helper.dart';
import '../models/slide.dart';

Future<Stream<Slide>> getSlides() async {
  Uri uri = Helper.getUri('api/slides');
  Map<String, dynamic> _queryParams = {
    'with': 'food;restaurant',
    'search': 'enabled:1',
    'orderBy': 'order',
    'sortedBy': 'asc',
  };
  uri = uri.replace(queryParameters: _queryParams);
  try {
    final client = new http.Client();
    final streamedRest = await client.send(http.Request('get', uri));

    return streamedRest.stream
        .transform(utf8.decoder)
        .transform(json.decoder)
        .map((data) => Helper.getData(data))
        .expand((data) => (data as List))
        .map((data) => Slide.fromJSON(data));
  } catch (e) {
    print(CustomTrace(StackTrace.current, message: uri.toString()).toString());
    return new Stream.value(new Slide.fromJSON({}));
  }
}
