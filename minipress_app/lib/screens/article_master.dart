import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_preview.dart';
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
    print('cc');
    if (widget.articles.isNotEmpty) {
      print("hey");
      return Future<List<Article>>.value(widget.articles);
    }
    print("cc2");
    final articlesProvider =
        Provider.of<ArticleProvider>(context, listen: false);
    print("ok");
    return articlesProvider.fetchArticles();
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: <Widget>[
        // FutureBuilder<String>(
        //     future: _calculation,
        //     builder: (BuildContext context, AsyncSnapshot<String> snapshot) {
        //       if (snapshot.connectionState == ConnectionState.waiting) {
        //         return const CircularProgressIndicator();
        //       } else if (snapshot.hasError) {
        //         return Text('${snapshot.error}');
        //       } else {
        //         return Container();
        //       }
        //     }),
        Expanded(
          child: FutureBuilder<List<Article>>(
            future: ArticleProvider().getArticles(),
            builder:
                (BuildContext context, AsyncSnapshot<List<Article>> snapshot) {
              if (snapshot.hasData) {
                widget.articles = snapshot.data!;
                print(widget.articles);
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
                return const Text('Chargement en cours');
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
        //     child: const Text("Catégories")),
      ],
    );
  }
}
