<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'])) {
    function crackme($pass)
    {
        $a1 = $a2 = $a3 = '';

        for ($i = 0; $i < strlen($pass); $i++) {
            $a1 .= chr((ord($pass[$i]) + 28) % 256);

            $a2 .= chr(ord($a1[$i]) ^ 226);
        }

        $a3 = base64_encode($a2);

        return ($a3 == "h42DvXW8bLJwro6uc2y9rY5srWtnrWy9ZrJqaq1oYa17");
    }

    $password = $_POST['password'];
    $result = crackme($password) ? 'Bravo!' : 'Incorrect!';
    echo "<script>alert('$result');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image centrée avec texte</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            margin-bottom: 20px; /* Ajout d'une marge en bas pour séparer l'image du formulaire */
        }
        .container img {
            max-width: 100%;
            height: auto;
        }
        form {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Un mot de passe se cache dans l’image ci-dessous, saurez-vous le trouver ? Indice : le mot de passe a pour format ISEC{xxxxxxx}, une fois trouvé, écrivez le mot de passe sur le champ en dessous.</h1>
        <img src="crypto.png" alt="Image">
        <form method="post">
        <div>
            <input type="text" name="password" />
            <input type="submit" value="Envoyer" />
        </div>
    </form>
    </div>
    
   
</body>
</html>

