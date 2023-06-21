import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:markdown/markdown.dart' as markdown;

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
        centerTitle: true,
      ),
      body: Center(
          child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          Text("Resume : ${markdown.markdownToHtml(widget.article.resume!)}"),
          Text("Contenu : ${markdown.markdownToHtml(widget.article.contenu!)}"),
          const Text("\n"),
          Text(
              "Date de création : ${widget.article.dateCreation!.toString().substring(0, 10)}"),
          Text("Auteur : ${widget.article.auteur!}"),
        ],
      )),

      // body: SingleChildScrollView(
      //     child: Html(
      //   data: markdown.markdownToHtml(widget.article.contenu!),
      //   style: {
      //     "body": Style(
      //       fontSize: const FontSize(18.0),
      //     ),
      //     "h1": Style(
      //       fontSize: const FontSize(24.0),
      //     ),
      //     "h2": Style(
      //       fontSize: const FontSize(22.0),
      //     ),
      //     "h3": Style(
      //       fontSize: const FontSize(20.0),
      //     ),
      //   },
      // )),
    );
  }
}
