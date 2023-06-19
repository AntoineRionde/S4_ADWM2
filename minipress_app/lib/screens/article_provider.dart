import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:minipress_app/models/article.dart';
import 'package:http/http.dart' as http;

class ArticleProvider extends ChangeNotifier {
  List<Article> _articles = <Article>[];

  Future<List<Article>> getArticles() {
    if (_articles.isNotEmpty) {
      return Future<List<Article>>.value(_articles);
    }
    return fetchArticles();
  }

  Future<List<Article>> fetchArticles() async {
    // final response = await http.get(
    //     Uri.parse('http://docketu.iutnc.univ-lorraine.fr:45005/api/articles'));

    // if (response.statusCode == 200) {
    //   // final jsonBody = json.decode(response.body);
    //   // print(jsonBody);
    //   // final articles =
    //   //     List<Article>.from(jsonBody.map((x) => Article.fromJson(x)));
    //   // print(articles);
    //   // _articles = articles;
    //   // notifyListeners();

    //   // récupérer url self href et plus précisément l'id et appeller fetchArticle
    //   final jsonBody = json.decode(response.body);
    //   final jsonArticles = jsonBody['articles'];
    //   final articles = <Article>[];
    //   for (var jsonArticle in jsonArticles) {
    //     final article = Article.fromJson(jsonArticle);
    //     articles.add(article);
    //   }
    //   _articles = articles;
    //   notifyListeners();
    //   return articles;
    // } else {
    //   throw Exception('Failed to fetch articles');
    // }
    final response = await http.get(
        Uri.parse('http://docketu.iutnc.univ-lorraine.fr:45005/api/articles'));

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonArticles = jsonBody['articles'];
      final articles = <Article>[];
      for (var jsonArticle in jsonArticles) {
        final articleUrl = jsonArticle['url']['self']['href'];
        final articleId = articleUrl.split('/').last;
        final article = await fetchArticle(int.parse(articleId));
        articles.add(article);
      }
      _articles = articles;
      notifyListeners();
      print(articles);
      return articles;
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<Article> fetchArticle(int articleId) async {
    final response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:45005/api/articles/$articleId'));

    if (response.statusCode == 200) {
      final jsonBody = json.decode(response.body);
      final jsonArticle = jsonBody['article'];

      return Article.fromJson(jsonArticle);
    } else {
      throw Exception('Failed to fetch article');
    }
  }
}
