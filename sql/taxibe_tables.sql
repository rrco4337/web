CREATE DATABASE taxibe;
USE taxibe;

-- Table des véhicules
CREATE TABLE Vehicule(
    idVehicule INT AUTO_INCREMENT PRIMARY KEY,
    immatriculation VARCHAR(20) NOT NULL
);

-- Table des chauffeurs
CREATE TABLE Chauffeur(
    idChauffeur INT AUTO_INCREMENT PRIMARY KEY,
    nomChauffeur VARCHAR(50) NOT NULL
);

-- Table des types de trajets
CREATE TABLE typeTrajet(
    idTypeTrajet INT AUTO_INCREMENT PRIMARY KEY,
    pointDepart VARCHAR(50) NOT NULL,
    pointArrive VARCHAR(50) NOT NULL,
    km INT NOT NULL
);

-- Table des trajets
CREATE TABLE trajet(
    idTrajet INT AUTO_INCREMENT PRIMARY KEY,
    idTypeTrajet INT NOT NULL,
    idChauffeur INT NOT NULL,
    idVehicule INT NOT NULL,
    date DATE NOT NULL,
    heureDebut TIME NOT NULL,
    heureFin TIME NOT NULL,
    MontantRecette DECIMAL(10,2) NOT NULL,
    MontantCarburant DECIMAL(10,2) NOT NULL,

    -- Clés étrangères
    FOREIGN KEY (idTypeTrajet) REFERENCES typeTrajet(idTypeTrajet),
    FOREIGN KEY (idChauffeur) REFERENCES Chauffeur(idChauffeur),
    FOREIGN KEY (idVehicule) REFERENCES Vehicule(idVehicule)
);




---Insertion de donnees


INSERT INTO Vehicule (immatriculation) VALUES 
('1234ABC'),
('5678DEF'),
('9101GHI'),
('1213JKL');

INSERT INTO Chauffeur (nomChauffeur) VALUES 
('Rakoto Jean'),
('Rabe Thomas'),
('Randria Pierre'),
('Solofo Michel');

INSERT INTO typeTrajet (pointDepart, pointArrive, km) VALUES 
('Andoharanofotsy', 'Ambohibao', 15),
('Analakely', 'Ivato', 18),
('Mahamasina', 'Anosy', 5),
('Ampefiloha', 'Ankorondrano', 7);


-- Rakoto Jean (idChauffeur = 1) utilise le véhicule 1 (idVehicule = 1)
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 1, 1, '2024-06-17', '08:00:00', '10:00:00', 5000.00, 1000.00);

-- Rabe Thomas (idChauffeur = 2) utilise le véhicule 2 (idVehicule = 2)
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (2, 2, 2, '2024-06-17', '09:00:00', '11:00:00', 6000.00, 1200.00);

-- Randria Pierre (idChauffeur = 3) utilise le véhicule 3 (idVehicule = 3)
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (3, 3, 3, '2024-06-17', '10:00:00', '12:00:00', 4000.00, 800.00);


-- Rakoto Jean utilise encore le véhicule 1
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (4, 1, 1, '2024-06-18', '08:00:00', '09:30:00', 3000.00, 700.00);

-- Rabe Thomas utilise le véhicule 2
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (3, 2, 2, '2024-06-18', '11:00:00', '13:00:00', 4500.00, 900.00);

-- Solofo Michel (idChauffeur = 4) utilise le véhicule 4
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (2, 4, 4, '2024-06-18', '15:00:00', '17:00:00', 7000.00, 1500.00);


-- Randria Pierre utilise encore le véhicule 3
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 3, 3, '2024-06-19', '07:30:00', '09:30:00', 3500.00, 750.00);

-- Rakoto Jean continue avec le véhicule 1
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (4, 1, 1, '2024-06-19', '10:00:00', '11:30:00', 4000.00, 850.00);


-----Suite----

-- Trajet 1 : matin
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 1, 1, '2024-06-20', '06:30:00', '08:00:00', 4500.00, 900.00);

-- Trajet 2 : avant-midi
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (2, 1, 1, '2024-06-20', '09:00:00', '10:30:00', 4000.00, 850.00);

-- Trajet 3 : après-midi
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (3, 1, 1, '2024-06-20', '14:00:00', '15:30:00', 5500.00, 1100.00);

-- Trajet 4 : soir
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (4, 1, 1, '2024-06-20', '18:00:00', '19:30:00', 6000.00, 1200.00);


-- Trajet 1 : matin
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 2, 2, '2024-06-20', '07:00:00', '08:30:00', 4800.00, 950.00);

-- Trajet 2 : avant-midi
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (2, 2, 2, '2024-06-20', '09:30:00', '11:00:00', 4300.00, 900.00);

-- Trajet 3 : après-midi
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (3, 2, 2, '2024-06-20', '13:30:00', '15:00:00', 5200.00, 1050.00);

-- Trajet 4 : soir
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (4, 2, 2, '2024-06-20', '17:30:00', '19:00:00', 5800.00, 1150.00);

-- Trajet 1 : matin
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 4, 4, '2024-06-20', '06:00:00', '07:30:00', 5000.00, 1000.00);

-- Trajet 2 : après-midi
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (3, 4, 4, '2024-06-20', '13:00:00', '14:30:00', 5300.00, 1100.00);


-- Jour 1 : 2024-06-20 - Rakoto Jean utilise le véhicule 1
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 1, 1, '2024-06-20', '06:30:00', '08:00:00', 4500.00, 900.00);

INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (2, 1, 1, '2024-06-20', '10:00:00', '11:30:00', 4000.00, 850.00);

-- Jour 2 : 2024-06-21 - Rakoto Jean change de véhicule et utilise le véhicule 2
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (3, 1, 2, '2024-06-21', '07:00:00', '08:30:00', 5000.00, 1000.00);

INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (4, 1, 2, '2024-06-21', '09:30:00', '11:00:00', 4500.00, 900.00);

-- Jour 1 : 2024-06-20 - Rabe Thomas utilise le véhicule 2
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 2, 2, '2024-06-20', '07:00:00', '08:30:00', 4800.00, 950.00);

INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (2, 2, 2, '2024-06-20', '09:30:00', '11:00:00', 4300.00, 900.00);

-- Jour 2 : 2024-06-21 - Rabe Thomas change de véhicule et utilise le véhicule 3
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (3, 2, 3, '2024-06-21', '06:00:00', '07:30:00', 5100.00, 1000.00);

INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (4, 2, 3, '2024-06-21', '08:30:00', '10:00:00', 4700.00, 950.00);

-- Jour 1 : 2024-06-20 - Solofo Michel utilise le véhicule 4
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (1, 4, 4, '2024-06-20', '06:00:00', '07:30:00', 5000.00, 1000.00);

-- Jour 2 : 2024-06-21 - Solofo Michel utilise encore le même véhicule 4
INSERT INTO trajet (idTypeTrajet, idChauffeur, idVehicule, date, heureDebut, heureFin, MontantRecette, MontantCarburant)
VALUES (2, 4, 4, '2024-06-21', '07:00:00', '08:30:00', 5300.00, 1100.00);

