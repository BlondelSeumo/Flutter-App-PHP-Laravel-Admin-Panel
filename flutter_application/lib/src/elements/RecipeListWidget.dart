import 'package:flutter/material.dart';

import '../elements/RecipeListItemWidget.dart';

class RecipeListWidget extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return ListView.separated(
      scrollDirection: Axis.vertical,
      shrinkWrap: true,
      primary: false,
      itemCount: 10,
      separatorBuilder: (context, index) {
        return SizedBox(height: 10);
      },
      itemBuilder: (context, index) {
        return RecipeListItemWidget();
      },
//      children: List.generate(3, (index) {
//        return RecipeListItemWidget();
//      }),
    );
  }
}
