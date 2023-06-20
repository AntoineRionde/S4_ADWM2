import 'package:flutter/material.dart';
import 'package:minipress_app/models/categorie.dart';
import 'package:minipress_app/screens/article_categorie.dart';
import 'package:minipress_app/screens/categorie_detail.dart';

class CategoriePreview extends StatefulWidget {
  final Categorie categorie;

  const CategoriePreview({Key? key, required this.categorie}) : super(key: key);

  @override
  State<CategoriePreview> createState() => _CategoriePreviewState();
}

class _CategoriePreviewState extends State<CategoriePreview> {
  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: Text(widget.categorie.titre!),
      subtitle: Text(widget.categorie.description!),
      onTap: () {
        Navigator.of(context).push(MaterialPageRoute(
            builder: (context) =>
                ArticleCategorie(categorie: widget.categorie)));
      },
    );
  }
}
