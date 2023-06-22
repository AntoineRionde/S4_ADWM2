import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/models/categorie.dart';
import 'package:minipress_app/screens/article_preview.dart';
import 'package:minipress_app/screens/categorie_provider.dart';

class ArticleMasterCategorie extends StatefulWidget {
  Categorie categorie;

  List<Article> articles = [];

  ScrollController _scrollController = ScrollController();

  ArticleMasterCategorie({Key? key, required this.categorie}) : super(key: key);

  @override
  State<ArticleMasterCategorie> createState() => _ArticleMasterCategorieState();
}

class _ArticleMasterCategorieState extends State<ArticleMasterCategorie> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.categorie.titre!),
        backgroundColor: const Color.fromARGB(255, 52, 54, 51),
        centerTitle: true,
      ),
      body: Column(
        children: <Widget>[
          Expanded(
            child: FutureBuilder<List<Article>>(
              future: CategorieProvider()
                  .getArticlesByCategorie(widget.categorie.id!),
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
