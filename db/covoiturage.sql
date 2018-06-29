DROP TABLE IF EXISTS trajet;
DROP TABLE IF EXISTS internaute;
DROP TABLE IF EXISTS voiture;
DROP TABLE IF EXISTS ville;
CREATE TABLE ville (
  id INT,
  ville VARCHAR(255),
  cp VARCHAR(5),
  PRIMARY KEY (id)
);
CREATE TABLE voiture (
  id INT,
  voiture VARCHAR(45),
  nb_places INT,
  PRIMARY KEY (id)
);
CREATE TABLE internaute (
  id INT,
  nom VARCHAR(45),
  prenom VARCHAR(45),
  tel VARCHAR(10),
  mail VARCHAR(45),
  voiture_id INT,
  ville_id INT,
  PRIMARY KEY (id),
  FOREIGN KEY (voiture_id) REFERENCES voiture(id),
  FOREIGN KEY (ville_id) REFERENCES ville(id)
);
CREATE TABLE trajet (
  id INT,
  nb_km VARCHAR(45),
  date DATE,
  internaute_id INT,
  ville_id INT,
  ville_id1 INT,
  PRIMARY KEY (id),
  FOREIGN KEY (internaute_id) REFERENCES internaute(id),
  FOREIGN KEY (ville_id) REFERENCES ville(id),
  FOREIGN KEY (ville_id1) REFERENCES ville(id)
);
INSERT INTO voiture(id, voiture, nb_places) VALUES (1, 'AA-111-AA', 5);
INSERT INTO voiture(id, voiture, nb_places) VALUES (2, 'BB-222-BB', 5);
INSERT INTO voiture(id, voiture, nb_places) VALUES (3, 'CC-333-CC', 2);

INSERT INTO ville (id, ville, cp) VALUES (1, 'Brest', '29200');
INSERT INTO ville (id, ville, cp) VALUES (2, 'La Rochelle', '17000');
INSERT INTO ville (id, ville, cp) VALUES (3, 'Paris', '75000');

INSERT INTO internaute (id, nom, prenom, tel, mail, voiture_id, ville_id) VALUES (1, 'Dupont', 'Jean', '1111111111', 'jean.dupond@yopmail.com', 1, 1);
INSERT INTO internaute (id, nom, prenom, tel, mail, voiture_id, ville_id) VALUES (2, 'Dusel', 'Martin', '2222222222', 'martin.dusel@yopmail.com', 2, 2);
INSERT INTO internaute (id, nom, prenom, tel, mail, voiture_id, ville_id) VALUES (3, 'Duchateau', 'René', '3333333333', 'rene.duchateau@yopmail.com', 3, 3);

INSERT INTO trajet (id, nb_km, date, internaute_id, ville_id, ville_id1) VALUES (1, '500', STR_TO_DATE('1-01-2001', '%d-%m-%Y'), 1, 1, 2);
INSERT INTO trajet (id, nb_km, date, internaute_id, ville_id, ville_id1) VALUES (2, '600', STR_TO_DATE('2-02-2002', '%d-%m-%Y'), 2, 2, 3);
INSERT INTO trajet (id, nb_km, date, internaute_id, ville_id, ville_id1) VALUES (3, '700', STR_TO_DATE('3-03-2003', '%d-%m-%Y'), 3, 3, 1);
