USE back_db;

CREATE TABLE joueur(
   id_joueur INT AUTO_INCREMENT,
   nom_joueur VARCHAR(30),
   prenom_joueur VARCHAR(30),
   numero_licence VARCHAR(50) NOT NULL,
   date_naiss DATE,
   taille SMALLINT,
   poids SMALLINT,
   statut_joueur ENUM("ACTIF", "BLESSE", "SUSPENDU", "ABSENT"),
   commentaire TEXT,
   PRIMARY KEY(id_joueur)
);

CREATE TABLE match_ (
   id_match INT AUTO_INCREMENT,
   date_match DATETIME NOT NULL,
   nom_equipe_adverse VARCHAR(50),
   lieu_de_rencontre VARCHAR(50),
   points_subis TINYINT,
   point_marques TINYINT,
   domiciliation ENUM('DOMICILE', 'EXTERIEUR'),
   sens_match ENUM('GAGNE', 'PERDU', 'NUL'),
   PRIMARY KEY(id_match)
);

CREATE TABLE commentaire(
   id_commentaire INT AUTO_INCREMENT,
   date_commentaire DATE,
   commentaire TEXT,
   id_joueur INT NOT NULL,
   PRIMARY KEY(id_commentaire),
   FOREIGN KEY(id_joueur) REFERENCES joueur(id_joueur)
);

CREATE TABLE participer(
   id_joueur INT,
   id_match INT,
   poste ENUM("PILIER_GAUCHE", 
   "TALONNEUR",
   "PILIER_DROIT",
   "DEUXIEME_LIGNE_GAUCHE",
   "DEUXIEME_LIGNE_DROITE",
   "TROISIEME_LIGNE_AILE_GAUCHE",
   "TROISIEME_LIGNE_AILE_DROITE",
   "TROISIEME_LIGNE_CENTRE",
   "DEMI_DE_MELLEE",
   "OUVERTURE",
   "AILIER_GAUCHE",
   "CENTRE_INTERIEUR",
   "CENTRE_EXTERIEUR",
   "AILIER_DROIT",
   "ARRIERE",
   "REMPLACANT"),
   est_titulaire BOOLEAN,
   evaluation TINYINT,
   PRIMARY KEY(id_joueur, id_match),
   FOREIGN KEY(id_joueur) REFERENCES joueur(id_joueur),
   FOREIGN KEY(id_match) REFERENCES match_(id_match)
);
