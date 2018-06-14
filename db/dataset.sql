INSERT INTO voiture(id, voiture, nb_places) VALUES (1, 'AA-111-AA', 5);
INSERT INTO voiture(id, voiture, nb_places) VALUES (2, 'BB-222-BB', 5);
INSERT INTO voiture(id, voiture, nb_places) VALUES (3, 'CC-333-CC', 2);

INSERT INTO ville (id, ville, cp) VALUES (1, 'Brest', '29200');
INSERT INTO ville (id, ville, cp) VALUES (2, 'La Rochelle', '17000');
INSERT INTO ville (id, ville, cp) VALUES (3, 'Paris', '75000');

INSERT INTO internaute (id, nom, prenom, tel, mail, voiture_id, ville_id) VALUES (1, 'Dupont', 'Jean', '11.11.11.11.11', 'jean.dupond@yopmail.com', 1, 1);
INSERT INTO internaute (id, nom, prenom, tel, mail, voiture_id, ville_id) VALUES (2, 'Dusel', 'Martin', '22.22.22.22.22', 'martin.dusel@yopmail.com', 2, 2);
INSERT INTO internaute (id, nom, prenom, tel, mail, voiture_id, ville_id) VALUES (3, 'Duchateau', 'René', '33.33.33.33.33', 'rene.duchateau@yopmail.com', 3, 3);

INSERT INTO trajet (id, nb_km, date, internaute_id, ville_id, ville_id1) VALUES (1, '500', 01/01/2001, 1, 1, 2);
INSERT INTO trajet (id, nb_km, date, internaute_id, ville_id, ville_id1) VALUES (2, '600', 02/02/2002, 2, 2, 3);
INSERT INTO trajet (id, nb_km, date, internaute_id, ville_id, ville_id1) VALUES (3, '700', 03/03/2003, 3, 3, 1);
