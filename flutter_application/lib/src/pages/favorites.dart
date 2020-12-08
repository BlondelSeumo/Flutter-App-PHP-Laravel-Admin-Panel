import 'package:flutter/material.dart';
import 'package:mvc_pattern/mvc_pattern.dart';

import '../../generated/l10n.dart';
import '../controllers/favorite_controller.dart';
import '../elements/CircularLoadingWidget.dart';
import '../elements/FavoriteGridItemWidget.dart';
import '../elements/FavoriteListItemWidget.dart';
import '../elements/PermissionDeniedWidget.dart';
import '../elements/SearchBarWidget.dart';
import '../elements/ShoppingCartButtonWidget.dart';
import '../repository/user_repository.dart';

class FavoritesWidget extends StatefulWidget {
  @override
  _FavoritesWidgetState createState() => _FavoritesWidgetState();
}

class _FavoritesWidgetState extends StateMVC<FavoritesWidget> {
  String layout = 'grid';

  FavoriteController _con;

  _FavoritesWidgetState() : super(FavoriteController()) {
    _con = controller;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      key: _con.scaffoldKey,
      appBar: AppBar(
        leading: new IconButton(
          icon: new Icon(Icons.sort, color: Theme.of(context).hintColor),
          onPressed: () => Scaffold.of(context).openDrawer(),
        ),
        automaticallyImplyLeading: false,
        backgroundColor: Colors.transparent,
        elevation: 0,
        centerTitle: true,
        title: Text(
          S.of(context).favorites,
          style: Theme.of(context).textTheme.headline6.merge(TextStyle(letterSpacing: 1.3)),
        ),
        actions: <Widget>[
          new ShoppingCartButtonWidget(iconColor: Theme.of(context).hintColor, labelColor: Theme.of(context).accentColor),
        ],
      ),
      body: currentUser.value.apiToken == null
          ? PermissionDeniedWidget()
          : RefreshIndicator(
              onRefresh: _con.refreshFavorites,
              child: SingleChildScrollView(
                padding: EdgeInsets.symmetric(vertical: 10),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  mainAxisAlignment: MainAxisAlignment.start,
                  mainAxisSize: MainAxisSize.max,
                  children: <Widget>[
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 20),
                      child: SearchBarWidget(onClickFilter: (e) {
                        Scaffold.of(context).openEndDrawer();
                      }),
                    ),
                    SizedBox(height: 10),
                    Padding(
                      padding: const EdgeInsets.only(left: 20, right: 10),
                      child: ListTile(
                        contentPadding: EdgeInsets.symmetric(vertical: 0),
                        leading: Icon(
                          Icons.favorite,
                          color: Theme.of(context).hintColor,
                        ),
                        title: Text(
                          S.of(context).favorite_foods,
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                          style: Theme.of(context).textTheme.headline4,
                        ),
                        trailing: Row(
                          mainAxisSize: MainAxisSize.min,
                          children: <Widget>[
                            IconButton(
                              onPressed: () {
                                setState(() {
                                  this.layout = 'list';
                                });
                              },
                              icon: Icon(
                                Icons.format_list_bulleted,
                                color: this.layout == 'list' ? Theme.of(context).accentColor : Theme.of(context).focusColor,
                              ),
                            ),
                            IconButton(
                              onPressed: () {
                                setState(() {
                                  this.layout = 'grid';
                                });
                              },
                              icon: Icon(
                                Icons.apps,
                                color: this.layout == 'grid' ? Theme.of(context).accentColor : Theme.of(context).focusColor,
                              ),
                            )
                          ],
                        ),
                      ),
                    ),
                    _con.favorites.isEmpty
                        ? CircularLoadingWidget(height: 500)
                        : Offstage(
                            offstage: this.layout != 'list',
                            child: ListView.separated(
                              scrollDirection: Axis.vertical,
                              shrinkWrap: true,
                              primary: false,
                              itemCount: _con.favorites.length,
                              separatorBuilder: (context, index) {
                                return SizedBox(height: 10);
                              },
                              itemBuilder: (context, index) {
                                return FavoriteListItemWidget(
                                  heroTag: 'favorites_list',
                                  favorite: _con.favorites.elementAt(index),
                                );
                              },
                            ),
                          ),
                    _con.favorites.isEmpty
                        ? CircularLoadingWidget(height: 500)
                        : Offstage(
                            offstage: this.layout != 'grid',
                            child: GridView.count(
                              scrollDirection: Axis.vertical,
                              shrinkWrap: true,
                              primary: false,
                              crossAxisSpacing: 10,
                              mainAxisSpacing: 20,
                              padding: EdgeInsets.symmetric(horizontal: 20),
                              // Create a grid with 2 columns. If you change the scrollDirection to
                              // horizontal, this produces 2 rows.
                              crossAxisCount: MediaQuery.of(context).orientation == Orientation.portrait ? 2 : 4,
                              // Generate 100 widgets that display their index in the List.
                              children: List.generate(_con.favorites.length, (index) {
                                return FavoriteGridItemWidget(
                                  heroTag: 'favorites_grid',
                                  favorite: _con.favorites.elementAt(index),
                                );
                              }),
                            ),
                          )
                  ],
                ),
              ),
            ),
    );
  }
}
