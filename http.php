<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur le Protocole HTTP</title>
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
                    questionElement.innerHTML = "Quelle méthode HTTP est utilisée par un navigateur lorsqu'un utilisateur soumet un formulaire en ligne ?";
                    radioElements[0].nextSibling.nodeValue = " GET";
                    radioElements[1].nextSibling.nodeValue = " POST";
                    radioElements[2].nextSibling.nodeValue = " PUT";
                    radioElements[3].nextSibling.nodeValue = " DELETE";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "b"; 
                    radioElements[1].value = "a";// Réponse correcte
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;
                case 3:
                    questionElement.innerHTML = "Quelle est la signification du code de statut HTTP '404 Not Found' ?";
                    radioElements[0].nextSibling.nodeValue = " La requête a été acceptée et traitée avec succès.";
                    radioElements[1].nextSibling.nodeValue = " Le serveur a rencontré une erreur interne.";
                    radioElements[2].nextSibling.nodeValue = " La ressource demandée n'a pas été trouvée sur le serveur.";
                    radioElements[3].nextSibling.nodeValue = " La requête nécessite une authentification.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[1].value = "c"; 
                    radioElements[0].value = "b";
                    radioElements[2].value = "a";    // Réponse correcte
                    radioElements[3].value = "d";
                    break;
                    case 4:
    questionElement.innerHTML = "Quelle est l'une des formes courantes d'attaque contre les applications Web qui exploite les failles de sécurité des sites HTTP ?";
    radioElements[0].nextSibling.nodeValue = "Injection SQL";
    radioElements[1].nextSibling.nodeValue = "Cross-Site Scripting (XSS)";
    radioElements[2].nextSibling.nodeValue = "Attaque par force brute";
    radioElements[3].nextSibling.nodeValue = "Attaque par déni de service (DDoS)";
    // Mettez à jour la réponse correcte et les mauvaises réponses
    radioElements[0].value = "b"; 
    radioElements[1].value = "a"; // Réponse correcte
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
            popupText.innerHTML = "Bravo, tu es désormais un expert du protocole HTTP !<br>Voulez-vous retourner aux sections ou en savoir plus sur le protocole HTTP ?";
            
            // Ajout du bouton "En savoir plus sur ce protocole"
            var learnMoreButton = document.createElement('button');
            learnMoreButton.innerHTML = "En savoir plus sur ce protocole";
            learnMoreButton.onclick = function() {
                // Redirection vers la page d'informations HTTP lorsque le bouton est cliqué
                window.location.href = "en_savoir_plus_http.php";
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
    <h1>Quiz sur le Protocole HTTP</h1>
    <form onsubmit="submitForm(event)">
        <p>Qu'est-ce que l'acronyme HTTP signifie ?</p>
        <input type="radio" name="reponse" value="c"> HyperText Transfer Process<br>
        <input type="radio" name="reponse" value="a"> HyperText Transfer Protocol<br>
        <input type="radio" name="reponse" value="b"> HyperText Transmission Process<br>
        <input type="radio" name="reponse" value="d"> HyperText Transmission Protocol<br>
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
