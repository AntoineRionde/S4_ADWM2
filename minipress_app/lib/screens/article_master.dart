import 'package:flutter/material.dart';
import 'package:minipress_app/models/Article.dart';

class ArticleMaster extends StatefulWidget {
  ArticleMaster({Key? key}) : super(key: key);

  @override
  State<ArticleMaster> createState() => _ArticleMasterState();

  final List<Article> articles = <Article>[];
}

class _ArticleMasterState extends State<ArticleMaster> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('MiniPress'),
      ),
      body: ListView.builder(
        itemCount: widget.articles.length,
        itemBuilder: (BuildContext context, int index) {
          return ListTile(
            title: Text(widget.articles[index].title!),
            subtitle: Text(widget.articles[index].resume!),
            onTap: () {
              Navigator.pushNamed(context, '/article',
                  arguments: widget.articles[index]);
            },
          );
        },
      ),
    );
  }
}
