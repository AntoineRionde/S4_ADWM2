import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/models/categorie.dart';
import 'package:minipress_app/screens/article_preview.dart';
import 'package:minipress_app/screens/categorie_provider.dart';

class ArticleCategorie extends StatefulWidget {
  Categorie categorie;

  List<Article> articles = [];

  ArticleCategorie({Key? key, required this.categorie}) : super(key: key);

  @override
  State<ArticleCategorie> createState() => _ArticleCategorieState();
}

class _ArticleCategorieState extends State<ArticleCategorie> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.categorie.titre!),
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
                          child: ListView(
                        children: articlePreview,
                      )),
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
