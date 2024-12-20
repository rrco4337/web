---Liste par jour des vehicules et son chauffeur correspondant
--sans colonne suplementaire
SELECT date Date_trajet,v.immatriculation Vehicule,c.nomChauffeur Chauffeur
FROM trajet t
JOIN Vehicule v ON v.idVehicule=t.idVehicule
JOIN Chauffeur c ON c.idChauffeur=t.idChauffeur
GROUP BY date , c.nomChauffeur
;

--avec colonne suplementaire
SELECT date Date_trajet,v.immatriculation Vehicule,c.nomChauffeur Chauffeur,
    SUM(t.MontantRecette) Somme_recette , SUM(t.MontantCarburant) Somme_carburant , SUM(tt.km) kilometres
FROM trajet t
JOIN typeTrajet tt ON tt.idTypeTrajet=t.idtypeTrajet
JOIN Vehicule v ON v.idVehicule=t.idVehicule
JOIN Chauffeur c ON c.idChauffeur=t.idChauffeur
GROUP BY date , c.nomChauffeur
;



----Total montant benefice par vehicule-------

SELECT Vehicule ,SUM(Somme_recette) Total_recette,SUM(Somme_carburant) Total_carburant, SUM(Somme_recette-Somme_carburant) Benefice
FROM
    (
        SELECT date Date_trajet,v.immatriculation Vehicule,c.nomChauffeur Chauffeur,
        SUM(t.MontantRecette) Somme_recette , SUM(t.MontantCarburant) Somme_carburant
        FROM trajet t
        JOIN Vehicule v ON v.idVehicule=t.idVehicule
        JOIN Chauffeur c ON c.idChauffeur=t.idChauffeur
        GROUP BY date , c.nomChauffeur
    ) as ChauffeurVehiculeParJour
GROUP BY Vehicule
;



-----Total montant benefice par jour------

SELECT Date_trajet ,SUM(Somme_recette) Total_recette,SUM(Somme_carburant) Total_carburant, SUM(Somme_recette-Somme_carburant) Benefice
FROM
    (
        SELECT date Date_trajet,v.immatriculation Vehicule,c.nomChauffeur Chauffeur,
        SUM(t.MontantRecette) Somme_recette , SUM(t.MontantCarburant) Somme_carburant
        FROM trajet t
        JOIN Vehicule v ON v.idVehicule=t.idVehicule
        JOIN Chauffeur c ON c.idChauffeur=t.idChauffeur
        GROUP BY date , c.nomChauffeur
    ) as ChauffeurVehiculeParJour
GROUP BY Date_trajet
;



------Les trajets les plus rentables par jour-------        


        ---benefice par trajet par jour---
    SELECT MAX(t2.MontantRecette -t2.MontantCarburant)
        FROM trajet t2
        WHERE t2.date = t.date

SELECT 
    t.date AS DateTrajet,
    t.idTrajet,
    v.immatriculation AS Vehicule,
    c.nomChauffeur AS Chauffeur,
    tt.pointDepart,
    tt.pointArrive,
    t.MontantRecette,
    t.MontantCarburant,
    (t.MontantRecette - t.MontantCarburant) AS Benefice
FROM 
    trajet t
JOIN 
    Vehicule v ON t.idVehicule = v.idVehicule
JOIN 
    Chauffeur c ON t.idChauffeur = c.idChauffeur
JOIN 
    typeTrajet tt ON t.idTypeTrajet = tt.idTypeTrajet
WHERE 
    (t.MontantRecette - t.MontantCarburant) = (
        SELECT MAX(t2.MontantRecette - t2.MontantCarburant)
        FROM trajet t2
        WHERE t2.date = t.date
    )
ORDER BY 
    t.date, t.idTrajet;

