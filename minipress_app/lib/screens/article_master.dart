import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_preview.dart';
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
  final Future<String> _calculation = Future<String>.delayed(
    const Duration(seconds: 2),
    () => 'Data Loaded',
  );

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Column(
        children: <Widget>[
          FutureBuilder<String>(
              future: _calculation,
              builder: (BuildContext context, AsyncSnapshot<String> snapshot) {
                if (snapshot.connectionState == ConnectionState.waiting) {
                  return const CircularProgressIndicator();
                } else if (snapshot.hasError) {
                  return Text('${snapshot.error}');
                } else {
                  return Container();
                }
              }),
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
                  ? ArticleProvider().getArticlesByTri(
                      false) // Tri par défaut : ordre chronologique inverse
                  : ArticleProvider().getArticlesByTri(widget.sortAscending!),
              builder: (BuildContext context,
                  AsyncSnapshot<List<Article>> snapshot) {
                if (snapshot.hasData) {
                  widget.articles = snapshot.data!;

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
