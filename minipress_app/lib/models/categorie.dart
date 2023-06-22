class Categorie {
  final int? id;
  final String? titre;
  final String? description;

  Categorie({
    this.id,
    this.titre,
    this.description,
  });

  factory Categorie.fromJson(Map<String, dynamic> json) {
    return Categorie(
      id: json['id'],
      titre: json['titre'],
      description: json['description'],
    );
  }
}
