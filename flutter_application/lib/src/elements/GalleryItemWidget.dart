import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';

import '../elements/CircularLoadingWidget.dart';
import '../models/gallery.dart';

class GalleryItemWidget extends StatelessWidget {
  final Gallery gallery;

  GalleryItemWidget({Key key, this.gallery}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return gallery == null
        ? CircularLoadingWidget(height: 200)
        : Container(
            width: 250,
            margin: EdgeInsets.only(left: 20, right: 20, top: 15, bottom: 20),
            decoration: BoxDecoration(
              boxShadow: [
                BoxShadow(color: Theme.of(context).accentColor.withOpacity(0.1), blurRadius: 15, offset: Offset(0, 5)),
              ],
            ),
            child: ClipRRect(
              borderRadius: BorderRadius.all(Radius.circular(5)),
              child: CachedNetworkImage(
                fit: BoxFit.cover,
                imageUrl: gallery.image.url,
                placeholder: (context, url) => Image.asset(
                  'assets/img/loading.gif',
                  fit: BoxFit.cover,
                ),
                errorWidget: (context, url, error) => Icon(Icons.error),
              ),
            ),
          );
  }
}
