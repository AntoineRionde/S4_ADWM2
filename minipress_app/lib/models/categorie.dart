class Categorie {
  final String? titre;
  final String? description;

  Categorie({
    this.titre,
    this.description,
  });

  factory Categorie.fromJson(Map<String, dynamic> json) {
    return Categorie(
      titre: json['titre'],
      description: json['description'],
    );
  }
}
