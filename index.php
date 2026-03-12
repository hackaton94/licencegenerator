<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Licence BTE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Générateur de Licence BTE</h1>
        
        <form action="generate.php" method="POST" class="license-form">
            <div class="form-group">
                <label for="quantity">Nombre de licences à générer :</label>
                <input type="number" id="quantity" name="quantity" min="1" max="50" value="1" required>
            </div>
            
            <div class="form-group">
                <label for="include_special">Inclure des caractères spéciaux :</label>
                <input type="checkbox" id="include_special" name="include_special" checked>
            </div>
            
            <button type="submit" class="generate-btn">Générer les licences</button>
        </form>
        
        <?php
        // Afficher les licences générées si elles existent
        if (isset($_GET['licenses'])) {
            $licenses = unserialize(base64_decode($_GET['licenses']));
            if (is_array($licenses) && !empty($licenses)) {
                echo '<div class="results">';
                echo '<h2>Licences générées :</h2>';
                echo '<div class="licenses-list">';
                foreach ($licenses as $license) {
                    echo '<div class="license-item">' . htmlspecialchars($license) . '</div>';
                }
                echo '</div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</body>
</html>