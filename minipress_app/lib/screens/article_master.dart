import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_preview.dart';
import 'package:minipress_app/screens/categorie_master.dart';
import 'package:provider/provider.dart';
import 'package:minipress_app/screens/article_provider.dart';

class ArticleMaster extends StatefulWidget {
  ArticleMaster({Key? key}) : super(key: key);

  @override
  State<ArticleMaster> createState() => _ArticleMasterState();

  List<Article> articles = <Article>[];
}

class _ArticleMasterState extends State<ArticleMaster> {
  // final Future<String> _calculation = Future<String>.delayed(
  //   const Duration(seconds: 2),
  //   () => 'Data Loaded',
  // );

  Future<List<Article>> _fetchArticles() async {
    if (widget.articles.isNotEmpty) {
      return Future<List<Article>>.value(widget.articles);
    }
    final articlesProvider =
        Provider.of<ArticleProvider>(context, listen: false);

    return articlesProvider.getArticles();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: <Widget>[
          Expanded(
            child: FutureBuilder<List<Article>>(
              future: ArticleProvider().getArticles(),
              builder: (BuildContext context,
                  AsyncSnapshot<List<Article>> snapshot) {
                if (snapshot.hasData) {
                  widget.articles = snapshot.data!;
                  // print(widget.articles);
                  final List<ArticlePreview> articlePreview =
                      snapshot.data!.map((article) {
                    return ArticlePreview(article: article);
                  }).toList();
                  return Column(
                    children: [
                      Expanded(
                        child: ListView(
                          children: articlePreview,
                        ),
                      ),
                    ],
                  );
                } else {
                  return const Text("Chargement en cours");
                }
              },
            ),
          ),
          // FloatingActionButton(onPressed: () {
          //   Navigator.of(context)
          //       .push(MaterialPageRoute(builder: (context) => CategorieMaster()));
          // }),
          FloatingActionButton(
              onPressed: () async {
                await Navigator.of(context).push(
                    MaterialPageRoute(builder: (context) => CategorieMaster()));
                setState(() {});
              },
              child: const Text("Catégories")),
        ],
      ),
    );
  }
}
