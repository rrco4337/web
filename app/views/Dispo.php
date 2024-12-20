<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Vehicule dispo</title>
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
    <h1>Vehicule dispo</h1>
    <table>
        <thead>
            <tr>
                <th>Immatriculation</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicules as $vehicule): ?>
                <tr>
                    <td><?= $vehicule['immatriculation']?></td>
                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
