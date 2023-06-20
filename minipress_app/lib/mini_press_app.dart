import 'package:flutter/material.dart';
import 'package:minipress_app/screens/article_master.dart';
import 'package:minipress_app/screens/categorie_master.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({Key? key}) : super(key: key);

  @override
  State<MiniPressApp> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'MiniPress app',
      theme: ThemeData(),
      home: Scaffold(
        appBar: AppBar(
          title: const Text('MiniPress app'),
        ),
        body: Column(children: [
          const Text("Liste des articles"),
          Expanded(child: ArticleMaster()),
          const Text("Liste des catégories"),
          Expanded(child: CategorieMaster()),
        ]),
      ),
    );
  }
}
