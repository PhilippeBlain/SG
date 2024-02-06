<?php
// Paramètres de connexion à la base de données
$serveur = "193.203.168.3"; // Adresse IP du serveur MySQL distant
$utilisateur = "u677866956_compte_prod"; // Remplacez par votre nom d'utilisateur MySQL
$motdepasse = "!bEn7eS76=R%"; // Remplacez par votre mot de passe MySQL
$nom_bd = "u677866956_prod"; // Nom de votre base de données en ligne

// Connexion à la base de données
$connexion = new mysqli($serveur, $utilisateur, $motdepasse, $nom_bd);

// Vérification de la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Requête de sélection pour tester
$query = "SELECT * FROM utilisateurs";
$result = $connexion->query($query);

// Affichage des résultats
echo "<h2>Résultats de la requête :</h2>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Identifiant: " . $row["identifiant"] . "<br>";
        echo "Mot de passe: " . $row["motdepasse"] . "<br>";
        echo "Adresse mail: " . $row["adresse_mail"] . "<br>";
        echo "Argent: " . $row["argent"] . "<br>";
        echo "XP: " . $row["XP"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "Aucun résultat trouvé.";
}

// Fermeture de la connexion
$connexion->close();
?>
