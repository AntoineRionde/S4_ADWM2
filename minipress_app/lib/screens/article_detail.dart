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
        backgroundColor: const Color.fromARGB(255, 52, 54, 51),
        title: Text(widget.article.title!),
        centerTitle: true,
      ),
      body: Center(
          child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          const Text("Résumé : \n",
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 20)),
          Text(
            markdown.markdownToHtml(widget.article.resume!),
            textAlign: TextAlign.center,
          ),
          const Text("Contenu : \n ",
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 20)),
          Text(markdown.markdownToHtml(widget.article.contenu!),
              textAlign: TextAlign.center),
          const Text("\n \n Date de création : ",
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 15)),
          Text(widget.article.dateCreation!.toString().substring(0, 10)),
          const Text("\n Auteur : ",
              style: TextStyle(fontWeight: FontWeight.bold, fontSize: 15)),
          Text(widget.article.auteur!),
        ],
      )),

      // body: Container(
      //     child: Html(
      //   data: markdown.markdownToHtml(widget.article.contenu!),
      // )),
    );
  }
}
