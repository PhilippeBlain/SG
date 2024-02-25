<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur les attaques DDoS</title>
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
                    questionElement.innerHTML = "Quel est l'objectif principal d'une attaque DDoS?";
                    radioElements[0].nextSibling.nodeValue = " Voler des informations personnelles.";
                    radioElements[1].nextSibling.nodeValue = " Modifier les données stockées sur un serveur.";
                    radioElements[2].nextSibling.nodeValue = " Saboter les opérations d'un site web ou d'un service en ligne en le submergeant de trafic illégitime.";
                    radioElements[3].nextSibling.nodeValue = " Exécuter des programmes malveillants sur les appareils des utilisateurs.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[2].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[1].value = "c";
                    radioElements[3].value = "d";
                    break;
                    case 3:
    questionElement.innerHTML = "Quelle est la différence entre une attaque DoS et une attaque DDoS ?";
    radioElements[0].nextSibling.nodeValue = " Une attaque DoS cible un seul point de service, tandis qu'une attaque DDoS implique plusieurs sources d'attaque.";
    radioElements[1].nextSibling.nodeValue = " Une attaque DoS est moins dangereuse qu'une attaque DDoS en termes de perturbation des services en ligne.";
    radioElements[2].nextSibling.nodeValue = " Une attaque DoS est plus difficile à détecter qu'une attaque DDoS.";
    radioElements[3].nextSibling.nodeValue = " Une attaque DoS est plus sophistiquée techniquement qu'une attaque DDoS.";
    // Mettez à jour la réponse correcte et les mauvaises réponses
    radioElements[0].value = "a"; // Correct answer
    radioElements[1].value = "b";
    radioElements[2].value = "c";
    radioElements[3].value = "d";
    break;

                case 4:
                    questionElement.innerHTML = "Quels sont les types courants de méthodes utilisées dans les attaques DDoS ?";
                    radioElements[0].nextSibling.nodeValue = " Attaques de phishing.";
                    radioElements[1].nextSibling.nodeValue = " Attaques de force brute.";
                    radioElements[2].nextSibling.nodeValue = " Attaques par injection SQL.";
                    radioElements[3].nextSibling.nodeValue = " Attaques de saturation et d'amplification.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[3].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[1].value = "c";
                    radioElements[2].value = "d";
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
            popupText.innerHTML = "Bravo, tu es désormais un expert des attaques DDoS.<br>Voulez-vous retourner aux sections ou en savoir plus sur les attaques DDoS ?";
            
            // Ajout du bouton "En savoir plus sur ces attaques"
            var learnMoreButton = document.createElement('button');
            learnMoreButton.innerHTML = "En savoir plus sur ces attaques";
            learnMoreButton.onclick = function() {
                // Redirection vers la page d'informations DDoS lorsque le bouton est cliqué
                window.location.href = "en_savoir_plus_ddos.php";
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
    <h1>Quiz sur les attaques DDoS</h1>
    <form onsubmit="submitForm(event)">
        <p>Qu'est-ce qu'une attaque DDoS (Distributed Denial of Service) ?</p>
        <input type="radio" name="reponse" value="c"> Destruction de Données sur le Système.<br>
        <input type="radio" name="reponse" value="b"> Déconnexion Directe du Système.<br>
        <input type="radio" name="reponse" value="a"> Déni de service distribué<br>
        <input type="radio" name="reponse" value="d"> Double Débordement de Système.<br>
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
