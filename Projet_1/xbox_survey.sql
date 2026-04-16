CREATE DATABASE xbox_survey;
USE xbox_survey;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50),
    email VARCHAR(100),
    mdp VARCHAR(255)
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    texte_question TEXT,
    type_question ENUM('radio','checkbox','text'),
    options TEXT
);

CREATE TABLE reponses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT,
    id_question INT,
    reponse TEXT
);

-- Exemple d'insertion des questions Xbox
INSERT INTO questions (texte_question,type_question,options) VALUES
("Quel âge avez-vous ?", "radio", "Moins de 18 ans,18-24 ans,25-34 ans,35-44 ans,45 ans et plus"),

("Genre ?", "radio", "Homme,Femme,Préfère ne pas répondre"),

("Appareils que vous utilisez pour jouer ?", "checkbox", "Xbox,PlayStation,Nintendo Switch,PC,Smartphone/Tablette"),

("Fréquence de jeu ?", "radio", "Moins d’1h par semaine,1-5h par semaine,6-10h par semaine,11-20h par semaine,Plus de 20h par semaine"),

("Avez-vous un abonnement Xbox Game Pass ?", "radio", "Oui Xbox Game Pass,Oui autre service,Non"),

("Quel type de jeux préférez-vous ?", "checkbox", "AAA,Indie,Multijoueur,Solo,Mobile"),

("Possédez-vous une console Xbox actuelle ?", "radio", "Oui,Non"),

("Seriez-vous intéressé par une console portable Xbox ?", "radio", "Oui beaucoup,Oui un peu,Indifférent,Non"),

("Les consoles physiques ont-elles encore un intérêt ?", "radio", "Oui essentiel,Oui secondaire,Peu important,Non uniquement numérique"),

("Seriez-vous prêt à jouer uniquement via le cloud ?", "radio", "Oui totalement,Oui partiellement,Non"),

("Quel service numérique vous attire le plus ?", "radio", "Xbox Game Pass,Xbox Cloud Gaming,Abonnement multi plateforme,Aucun"),

("Qu’est-ce qui vous inciterait à rester fidèle à Xbox ?", "checkbox", "Jeux exclusifs,Promotions,Expérience en ligne,Cloud gaming"),

("Quelles licences Xbox aimeriez-vous voir développer ?", "text", ""),

("Quelle devrait être la priorité stratégique de Xbox ?", "text", ""),

("Avez-vous d’autres idées pour améliorer Xbox ?", "text", "");