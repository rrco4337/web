<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Trajet le plus rentable</title>
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
    <h1>Trajet le plus rentable</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>immatriculation</th>
                <th>Benefice</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Renta as $Renta): ?>
                <tr>
                    <td><?php echo $Renta['date']; ?></td>
                    <td><?php echo $Renta['immatriculation']; ?></td>
                    <td><?php echo $Renta['benefice']; ?></td>

                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
