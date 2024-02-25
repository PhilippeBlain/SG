<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include_once('includes/functions.php');

$currentLevel = $_GET['level'] ?? 1;
$questions = loadQuestions($currentLevel);

// Si l'utilisateur décide de recommencer le niveau, réinitialiser le score
if (isset($_GET['restart']) && $_GET['restart'] === 'true') {
    // Stocker le score précédent dans une variable de session
    $_SESSION['previous_score'] = getUserLevelScore($_SESSION['username'], $currentLevel);
    
    // Réinitialiser le score du niveau à 0
    updateUserLevelScore($_SESSION['username'], $currentLevel, 0);
    $score = 0;
} else {
    $score = getUserLevelScore($_SESSION['username'], $currentLevel);
}

$questionIndex = isset($_GET['question']) ? $_GET['question'] : 0;

if (isset($_POST['answer'])) {
    $selectedAnswer = $_POST['answer'];
    $isPhishing = $questions[$questionIndex]['est_phishing'];

    if (($selectedAnswer == 'phishing' && $isPhishing) || ($selectedAnswer == 'normal' && !$isPhishing)) {
        $score += 5;
        $result = "Correct! +5 points";
    } else {
        $score -= 2;
        $result = "Incorrect! -2 points";
    }

    updateUserLevelScore($_SESSION['username'], $currentLevel, $score);

    // Passer à la prochaine question si ce n'est pas la dernière
    if ($questionIndex < count($questions) - 1 && $questionIndex < 9) {
        $questionIndex++;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Jouer</title>
</head>
<body>
<h1>Niveau <?php echo $currentLevel; ?></h1>
<p>Votre score actuel pour ce niveau : <?php echo $score; ?></p>

<?php if ($questionIndex < count($questions) - 1 && $questionIndex < 9): ?>
    <div>
        <p><?php echo $questions[$questionIndex]['sujet']; ?></p>
        <p><?php echo $questions[$questionIndex]['corps']; ?></p>
        <a href="<?php echo $questions[$questionIndex]['lien']; ?>" target="_blank">Lien</a>
        <form action="play.php?level=<?php echo $currentLevel; ?>&question=<?php echo $questionIndex; ?>" method="post">
            <input type="radio" name="answer" value="phishing"> Phishing
            <input type="radio" name="answer" value="normal"> Normal
            <button type="submit">Suivant</button>
        </form>
    </div>
<?php else: ?>
    <div>
        <p>Vous avez répondu à toutes les questions de ce niveau.</p>
        <!-- Ajouter un lien pour recommencer le niveau -->
        <a href="play.php?level=<?php echo $currentLevel; ?>&restart=true">Recommencer le niveau</a>
        <a href="index.php">Accueil</a>
        <a href="logout.php">Déconnexion</a>
    </div>
    <?php
    // Si toutes les questions du niveau ont été répondues
    if ($questionIndex >= count($questions) - 1 || $questionIndex >= 9) {
        // Si le score actuel est inférieur au score précédent
        $previousScore = isset($_SESSION['previous_score']) ? $_SESSION['previous_score'] : 0;
        $scoreToBeat = max($previousScore, $score); // Le score à battre est le plus élevé entre le score précédent et le score actuel

        echo "<p>Score à battre : $scoreToBeat</p>";
        
        // Si le score actuel est inférieur au score à battre, mettre à jour le score du niveau avec le score à battre
        if ($score < $scoreToBeat) {
            updateUserLevelScore($_SESSION['username'], $currentLevel, $scoreToBeat);
        }

        // Réinitialiser la variable de session pour le score précédent
        unset($_SESSION['previous_score']);
    }
    ?>
<?php endif; ?>

</body>
</html>
