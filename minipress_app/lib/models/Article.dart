class Article {
  final String? title;
  final DateTime? dateCreation;
  final String? auteur;
  final String? resume;
  final String? contenu;
  final DateTime? datePublication;
  final String? image;
  final int? idCateg;

  Article({
    this.title,
    this.dateCreation,
    this.auteur,
    this.resume,
    this.contenu,
    this.datePublication,
    this.image,
    this.idCateg,
  });

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      title: json['titre'],
      dateCreation: DateTime.parse(json['date_creation']),
      auteur: json['auteur'],
      resume: json['resume'],
      contenu: json['contenu'],
      datePublication: DateTime.parse(json['date_publication']),
      image: json['image'],
      idCateg: json['idCateg'],
    );
  }
}
