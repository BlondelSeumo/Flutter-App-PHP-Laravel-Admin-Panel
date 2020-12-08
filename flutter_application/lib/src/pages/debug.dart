import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import 'package:mvc_pattern/mvc_pattern.dart';

import '../controllers/favorite_controller.dart';
import '../elements/CircularLoadingWidget.dart';
import '../models/route_argument.dart';

class DebugWidget extends StatefulWidget {
  final RouteArgument routeArgument;

  DebugWidget({Key key, this.routeArgument}) : super(key: key);

  @override
  _DebugWidgetState createState() {
    return _DebugWidgetState();
  }
}

class _DebugWidgetState extends StateMVC<DebugWidget> {
  FavoriteController _con;

  _DebugWidgetState() : super(FavoriteController()) {
    _con = controller;
  }

  @override
  void initState() {
    //_con.listenForTrendingFoods();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        key: _con.scaffoldKey,
        appBar: AppBar(
          backgroundColor: Colors.transparent,
          elevation: 0,
          centerTitle: true,
          title: Text(
            'Debug',
            style: Theme.of(context).textTheme.headline6.merge(TextStyle(letterSpacing: 1.3)),
          ),
          actions: <Widget>[
            IconButton(
              icon: Icon(Icons.my_location),
              onPressed: () {},
            )
          ],
        ),
        floatingActionButtonLocation: FloatingActionButtonLocation.endFloat,
        body: RefreshIndicator(
          onRefresh: _con.refreshFavorites,
          child: _con.favorites.isEmpty
              ? CircularLoadingWidget(height: 500)
              : ListView.separated(
                  scrollDirection: Axis.vertical,
                  shrinkWrap: true,
                  primary: false,
                  itemCount: _con.favorites.length,
                  separatorBuilder: (context, index) {
                    return SizedBox(height: 10);
                  },
                  itemBuilder: (context, index) {
                    return ListTile(
                      title: Text(_con.favorites.elementAt(index).food.name),
                    );
                  },
                ),
        ));
  }
}
