class Article {
  final int? id;
  final String? title;
  final DateTime? date_creation;
  final String? auteur;
  final String? resume;
  final String? contenu;
  final DateTime? date_publication;
  final String? image;
  final int? idCateg;

  Article({
    this.id,
    this.title,
    this.date_creation,
    this.auteur,
    this.resume,
    this.contenu,
    this.date_publication,
    this.image,
    this.idCateg,
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      id: json['id'],
      title: json['title'],
      date_creation: DateTime.parse(json['date_creation']),
      auteur: json['auteur'],
      resume: json['resume'],
      contenu: json['contenu'],
      date_publication: DateTime.parse(json['date_publication']),
      image: json['image'],
      idCateg: json['idCateg'],
    );
  }
}
