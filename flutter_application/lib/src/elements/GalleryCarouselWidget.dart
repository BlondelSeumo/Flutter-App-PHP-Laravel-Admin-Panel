import 'package:flutter/material.dart';

import '../elements/GalleryItemWidget.dart';
import '../models/gallery.dart';

class ImageThumbCarouselWidget extends StatefulWidget {
  final List<Gallery> galleriesList;

  ImageThumbCarouselWidget({Key key, this.galleriesList}) : super(key: key);

  @override
  _ImageThumbCarouselWidgetState createState() => _ImageThumbCarouselWidgetState();
}

class _ImageThumbCarouselWidgetState extends State<ImageThumbCarouselWidget> {
  @override
  Widget build(BuildContext context) {
    return widget.galleriesList.isEmpty
        ? SizedBox(height: 5)
        : Container(
            height: 200,
            child: ListView.builder(
              scrollDirection: Axis.horizontal,
              itemCount: widget.galleriesList.length,
              itemBuilder: (context, index) {
                return InkWell(
                  splashColor: Theme.of(context).accentColor.withOpacity(0.8),
                  highlightColor: Colors.transparent,
                  onTap: () {},
                  child: GalleryItemWidget(gallery: widget.galleriesList.elementAt(index)),
                );
              },
            ),
          );
  }
}
