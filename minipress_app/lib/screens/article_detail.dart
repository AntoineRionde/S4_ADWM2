import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:markdown/markdown.dart' as markdown;
import 'package:html/parser.dart';

class ArticleDetail extends StatefulWidget {
  final Article article;

  const ArticleDetail({Key? key, required this.article}) : super(key: key);

  @override
  State<ArticleDetail> createState() => _ArticleDetailState();
}

class _ArticleDetailState extends State<ArticleDetail> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.article.title!),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
                "Resume : ${parse(markdown.markdownToHtml(widget.article.resume!)).outerHtml}"),
            Text(
                "Contenu : ${parse(markdown.markdownToHtml(widget.article.contenu!)).outerHtml}"),
            const Text("\n"),
            Text(
                "Date de création : ${widget.article.dateCreation!.toString().substring(0, 10)}"),
            Text("Auteur : ${widget.article.auteur!}"),
          ],
        ),
      ),
    );
  }
}
