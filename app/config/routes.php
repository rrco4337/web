<?php

use app\controllers\ChauffeurController;
use flight\Engine;
use flight\net\Router;
// use flight;

/** 
 * @var Router $router 
 * @var Engine $app
 */
/*$router->get('/', function() use ($app) {
	$Welcome_Controller = new WelcomeController($app);
	$app->render('welcome', [ 'message' => 'It works!!' ]);
});*/



$ChauffeurController = new ChauffeurController();

$router->get('/', [ $ChauffeurController, 'index' ]); 
$router->get('/listeVehicule', [ $ChauffeurController, 'listevehicule' ]); 
$router->get('/listevehiculepluschauffeur', [ $ChauffeurController, 'listevehiculepluschauffeur' ]);
$router->get('/BenefParVehicule', [ $ChauffeurController, 'BenefParVehicule' ]);
$router->get('/BenParJour',[$ChauffeurController,'BenParJour']);
$router->get('/TrajetRentable',[$ChauffeurController,'TrajetRentable']);
$router->get('/Dispo', [$ChauffeurController, 'Dispo']);
$router->get('/Panne', [new ChauffeurController(), 'Panne']);
$router->get('/SalaireChauffeur', [new ChauffeurController(),'SalaireChauffeur']);
$router->get('/Inscription', [$ChauffeurController,'Inscription']);
$router->get('/Formulaire_Inscri', [$ChauffeurController,'Formulaire_Inscri']);


//$router->get('/', [ 'WelcomeController', 'home' ]); 

//$router->get('/', \app\controllers\WelcomeController::class.'->home'); 






