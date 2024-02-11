<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur les attaques Man-in-the-Middle</title>
    <style>
        /* Styles pour le pop-up */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: white;
            border: 2px solid #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            z-index: 999;
            transition: opacity 0.5s;
            cursor: pointer;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 40px;
        }
    </style>
    <script>
        var currentQuestion = 1;

        function playSound(response) {
            var audio = new Audio(response + '.mp3');
            audio.play();
        }

        function showPopup() {
            var popup = document.getElementById('popup');
            popup.style.display = 'block';
            setTimeout(function() {
                popup.style.opacity = 1;
            }, 10);

            // Ajout de l'événement de clic pour fermer le pop-up
            popup.addEventListener('click', closePopup);
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            popup.style.opacity = 0;
            setTimeout(function() {
                popup.style.display = 'none';
            }, 500); // La transition de fondu dure 0.5 seconde
        }

        function changeQuestion() {
            var popup = document.getElementById('popup');
            popup.style.opacity = 0;
            setTimeout(function() {
                popup.style.display = 'none';
                currentQuestion++;
                showNextQuestion();
            }, 500); // La transition de fondu dure 0.5 seconde
        }

        function showNextQuestion() {
            var questionElement = document.querySelector('p');
            var radioElements = document.querySelectorAll('input[type="radio"]');

            switch (currentQuestion) {
                    case 2:
    questionElement.innerHTML = "Quel est l'effet le plus courant d'une attaque Man-in-the-Middle sur les données échangées ?";
    radioElements[0].nextSibling.nodeValue = " La suppression totale des données échangées.";
    radioElements[1].nextSibling.nodeValue = " L'altération des données pour les rendre incompréhensibles.";
    radioElements[2].nextSibling.nodeValue = " La capture et l'interception des données échangées sans que les parties concernées ne le sachent.";
    radioElements[3].nextSibling.nodeValue = " Le cryptage des données pour empêcher l'accès non autorisé.";
    // Mettez à jour la réponse correcte et les mauvaises réponses
    radioElements[2].value = "a"; // Correct answer
    radioElements[0].value = "b";
    radioElements[1].value = "c";
    radioElements[3].value = "d";
    break;

                    break;
                case 3:
                    questionElement.innerHTML = "Comment un attaquant peut-il réaliser une attaque Man-in-the-Middle ?";
                    radioElements[0].nextSibling.nodeValue = " En interceptant et en capturant les paquets de données transitant entre les deux parties.";
                    radioElements[1].nextSibling.nodeValue = " En utilisant des logiciels malveillants pour corrompre les fichiers de configuration du réseau.";
                    radioElements[2].nextSibling.nodeValue = " En infectant les périphériques réseau avec des virus pour perturber les communications.";
                    radioElements[3].nextSibling.nodeValue = " En piratant les mots de passe des comptes utilisateurs pour accéder aux communications.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "a"; // Correct answer
                    radioElements[1].value = "b";
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;
                case 4:
                    questionElement.innerHTML = "Quelles sont les mesures de sécurité recommandées pour prévenir les attaques Man-in-the-Middle ?";
                    radioElements[0].nextSibling.nodeValue = " Utiliser des connexions Wi-Fi publiques non sécurisées.";
                    radioElements[1].nextSibling.nodeValue = " Activer le chiffrement des données et utiliser des protocoles sécurisés comme HTTPS.";
                    radioElements[2].nextSibling.nodeValue = " Créer des serveurs de back-up";
                    radioElements[3].nextSibling.nodeValue = " Désactiver les pare-feu et les antivirus pour améliorer les performances.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[1].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;
                default:
                    // Si toutes les questions ont été posées, réinitialisez la variable currentQuestion
                    currentQuestion = 1;
                    closePopup(); // Fermer le pop-up si toutes les questions ont été posées
                    break;
            }

            // Réinitialisez la sélection des réponses
            for (var i = 0; i < radioElements.length; i++) {
                radioElements[i].checked = false;
            }
        }

        function popupButtonClick() {
            if (currentQuestion < 4) {
                changeQuestion();
            } else {
                showPopupFinal();
            }
        }

        function showPopupFinal() {
            var popupButton = document.getElementById('popup-button');
            popupButton.innerHTML = "Retourner aux sections";
            
            // Redirection vers la page "section.php" lorsque le bouton "Retourner aux sections" est cliqué
            popupButton.onclick = function() {
                window.location.href = "section.php";
            };

            var popupText = document.getElementById('popup-text');
            popupText.innerHTML = "Bravo, tu es désormais un expert des attaques Man-in-the-Middle.<br>Voulez-vous retourner aux sections ou en savoir plus sur ces attaques ?";
            
            // Ajout du bouton "En savoir plus sur ces attaques"
            var learnMoreButton = document.createElement('button');
            learnMoreButton.innerHTML = "En savoir plus sur ces attaques";
            learnMoreButton.onclick = function() {
                // Redirection vers la page d'informations sur les attaques Man-in-the-Middle lorsque le bouton est cliqué
                window.location.href = "en_savoir_plus_mitm.php";
            };
            popupText.appendChild(document.createElement('br'));
            popupText.appendChild(learnMoreButton);

            showPopup();
        }

        function submitForm(event) {
            event.preventDefault(); // Empêche le rechargement de la page
            var reponse = document.querySelector('input[name="reponse"]:checked').value;

            // Vérifiez la réponse et affichez le résultat
            if (reponse == "a") { // Vérifie si la réponse sélectionnée est correcte
                document.getElementById('result').innerHTML = "<p>C'est correct !</p>";
                playSound("correct");
                if (currentQuestion < 4) {
                    showPopup();
                } else {
                    showPopupFinal();
                }
            } else {
                document.getElementById('result').innerHTML = "<p>Désolé, c'est incorrect.</p>";
                playSound("incorrect");
            }
        }
    </script>
</head>
<body>
    <h1>Quiz sur les attaques Man-in-the-Middle</h1>
    <form onsubmit="submitForm(event)">
        <p>Qu'est-ce qu'une attaque Man-in-the-Middle ?</p>
        <input type="radio" name="reponse" value="c"> Une attaque qui utilise des logiciels malveillants pour altérer les données d'un serveur.<br>
        <input type="radio" name="reponse" value="b"> Une attaque qui perturbe les communications sans intercepter les données.<br>
        <input type="radio" name="reponse" value="a"> Une attaque où un attaquant intercepte et altère les communications entre deux parties.<br>
        <input type="radio" name="reponse" value="d"> Une attaque qui détruit les connexions réseau en saturant les serveurs.<br>
        <input type="submit" value="Soumettre">
    </form>

    <!-- Afficher le résultat sans recharger la page -->
    <div id="result"></div>

    <!-- Le pop-up -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h1>Félicitations !</h1>
            <div id="popup-text">
                <!-- Le texte du pop-up variera en fonction de la situation -->
            </div>
            <button id="popup-button" onclick="popupButtonClick()">Répondre à la prochaine question</button>
        </div>
    </div>

    <script>
        // Initialisation de la première question
        showNextQuestion();
    </script>
</body>
</html>
