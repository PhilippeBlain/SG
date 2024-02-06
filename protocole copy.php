<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur le Protocole ARP</title>
    <script>
        function playSound(response) {
            var audio = new Audio(response + '.mp3');
            audio.play();
        }
    </script>
</head>
<body>
    <h1>Quiz sur le Protocole ARP</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $reponse = $_POST["reponse"];

        // Vérifiez la réponse et affichez le résultat
        if ($reponse == "b") {
            echo "<p>C'est correct !</p>";
            echo '<script>playSound("correct");</script>';
        } else {
            echo "<p>Désolé, c'est incorrect.</p>";
            echo '<script>playSound("incorrect");</script>';
        }
    }
    ?>
    <form action="protocole.php" method="post">
        <p>Qu'est-ce qu'une attaque ARP?</p>
        <input type="radio" name="reponse" value="a"> Une attaque visant à compromettre les informations stockées dans les cookies d'un navigateur.<br>
        <input type="radio" name="reponse" value="b"> Une attaque ciblant le protocole de résolution d'adresse pour associer de manière incorrecte des adresses IP à des adresses MAC.<br>
        <input type="radio" name="reponse" value="c"> Une attaque exploitant les vulnérabilités d'un pare-feu pour accéder à un réseau sécurisé.<br>
        <input type="radio" name="reponse" value="d"> Une attaque de phishing visant à obtenir des informations sensibles en usurpant l'identité d'un site web.<br>
        <input type="submit" value="Soumettre">
    </form>
</body>
</html>
