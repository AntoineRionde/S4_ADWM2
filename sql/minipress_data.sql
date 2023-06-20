-- Insérer des articles dans la table "articles"
INSERT INTO article (id, titre, date_creation , auteur, resume, contenu, date_publication, image, cat_id) VALUES
                                                                                                               (1, 'Dernières avancées dans lia', "2023-06-15", 'Jean dupont', 'Cet article présente les dernières avancées dans le domaine de l''intelligence artificielle, y compris les réseaux neuronaux profonds et lapprentissage automatique.', 'Les réseaux neuronaux profonds ont révolutionné le domaine de l''intelligence artificielle.', "2023-06-15", null, 1),
                                                                                                               (2, 'Les plus beaux endroits ', "2023-06-15", 'Jean Moulin', 'Cet article propose une liste des plus beaux endroits à visiter en Europe, des villes historiques aux paysages naturels époustouflants.', 'L''Europe regorge de destinations incroyables à explorer.', "2023-06-15", null, 2),
                                                                                                               (3, 'Conseils sain et équilibrée', "2023-06-15", 'Jean nemarre', 'Cet article propose des conseils pratiques pour adopter une alimentation saine et équilibrée, favorisant ainsi une bonne santé.', 'Une alimentation équilibrée est essentielle pour maintenir une bonne santé. Il est recommandé de consommer une variété d''aliments.', "2023-06-15", null, 3);


-- Insérer des auteurs dans la table "auteurs"
INSERT INTO user (id, nom, prenom, password, activation_token, renew_token, username) VALUES
                                                                                       (1, 'John', 'Doe', '$2y$12$dAtXy/zAZsx0xp2s4Wxuq.lgb65n2qGORBYtWoSwsl/JQ7d3dbqUu', 'fb5d3a14f5085b4decb07cff6f5b20b67fb2684136f92ef31e7fa4d9f3e0ddb2', 'fb5d3a14f5085b4decb07cff6f5b20b67fb2684136f92ef31e7fa4d9f3e0dd', 'john.doe@example.com'),
                                                                                       (2, 'Jane', 'Smith', '$2y$12$dAtXy/zAZsx0xp2s4Wxuq.lgb65n2qGORBYtWoSwsl/JQ7d3dbqUu', 'fb5d3a14f5085b4decb07cff6f5b20b67fb2684136f92ef31e7fa4d9f3e0ddb2', 'fb5d3a14f5085b4decb07cff6f5b20b67fb2684136f92ef31e7fa4d9f3e0dd', 'jane.smith@example.com');

-- Insérer des catégories dans la table "categories"
INSERT INTO categorie (id, titre) VALUES
                                     (1, 'Technologie'),
                                     (2, 'Voyages'),
                                     (3, 'Santé');