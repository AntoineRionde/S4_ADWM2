class Article {
  final int? id;
  final String? title;
  final DateTime? dateCreation;
  final String? auteur;
  final String? resume;
  final String? contenu;
  final String? image;
  final int? idCateg;
  final String? idAuteur;

  Article(
      {this.id,
      this.title,
      this.dateCreation,
      this.auteur,
      this.resume,
      this.contenu,
      this.image,
      this.idCateg,
      this.idAuteur});

  factory Article.fromJson(Map<String, dynamic> json) {
    return Article(
      id: json['id'],
      title: json['titre'],
      dateCreation: DateTime.parse(json['date_creation']),
      auteur: json['auteur'],
      resume: json['resume'],
      contenu: json['contenu'],
      image: json['image'],
      idCateg: json['cat_id'],
      idAuteur: json['id_auteur'],
    );
  }
}
