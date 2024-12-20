<!-- index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Liste des Chauffeurs</title>
</head>
<body>
    <h1>Liste des Vehicules</h1>
    <ul>
        <?php foreach ($vehicules as $vehicule): ?>
            <li><?php echo htmlspecialchars($vehicule['modele']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>