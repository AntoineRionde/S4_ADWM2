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
          backgroundColor: const Color.fromARGB(255, 52, 54, 51),
          title: const Text('MiniPress app'),
          centerTitle: true,
        ),
        body: Column(children: [
          const Text("Liste des articles",
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 20)),
          const SizedBox(height: 15),
          Expanded(child: ArticleMaster()),
          const Text("Liste des catégories",
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 20)),
          Expanded(child: CategorieMaster()),
        ]),
      ),
    );
  }
}
