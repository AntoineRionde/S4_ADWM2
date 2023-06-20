import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:minipress_app/models/categorie.dart';
import 'package:http/http.dart' as http;
import 'package:minipress_app/screens/article_provider.dart';

class CategorieProvider extends ChangeNotifier {
  List<Article> _articles = <Article>[];
  List<Categorie> _categories = <Categorie>[];

  Future<List<Article>> getArticlesByCategorie(int categorieId) {
    if (_articles.isNotEmpty) {
      return Future<List<Article>>.value(_articles);
    }
    return fetchArticlesByCategorie(categorieId);
  }

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

  Future<List<Article>> fetchArticlesByCategorie(int categorieId) async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:45005/api/categories/$categorieId/articles'));
    final articles = <Article>[];

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonArticles = jsonBody['articles'];

      for (var jsonArticle in jsonArticles) {
        final articleUrl = jsonArticle['url']['self']['href'];
        final articleId = articleUrl.split('/').last;
        final article =
            await ArticleProvider().fetchArticle(int.parse(articleId));
        articles.add(article);
      }
      _articles = articles;
      print(articles[1].title);
      return articles;
    } else {
      throw Exception('Failed to fetch articles');
    }
  }
}
