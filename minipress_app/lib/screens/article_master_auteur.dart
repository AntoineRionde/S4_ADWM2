import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_preview.dart';
import 'package:minipress_app/screens/article_provider.dart';

class ArticleMasterAuteur extends StatefulWidget {
  final int? auteurId;
  List<Article> articles = [];

  final ScrollController _scrollController = ScrollController();

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
        backgroundColor: const Color.fromARGB(255, 52, 54, 51),
        centerTitle: true,
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
                          child: Scrollbar(
                              thumbVisibility: true,
                              controller: widget._scrollController,
                              child: ListView(
                                controller: widget._scrollController,
                                children: articlePreview,
                              ))),
                    ],
                  );
                } else {
                  return const Text("Chargement en cours");
                }
              },
            ),
          ),
        ],
      ),
    );
  }
}
