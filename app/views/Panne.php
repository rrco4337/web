<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Taux de Panne des Véhicules</title>
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
    <h1>Taux de Panne des Véhicules par Mois</h1>
    <table>
        <thead>
            <tr>
                <th>Immatriculation</th>
                <th>Mois</th>
                <th>Taux de Panne (%)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($taux_pannes as $panne): ?>
                <tr>
                    <td><?= $panne['immatriculation']?></td>
                    <td><?=$panne['mois']?></td>
                    <td><?=$panne['taux_panne'] ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
