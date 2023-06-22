import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_preview.dart';
import 'package:provider/provider.dart';
import 'package:minipress_app/screens/article_provider.dart';

class ArticleMaster extends StatefulWidget {
  ArticleMaster({Key? key}) : super(key: key);

  final ScrollController _scrollController = ScrollController();
  String? keyword; // Variable pour stocker le mot-clé de recherche

  @override
  State<ArticleMaster> createState() => _ArticleMasterState();

  List<Article> articles = <Article>[];
  bool? sortAscending; // Variable pour stocker l'ordre de tri
}

class _ArticleMasterState extends State<ArticleMaster> {
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
              const SizedBox(width: 50),
              SizedBox(
                  width: 225,
                  child: TextField(
                    onChanged: (value) {
                      setState(() {
                        widget.keyword = value;
                      });
                    },
                    decoration: const InputDecoration(
                      labelText: 'Rechercher par titre ou résumé',
                    ),
                  )),
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

                  // Filtrage des articles en fonction du mot-clé
                  // List<Article> filteredArticles =
                  //     widget.articles.where((article) {
                  //   if (widget.keyword == null || widget.keyword!.isEmpty) {
                  //     return true; // Pas de mot-clé spécifié, afficher tous les articles
                  //   } else {
                  //     return article.title!
                  //         .toLowerCase()
                  //         .contains(widget.keyword!.toLowerCase());
                  //   }
                  // }).toList();

                  // Filtre des articles en fonction du mot-clé dans le titre ou le résumé
                  List<Article> filteredArticles =
                      widget.articles.where((article) {
                    if (widget.keyword == null || widget.keyword!.isEmpty) {
                      return true; // Pas de mot-clé spécifié, afficher tous les articles
                    } else {
                      String articleTitle = article.title!.toLowerCase();
                      String articleSummary =
                          article.resume?.toLowerCase() ?? "";
                      String searchKeyword = widget.keyword!.toLowerCase();
                      return articleTitle.contains(searchKeyword) ||
                          articleSummary.contains(searchKeyword);
                    }
                  }).toList();

                  final List<ArticlePreview> articlePreview =
                      filteredArticles.map((article) {
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
