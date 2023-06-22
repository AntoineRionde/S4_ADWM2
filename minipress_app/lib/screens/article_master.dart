import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_preview.dart';
import 'package:provider/provider.dart';
import 'package:minipress_app/screens/article_provider.dart';

class ArticleMaster extends StatefulWidget {
  ArticleMaster({Key? key}) : super(key: key);

  final ScrollController _scrollController = ScrollController();
  @override
  State<ArticleMaster> createState() => _ArticleMasterState();

  List<Article> articles = <Article>[];
  bool? sortAscending; // Variable pour stocker l'ordre de tri
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
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                    backgroundColor: const Color.fromRGBO(3, 1, 81, 1)),
                onPressed: () {
                  setState(() {
                    widget.sortAscending = true;
                  });
                },
                child: const Text('Tri Ascendant'),
              ),
              const SizedBox(width: 10),
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                    backgroundColor: const Color.fromRGBO(3, 1, 81, 1)),
                onPressed: () {
                  setState(() {
                    widget.sortAscending = false;
                  });
                },
                child: const Text('Tri Descendant'),
              ),
            ],
          ),
          Expanded(
            child: FutureBuilder<List<Article>>(
              future: widget.sortAscending == null
                  ? ArticleProvider().getArticles()
                  : ArticleProvider().getArticlesByTri(widget.sortAscending!),
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
                              controller: widget._scrollController,
                              thumbVisibility: true,
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
