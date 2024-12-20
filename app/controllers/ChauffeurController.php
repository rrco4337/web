<?php
namespace app\controllers;

use app\models\ChauffeurModel;
use Flight;

class ChauffeurController
{
    public function index()
    {
        $db = ChauffeurModel::db(); 
        $ChauffeurModel = new ChauffeurModel($db);

        $chauffeurs = $ChauffeurModel->ListeChauffeur();

        Flight::render('index', ['chauffeurs' => $chauffeurs]);
    }

    public function listevehicule(){
        
        $db = ChauffeurModel::db(); 
        $ChauffeurModel = new ChauffeurModel($db);

        $vehicules = $ChauffeurModel->ListeVehicule();

        Flight::render('listevehicule', ['vehicules' => $vehicules]);
    }

    public function listevehiculepluschauffeur(){
        $db = ChauffeurModel::db(); 
        $ChauffeurModel = new ChauffeurModel($db);

        $vehiculesETchauffeurs = $ChauffeurModel->ListeVehiculeETChauffeurCorrespondant();

        Flight::render('listevehiculepluschauffeur', ['vehiculesETchauffeurs' => $vehiculesETchauffeurs]);
    }

    public function BenefParVehicule(){
        $db = ChauffeurModel::db(); 
        $ChauffeurModel = new ChauffeurModel($db);

        $vehiculesBenefs = $ChauffeurModel-> BenefParVehic();

        Flight::render('BenefParVehicule', ['vehiculesBenefs' => $vehiculesBenefs]);
    }

    public function BenParJour(){
        $db = ChauffeurModel::db();
        $ChauffeurModel = new ChauffeurModel($db);
        $BenJour = $ChauffeurModel ->BenefParJour();
        Flight::render('BenParJour',['BenJour' => $BenJour]);
    }
    public function TrajetRentable(){
        $db = ChauffeurModel::db();
        $ChauffeurModel = new ChauffeurModel($db);
        $Renta = $ChauffeurModel ->TrajetRentable();
        Flight::render('TrajetRentable',['Renta' => $Renta]);
    }
    public function Dispo() {
        $db = ChauffeurModel::db();

        $date = $_GET['date'] ?? null;

        if (!$date) {
            throw new Exception("La date est obligatoire.");
        }

        $model = new ChauffeurModel($db); 
        $vehicules = $model->VehiculeDispo($date);
        Flight::render('Dispo',['vehicules' =>$vehicules]);
    }

    public function Inscription(){
        $db=ChauffeurModel::db();
        $nom=$_GET['nom'] ?? null;
        $mdp=$_GET['mdp'] ?? null;
        $model = new ChauffeurModel($db);
        $inscription=$model->Inscription($nom,$mdp);
        
        if ($inscription === "Inscription réussie.") {
            echo $inscription; 
        } elseif ($inscription === "Nom d'utilisateur déjà pris.") {
            echo $inscription; 
        } else {
            echo "Une erreur est survenue.";
        }
    }

    public function Formulaire_Inscri(){
        
    }
    public function Panne()
    {
        $ChauffeurModel = new ChauffeurModel();
        $taux_pannes = $ChauffeurModel->Panne();
    
        Flight::render('Panne', ['taux_pannes' => $taux_pannes]);
    }
    
    public function SalaireChauffeur(){
        $ChauffeurModel = new ChauffeurModel();
        $SalaireChauffeurs = $ChauffeurModel->Salaire();
        Flight::render('SalaireChauffeur',['SalaireChauffeurs' =>$SalaireChauffeurs]);
    }


    
}
