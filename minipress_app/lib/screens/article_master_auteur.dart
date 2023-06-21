import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_master.dart';
import 'package:minipress_app/screens/article_preview.dart';
import 'package:minipress_app/screens/article_provider.dart';

class ArticleMasterAuteur extends StatefulWidget {
  final int? auteurId;
  List<Article> articles = [];

  ArticleMasterAuteur({Key? key, required this.auteurId}) : super(key: key);
  @override
  _ArticleMasterAuteurState createState() => _ArticleMasterAuteurState();
}

class _ArticleMasterAuteurState extends State<ArticleMasterAuteur> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("Articles de l'auteur sélectionné"),
      ),
      body: Column(
        children: <Widget>[
          Expanded(
            child: FutureBuilder<List<Article>>(
              future: ArticleProvider().getArticlesByAuteur(widget.auteurId!),
              builder: (BuildContext context,
                  AsyncSnapshot<List<Article>> snapshot) {
                if (snapshot.hasData) {
                  widget.articles = snapshot.data!;
                  final List<ArticlePreview> articlePreview =
                      snapshot.data!.map((article) {
                    return ArticlePreview(article: article);
                  }).toList();
                  return Column(
                    children: [
                      Expanded(
                          // child: Scrollbar(
                          child: ListView(
                        children: articlePreview,
                        // Les éléments de la ListView
                      )),
                      //     child: ListView(
                      //   children: articlePreview,
                      // )),
                    ],
                  );
                } else {
                  return const Text("Chargement en cours");
                }
              },
            ),
          ),
          // FloatingActionButton(
          //     onPressed: () async {
          //       await Navigator.of(context).push(
          //           MaterialPageRoute(builder: (context) => CategorieMaster()));
          //       setState(() {});
          //     },
          //     child: const Icon(Icons.category)),
        ],
      ),
    );
  }
}
