<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Redirection</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style media="screen">
        body {
            background-color: #f3e5f5; /* Violet pastel */
            color: #6a1b9a; /* Couleur de texte violet foncé */
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #d81b60; /* Rose pastel */
        }
        a {
            display: inline-block;
            margin: 15px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #ab47bc; /* Violet pastel */
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #8e24aa; /* Violet plus foncé au survol */
        }
    </style>
</head>
<body>
    <h1>Bienvenue sur Bon Voyage</h1>
    <p>Choisissez une option ci-dessous :</p>
    <a href="/Formulaire_Inscri">Inscription</a>
    <a href="/index">Liste des Chauffeurs</a>
    <a href="/listevehicule">Liste des Véhicules</a>
    <a href="/listevehiculepluschauffeur">Véhicules et Chauffeurs</a>
    <a href="/BenefParVehicule">Bénéfices par Véhicule</a>
    <a href="/BenParJour">Bénéfices par Jour</a>
    <a href="/TrajetRentable">Trajets Rentables</a>
    <a href="/Panne">Taux de Pannes</a>
    <a href="/SalaireChauffeur">Salaires des Chauffeurs</a>

    <h1>Vérifier la Disponibilité des Véhicules</h1>
    <form action="/Dispo" method="get">
        <label for="date">Sélectionnez une date :</label>
        <input type="date" id="date" name="date" required>
        <input type="submit" value="Vérifier">
    </form>
<br>
<form action="/Inscription" method="GET">
    <label for="nom">Nom d'utilisateur :</label><br>
    <input type="text" id="nom" name="nom" required><br><br>

    <label for="mdp">Mot de passe :</label><br>
    <input type="password" id="mdp" name="mdp" required><br><br>

    <button type="submit">S'inscrire</button>
</form>
</body>
</html>