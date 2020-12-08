import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import '../../generated/l10n.dart';
import '../elements/BlockButtonWidget.dart';
import '../helpers/app_config.dart' as config;

class MobileVerification extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final _ac = config.App(context);
    return Scaffold(
      body: Padding(
        padding: const EdgeInsets.all(40),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.stretch,
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            SizedBox(
              width: _ac.appWidth(100),
              child: Column(
                children: <Widget>[
                  Text(
                    'Verify Phone ',
                    style: Theme.of(context).textTheme.headline5,
                    textAlign: TextAlign.center,
                  ),
                  SizedBox(height: 10),
                  Text(
                    'Your phone and address book are used to connect. Call you to verify your phone Number',
                    style: Theme.of(context).textTheme.bodyText2,
                    textAlign: TextAlign.center,
                  ),
                ],
              ),
            ),
            SizedBox(height: 30),
            DropdownButtonHideUnderline(
              child: Container(
                decoration: ShapeDecoration(
                  shape: UnderlineInputBorder(
                    borderSide: BorderSide(color: Theme.of(context).focusColor.withOpacity(0.2)),
                  ),
                ),
                child: DropdownButton(
                  value: '+216',
                  elevation: 9,
                  onChanged: (value) {},
                  items: [
                    DropdownMenuItem(
                      value: '+213',
                      child: SizedBox(
                        width: _ac.appWidth(70), // for example
                        child: Text('(+213) - Algeria', textAlign: TextAlign.center),
                      ),
                    ),
                    DropdownMenuItem(
                      value: '+216',
                      child: SizedBox(
                        width: _ac.appWidth(70), // for example
                        child: Text('(+216) - Tunisia', textAlign: TextAlign.center),
                      ),
                    ),
                  ],
                ),
              ),
            ),
            SizedBox(height: 30),
            TextField(
              textAlign: TextAlign.center,
              decoration: new InputDecoration(
                enabledBorder: UnderlineInputBorder(
                  borderSide: BorderSide(color: Theme.of(context).focusColor.withOpacity(0.2)),
                ),
                focusedBorder: new UnderlineInputBorder(
                  borderSide: new BorderSide(
                    color: Theme.of(context).focusColor.withOpacity(0.5),
                  ),
                ),
                hintText: '+213 000 000 000',
              ),
            ),
            SizedBox(height: 80),
            new BlockButtonWidget(
              onPressed: () {
                Navigator.of(context).pushNamed('/MobileVerification2');
              },
              color: Theme.of(context).accentColor,
              text: Text(S.of(context).submit.toUpperCase(),
                  style: Theme.of(context).textTheme.headline6.merge(TextStyle(color: Theme.of(context).primaryColor))),
            ),
          ],
        ),
      ),
    );
  }
}
