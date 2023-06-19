import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';

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
            Text("Resume : ${widget.article.resume!}"),
            Text("Contenu : ${widget.article.contenu!}"),
            const Text("\n"),
            Text(
                "Date de publication : ${widget.article.datePublication!.toString().substring(0, 10)}"),
            Text("Auteur : ${widget.article.auteur!}"),
          ],
        ),
      ),
    );
  }
}
