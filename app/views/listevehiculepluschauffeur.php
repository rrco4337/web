<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Liste des Véhicules et Chauffeurs</title>
    <style>
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Liste des Véhicules et Chauffeurs</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Immatriculation</th>
                <th>Kilomètres Effectués</th>
                <th>Montant Recette (€)</th>
                <th>Montant Carburant (€)</th>
                <th>Chauffeur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehiculesETchauffeurs as $vehiculesETchauffeur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['date']); ?></td>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['immatriculation']); ?></td>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['kilometres_effectues']); ?> km</td>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['montant_recette']); ?> €</td>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['montant_carburant']); ?> €</td>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['chauffeur']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
