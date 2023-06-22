import 'package:flutter/material.dart';
import 'package:minipress_app/models/categorie.dart';

class CategorieDetail extends StatefulWidget {
  final Categorie categorie;

  const CategorieDetail({Key? key, required this.categorie}) : super(key: key);

  @override
  State<CategorieDetail> createState() => _CategorieDetailState();
}

class _CategorieDetailState extends State<CategorieDetail> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.categorie.titre!),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(widget.categorie.description!),
          ],
        ),
      ),
    );
  }
}
