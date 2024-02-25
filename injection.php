<?php
// Connexion à la base de données SQLite
$db = new PDO('sqlite:database.db');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Défi de la Bibliothèque Numérique</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .confidential { color: red; }
        .result { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Défi de la Bibliothèque Numérique - Injection SQL</h1>

    <!-- Contexte du challenge -->
    <div class="context">
    Bienvenue dans le défi de la bibliothèque numérique ! Vous êtes un jeune stagiaire chargé d'effectuer un audit de sécurité sur le système de recherche de livres. La base de données "bibliotheque.db" contient une table "books" avec des informations sur des ouvrages classiques tels que <strong>Le Petit Prince</strong>, <strong>1984</strong>, et <strong>Le Seigneur des Anneaux</strong>.</p> Nous avons inséré des informations "confidentielles" dans notre base de données, simulant des données sensibles.</p>
        <p>Votre objectif est d'utiliser vos compétences en matière d'injection SQL pour retrouver le titre d'au moins un de ces ouvrages confidentiels. </p>
        <p>Utilisez le formulaire de recherche pour tester la vulnérabilité et le formulaire de vérification pour confirmer la découverte d'un ouvrage confidentiel. Bonne chance !</p>

        Indice : La recherche de livre est déja définit par le commande " SELECT * FROM books WHERE title LIKE '% "
        <br>
        Une condition peut être toujours valide 
    </div>

    <!-- Formulaire de recherche -->
    <form method="get">
        <input type="text" name="search" placeholder="Rechercher un livre...">
        <input type="submit" value="Rechercher">
    </form>

    <?php
    // Vérifie si le formulaire de recherche a été soumis
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        // Requête de base vulnérable à l'injection SQL
        $sql = "SELECT * FROM books WHERE title LIKE '%$search%'";

        echo "<h2>Résultats pour: " . htmlspecialchars($search) . "</h2><div class='result'>";

        // Exécution de la requête
        $result = $db->query($sql);

        // Affichage des résultats
        if ($result) {
            foreach ($result as $row) {
                echo "<p>" . htmlspecialchars($row['title']) . " par " . htmlspecialchars($row['author']) . "</p>";
            }
        } else {
            echo "<p>Aucun résultat trouvé.</p>";
        }

        echo "</div>";
    }
    ?>

    <!-- Formulaire de vérification -->
    <form method="get">
        <input type="text" name="verify" placeholder="Nom de l'ouvrage confidentiel découvert...">
        <input type="submit" value="Vérifier">
    </form>

    <?php
    // Vérification de la découverte d'un ouvrage confidentiel
    if (isset($_GET['verify'])) {
        $verify = $_GET['verify'];
        $confidentialTitles = ['Projet Secret Alpha', 'Mémoires d\'un Bibliothécaire', 'Guide de Sécurité Interne'];
        
        if (in_array($verify, $confidentialTitles)) {
            echo "<div><strong>Bravo !</strong> Vous avez découvert un ouvrage confidentiel : " . htmlspecialchars($verify) . "</div>";
        } else {
            echo "<div>Désolé, " . htmlspecialchars($verify) . " n'est pas un des ouvrages confidentiels recherchés.</div>";
        }
    }
    ?>
</body>
</html>
