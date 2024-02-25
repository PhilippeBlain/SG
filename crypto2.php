<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification du Message Déchiffré</title>
</head>
<body>
    <h2>Vérification du Message Déchiffré</h2>
    
    <?php
    // Fonction de déchiffrement
    function dechiffrerMessage($message, $methode) {
        switch ($methode) {
            case 'Caesar':
                $decalage = 3; // Décalage pour le chiffrement Caesar
                return dechiffrerCaesar($message, $decalage);
            // Ajoutez d'autres méthodes de déchiffrement ici si nécessaire
            default:
                return "Méthode de déchiffrement non reconnue.";
        }
    }

    // Fonction pour déchiffrer le chiffrement Caesar
    function dechiffrerCaesar($message, $decalage) {
        $alphabet = range('A', 'Z');
        $dechiffre = '';
        
        // Pour chaque caractère dans le message
        for ($i = 0; $i < strlen($message); $i++) {
            $caractere = $message[$i];
            
            // Si c'est une lettre majuscule, déchiffrez-la
            if (ctype_upper($caractere)) {
                // Trouvez la position du caractère dans l'alphabet
                $position = array_search($caractere, $alphabet);
                
                // Déchiffrez en appliquant le décalage
                $position = ($position - $decalage + 26) % 26;
                
                // Ajoutez le caractère déchiffré à la chaîne de sortie
                $dechiffre .= $alphabet[$position];
            } else {
                // Conservez le caractère tel quel s'il n'est pas une lettre majuscule
                $dechiffre .= $caractere;
            }
        }
        
        return $dechiffre;
    }

    // Vérification du message déchiffré
    if (isset($_POST['message_chiffre'])) {
        // Le message chiffré saisi par l'utilisateur
        $message_chiffre = strtoupper($_POST['message_chiffre']);
        
        // Le message original attendu
        $message_original = 'HELLO WORLD';
        
        // Méthode de déchiffrement utilisée
        $methode = 'Caesar';
        
        // Déchiffrement du message
        $message_dechiffre = dechiffrerMessage($message_chiffre, $methode);
        
        // Vérification du message déchiffré
        if ($message_dechiffre === $message_original) {
            echo '<p style="color: green;">Le message déchiffré est correct !</p>';
        } else {
            echo '<p style="color: red;">Le message déchiffré est incorrect.</p>';
        }
    }
    ?>

    <!-- Formulaire pour saisir le message chiffré -->
    <form action="" method="post">
        <label for="message_chiffre">Message Chiffré :</label><br>
        <input type="text" id="message_chiffre" name="message_chiffre" required><br><br>
        <input type="submit" value="Vérifier">
    </form>
    
    <p><strong>Méthode de Déchiffrement :</strong> Chiffrement de César (Décalage de 3)</p>
    <p><strong>Message Original Attendu :</strong> HELLO WORLD</p>
</body>
</html>
