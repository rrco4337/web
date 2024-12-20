CREATE TABLE chauffeur (
    id_chauffeur SERIAL PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100)
);
CREATE TABLE vehicule (
    id_vehicule SERIAL PRIMARY KEY,
    immatriculation VARCHAR(50),
    modele VARCHAR(100),
    etat VARCHAR(50) DEFAULT 'disponible' -- disponible, panne
);
CREATE TABLE trajet (
    id_trajet SERIAL PRIMARY KEY,
    id_chauffeur INT REFERENCES chauffeur(id_chauffeur),
    id_vehicule INT REFERENCES vehicule(id_vehicule),
    date_heure_debut DATETIME,
    date_heure_fin DATETIME,
    distance_km DECIMAL(10, 2),
    montant_recette DECIMAL(10, 2),
    montant_carburant DECIMAL(10, 2)
);

CREATE TABLE historique_vehicule (
    id_historique SERIAL PRIMARY KEY,
    id_vehicule INT REFERENCES vehicule(id_vehicule),
    date_debut DATETIME,
    date_fin DATETIME,
    motif VARCHAR(255) -- panne, entretien, etc.
);
CREATE TABLE versement (
    id_versement SERIAL PRIMARY KEY,
    id_vehicule INT REFERENCES vehicule(id_vehicule),
    montant_minimum DECIMAL(10, 2),
    pourcentage_bas DECIMAL(5, 2) DEFAULT 8,
    pourcentage_haut DECIMAL(5, 2) DEFAULT 25
);
CREATE TABLE salaire (
    id_salaire SERIAL PRIMARY KEY,
    id_chauffeur INT REFERENCES chauffeur(id_chauffeur),
    date_salaire DATETIME,
    montant DECIMAL(10, 2)
);

INSERT INTO chauffeur (nom, prenom) VALUES 
('Rasoa', 'Jean'),
('Rakoto', 'Paul'),
('Andria', 'Marie');

INSERT INTO vehicule (immatriculation, modele) VALUES 
('123ABC', 'Toyota Corolla'),
('456DEF', 'Hyundai Accent'),
('789GHI', 'Renault Clio');

INSERT INTO trajet (id_chauffeur, id_vehicule, date_heure_debut, date_heure_fin, distance_km, montant_recette, montant_carburant) VALUES 
(1, 1, '2024-12-01 08:00:00', '2024-12-01 09:00:00', 10.5, 5000, 1500),
(2, 2, '2024-12-01 10:00:00', '2024-12-01 11:30:00', 15.3, 7000, 2000);

INSERT INTO historique_vehicule (id_vehicule, date_debut, date_fin, motif) VALUES 
(1, '2024-12-01 08:00:00', '2024-12-03 18:00:00', 'panne');


INSERT INTO versement (id_vehicule, montant_minimum) VALUES 
(1, 1000),
(2, 2000),
(3, 1500);

-- Ajout de nouveaux chauffeurs
INSERT INTO chauffeur (nom, prenom) VALUES 
('Ramiarison', 'Lalao'),
('Ravelojaona', 'Hery'),
('Ranjatoelina', 'Mamy');

-- Ajout de nouveaux véhicules
INSERT INTO vehicule (immatriculation, modele) VALUES 
('321CBA', 'Ford Fiesta'),
('654FED', 'Peugeot 208'),
('987IHG', 'Nissan Micra');

-- Ajout de nouveaux trajets
INSERT INTO trajet (id_chauffeur, id_vehicule, date_heure_debut, date_heure_fin, distance_km, montant_recette, montant_carburant) VALUES 
(3, 3, '2024-12-02 09:00:00', '2024-12-02 10:30:00', 12.0, 6000, 1800),
(3, 6, '2024-12-02 15:00:00', '2024-12-02 16:30:00', 25.0, 11000, 3000);

-- Ajout de nouveaux historiques de véhicule
INSERT INTO historique_vehicule (id_vehicule, date_debut, date_fin, motif) VALUES 
(2, '2024-12-02 08:00:00', '2024-12-02 09:00:00', 'entretien'),
(3, '2024-12-02 10:00:00', '2024-12-08 11:00:00', 'panne');

-- Ajout de nouveaux versements
INSERT INTO versement (id_vehicule, montant_minimum) VALUES 
(4, 1200),
(5, 2500),
(6, 1800);
/*1. Liste par jour des véhicules et chauffeurs avec informations*/

SELECT 
    DATE(t.date_heure_debut) AS date,
    v.immatriculation,
    c.nom AS chauffeur,
    SUM(t.distance_km) AS kilometres_effectues,
    SUM(t.montant_recette) AS montant_recette,
    SUM(t.montant_carburant) AS montant_carburant
FROM trajet t
JOIN vehicule v ON t.id_vehicule = v.id_vehicule
JOIN chauffeur c ON t.id_chauffeur = c.id_chauffeur
GROUP BY DATE(t.date_heure_debut), v.immatriculation, c.nom;

-- 2. Total montant bénéfice par véhicule

SELECT 
    v.immatriculation,
    SUM(t.montant_recette - t.montant_carburant) AS total_benefice
FROM trajet t
JOIN vehicule v ON t.id_vehicule = v.id_vehicule
GROUP BY v.immatriculation;
-- 3. Total montant bénéfice par jour
SELECT 
    DATE(t.date_heure_debut) AS date,
    SUM(t.montant_recette - t.montant_carburant) AS total_benefice
FROM trajet t
GROUP BY DATE(t.date_heure_debut);

-- 4. Trajets les plus rentables par jour

SELECT 
    DATE(t.date_heure_debut) AS date,
    v.immatriculation,
    (t.montant_recette - t.montant_carburant) AS benefice
FROM trajet t
JOIN vehicule v ON t.id_vehicule = v.id_vehicule
ORDER BY date, benefice DESC
LIMIT 10;
-- 5. Véhicules disponibles à une date donnée

SELECT 
    v.immatriculation
FROM vehicule v
WHERE NOT EXISTS (
    SELECT 1
    FROM historique_vehicule hv
    WHERE v.id_vehicule = hv.id_vehicule
      AND '2024-12-02' BETWEEN hv.date_debut AND hv.date_fin
);
-- 6. Taux de panne par mois

SELECT 
    v.immatriculation,
    MONTH(hv.date_debut) AS mois,
    COUNT(*) * 100.0 / (SELECT COUNT(*) FROM historique_vehicule WHERE id_vehicule = v.id_vehicule) AS taux_panne
FROM historique_vehicule hv
JOIN vehicule v ON hv.id_vehicule = v.id_vehicule
GROUP BY v.immatriculation, mois;
-- 7. Salaire journalier des chauffeurs
SELECT 
    c.nom,
    DATE(t.date_heure_debut) AS date,
    CASE
        WHEN t.montant_recette > v.montant_minimum THEN t.montant_recette * (v.pourcentage_haut / 100)
        ELSE t.montant_recette * (v.pourcentage_bas / 100)
    END AS salaire
FROM trajet t
JOIN chauffeur c ON t.id_chauffeur = c.id_chauffeur
JOIN versement v ON t.id_vehicule = v.id_vehicule;

