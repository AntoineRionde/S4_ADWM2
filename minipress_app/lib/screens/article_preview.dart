import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/screens/article_detail.dart';

class ArticlePreview extends StatefulWidget {
  final Article article;

  const ArticlePreview({Key? key, required this.article}) : super(key: key);

  @override
  State<ArticlePreview> createState() => _ArticlePreviewState();
}

class _ArticlePreviewState extends State<ArticlePreview> {
  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: Text(widget.article.title!),
      subtitle: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
              "Date de création : ${widget.article.dateCreation!.toString().substring(0, 10)}"),
          Text("Auteur : ${widget.article.auteur!}"),
        ],
      ),
      onTap: () {
        Navigator.of(context).push(MaterialPageRoute(
            builder: (context) => ArticleDetail(article: widget.article)));
      },
    );
  }
}
