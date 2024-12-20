<?php

namespace app\models;

use PDO;

class ChauffeurModel
{


    

    // Méthode statique pour établir la connexion à la base de données
    public static function db()
    {
        // Configuration de la base de données
        $host = 'localhost';
        $db = 'TAXIBE';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        // Chaîne DSN
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        // Options PDO
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        // Tentative de connexion
        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function ListeChauffeur()
    {
        $pdo = self::db();
        $stmt = $pdo->query("SELECT * FROM chauffeur");
        return $stmt->fetchAll();
    }

    public function ListeVehicule(){
        $pdo = self::db();
        $stmt = $pdo->query("SELECT * FROM vehicule");
        return $stmt->fetchAll();
    }


    public function ListeVehiculeETChauffeurCorrespondant()
    {
        $pdo = self::db();
        
        $stmt = $pdo->query("
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
            GROUP BY DATE(t.date_heure_debut), v.immatriculation, c.nom
        ");
        
        return $stmt->fetchAll();
    }
    
    public function BenefParVehic()
    {
        $pdo = self::db();
        
        $stmt = $pdo->query("
        SELECT 
    v.immatriculation,
    SUM(t.montant_recette - t.montant_carburant) AS total_benefice
FROM trajet t
JOIN vehicule v ON t.id_vehicule = v.id_vehicule
GROUP BY v.immatriculation;
        ");
        
        return $stmt->fetchAll();
    }

    public function BenefParJour()
    {
        $pdo = self::db();

        $stmt = $pdo->query(
            "
            SELECT 
    DATE(t.date_heure_debut) AS date,
    SUM(t.montant_recette - t.montant_carburant) AS total_benefice
FROM trajet t
GROUP BY DATE(t.date_heure_debut);"
        );

        return $stmt ->fetchAll();
    }

    public function TrajetRentable()
    {
        $pdo = self::db();

        $stmt = $pdo->query(
            "
            SELECT 
    DATE(t.date_heure_debut) AS date,
    v.immatriculation,
    (t.montant_recette - t.montant_carburant) AS benefice
FROM trajet t
JOIN vehicule v ON t.id_vehicule = v.id_vehicule
ORDER BY date, benefice DESC
LIMIT 10;"
        );

        return $stmt ->fetchAll();
    }
    public function VehiculeDispo($date) {
        $pdo = self::db();
        $stmt = $pdo->prepare(
            "SELECT 
                v.immatriculation
            FROM vehicule v
            WHERE NOT EXISTS (
                SELECT 1
                FROM historique_vehicule hv
                WHERE v.id_vehicule = hv.id_vehicule
                  AND :date BETWEEN hv.date_debut AND hv.date_fin
            );"
        );        
        $stmt->bindParam(':date', $date);
        
        if ($stmt->execute()) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (empty($results)) {
                return []; 
            }
            
            return $results;
        } else {
            throw new Exception("Query execution failed.");
        }
    }
    
    public function Panne()
    {
        $pdo = self::db();
    
        $stmt = $pdo->query(
            "SELECT 
                v.immatriculation,
                MONTH(hv.date_debut) AS mois,
                COUNT(*) * 100.0 / (SELECT COUNT(*) FROM historique_vehicule WHERE id_vehicule = v.id_vehicule) AS taux_panne
            FROM historique_vehicule hv
            JOIN vehicule v ON hv.id_vehicule = v.id_vehicule
            GROUP BY v.immatriculation, mois;"
        );
    
        return $stmt->fetchAll(); 
    }

    public function Salaire(){
        $pdo = self::db();
        $stmt= $pdo->query(
            "SELECT 
    c.nom,
    DATE(t.date_heure_debut) AS date,
    CASE
        WHEN t.montant_recette > v.montant_minimum THEN t.montant_recette * (v.pourcentage_haut / 100)
        ELSE t.montant_recette * (v.pourcentage_bas / 100)
    END AS salaire
     FROM trajet t
    JOIN chauffeur c ON t.id_chauffeur = c.id_chauffeur
    JOIN versement v ON t.id_vehicule = v.id_vehicule;"
        );

        return $stmt->fetchAll();
        }

    public function Inscription($nom, $mdp){
            $pdo = self::db();

            $stmt = $pdo->prepare("SELECT * FROM UTULISATEUR WHERE nom = :nom");
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->execute();
            $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($existingUser) {
                return "Nom d'utilisateur déjà pris.";
            }

            $stmt = $pdo->prepare("INSERT INTO UTULISATEUR (nom, mdp) VALUES (:nom, :mdp)");
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return "Inscription réussie.";
            }
        
            return "Erreur lors de l'inscription.";
        
            
        }
        public function ajouterTrajet($date_debut, $date_fin, $montant_recette, $montant_carburant, $distance_km, $id_vehicule, $id_chauffeur) {
            $this->db->beginTransaction();
            try {
                $stmt = $this->db->prepare("
                    INSERT INTO  (id_chauffeur, id_vehicule, date_heure_debut, date_heure_fin, distance_km, montant_recette, montant_carburant) 
                    VALUES  (:id_chauffeur, :id_vehicule, :date_heure_debut, :date_heure_fin, :distance_km, :montant_recette, :montant_carburant) 
                ");
                $stmt->execute([
                    'id_chauffeur' => $id_chauffeur,
                    'id_vehicule' => $id_vehicule,
                    'date_debut' => $date_debut,
                    'date_fin' => $date_fin,
                    'distance_km' => $distance_km,
                    'montant_recette' => $montant_recette,
                    'montant_carburant' => $montant_carburant,
                ]);
        
        
        
                $this->db->commit();
            } catch (\Exception $e) {
                $this->db->rollBack();
                throw $e;
            }
        }
        

}
