import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:minipress_app/models/categorie.dart';
import 'package:http/http.dart' as http;

class CategorieProvider extends ChangeNotifier {
  List<Categorie> _categories = <Categorie>[];

  Future<List<Categorie>> getCategories() {
    if (_categories.isNotEmpty) {
      return Future<List<Categorie>>.value(_categories);
    }
    return fetchCategories();
  }

  Future<List<Categorie>> fetchCategories() async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:45005/api/categories'));

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonCategories = jsonBody['categories'];
      final categories = <Categorie>[];
      for (var jsonCategorie in jsonCategories) {
        var categorie = Categorie.fromJson(jsonCategorie);
        categories.add(categorie);
      }
      _categories = categories;
      return categories;
    } else {
      throw Exception('Failed to fetch categories');
    }
  }
}
