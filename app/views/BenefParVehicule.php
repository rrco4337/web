<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title></title>
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
    <h1>Total montant bénéfice par véhicule</h1>
    <table>
        <thead>
            <tr>
                <th>Immatriculation</th>
                <th>total_benefice</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehiculesBenefs as $vehiculesETchauffeur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['immatriculation']); ?></td>
                    <td><?php echo htmlspecialchars($vehiculesETchauffeur['total_benefice']); ?></td>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
