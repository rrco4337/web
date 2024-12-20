<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Salaire Chauffeur</title>
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
    <h1>Salaire Chauffeur</h1>
    <table>
        <thead>
            <tr>
                <th>nom</th>
                <th>Date</th>
                <th>salaire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($SalaireChauffeurs as $SalaireChauffeurs): ?>
                <tr>
                    <td><?=$SalaireChauffeurs['nom']?></td>
                    <td><?php echo $SalaireChauffeurs['date']; ?></td>
                    <td><?php echo $SalaireChauffeurs['salaire']; ?></td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
