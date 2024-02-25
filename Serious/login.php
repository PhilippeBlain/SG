<?php
session_start();
include_once('includes/functions.php');

// Vérifie si l'utilisateur est déjà connecté
if(isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Si le formulaire de création d'utilisateur est soumis
if(isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifie si l'utilisateur existe déjà
    if(userExists($username)) {
        $error = "L'utilisateur existe déjà. Veuillez choisir un autre nom d'utilisateur.";
    } else {
        // Crée un nouvel utilisateur
        $user = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'scores' => array('1' => 0, '2' => 0, '3' => 0) // Initialiser les scores à 0 pour chaque niveau
        );

        // Ajoute l'utilisateur à la base de données
        addUser($user);

        // Connecte automatiquement l'utilisateur après la création de compte
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    }
}

// Si le formulaire de connexion est soumis
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifie si l'utilisateur existe et si le mot de passe est correct
    if(verifyUser($username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if(isset($error)): ?>
    <p><?php echo $error; ?></p>
    <?php endif; ?>
    <h2>Créer un compte</h2>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit" name="create">Créer un compte</button>
    </form>
    <h2>Se connecter</h2>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit" name="login">Se connecter</button>
    </form>
</body>
</html>
