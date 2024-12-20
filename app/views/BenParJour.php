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
    <h1>Benefice par jour</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>total_benefice</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($BenJour as $BenJour): ?>
                <tr>
                    <td><?php echo $BenJour['date']; ?></td>
                    <td><?php echo $BenJour['total_benefice']; ?></td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
