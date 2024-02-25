<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once('includes/functions.php');

// Récupérer le score total de l'utilisateur connecté
$totalScore = getUserTotalScore($_SESSION['username']);

// Récupérer tous les utilisateurs avec leurs scores totaux
$users = getUsersWithTotalScores();

// Trier les utilisateurs par score total décroissant
usort($users, function($a, $b) {
    return $b['total_score'] - $a['total_score'];
});
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <h1>Accueil</h1>

    <!-- Section pour afficher le score de l'utilisateur -->
    <section>
        <h2>Votre score total :</h2>
        <p><?php echo $totalScore; ?></p>
    </section>

    <!-- Section pour afficher le classement des scores -->
    <section>
        <h2>Classement des scores totaux :</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom de l'utilisateur</th>
                    <th>Score Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $userData): ?>
                    <tr>
                        <td><?php echo $userData['username']; ?></td>
                        <td><?php echo $userData['total_score']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <a href="play.php?level=1&restart=true">Niveau 1</a>
    <a href="play.php?level=2&restart=true">Niveau 2</a>
    <a href="play.php?level=3&restart=true">Niveau 3</a>

    <a href="logout.php">Déconnexion</a>
</body>
</html>
