<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur le Protocole DHCP</title>
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
                    questionElement.innerHTML = "Quel est le mécanisme utilisé par DHCP pour éviter les conflits d'adresses IP ?";
                    radioElements[0].nextSibling.nodeValue = "Enregistrement des adresses IP dans une base de données centrale.";
                    radioElements[1].nextSibling.nodeValue = "Renouvellement périodique des adresses IP.";
                    radioElements[2].nextSibling.nodeValue = "Utilisation de baux DHCP avec une durée limitée.";
                    radioElements[3].nextSibling.nodeValue = "Attribution d'adresses IP statiques à chaque appareil.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "c"; 
                    radioElements[1].value = "a";// Réponse correcte
                    radioElements[2].value = "b";
                    radioElements[3].value = "d";
                    break;
                case 3:
                    questionElement.innerHTML = "Quel est le port utilisé par le protocole DHCP pour les communications ?";
                    radioElements[0].nextSibling.nodeValue = "Port 80";
                    radioElements[1].nextSibling.nodeValue = "Port 443";
                    radioElements[2].nextSibling.nodeValue = "Port 53";
                    radioElements[3].nextSibling.nodeValue = "Port 67/68";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "d"; 
                    radioElements[1].value = "b";
                    radioElements[2].value = "c";
                    radioElements[3].value = "a";// Réponse correcte
                    break;
                case 4:
                    questionElement.innerHTML = "Quelle est la conséquence d'une panne du serveur DHCP ?";
                    radioElements[0].nextSibling.nodeValue = "Tous les appareils perdent leur connexion réseau.";
                    radioElements[1].nextSibling.nodeValue = "Les adresses IP attribuées expireront et les appareils devront redemander une adresse.";
                    radioElements[2].nextSibling.nodeValue = "Les appareils conserveront leurs adresses IP actuelles jusqu'à la résolution du problème.";
                    radioElements[3].nextSibling.nodeValue = "Le serveur DNS prendra en charge la distribution des adresses IP.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "b"; 
                    radioElements[1].value = "c";// Réponse correcte
                    radioElements[2].value = "a";
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
            popupText.innerHTML = "Bravo, tu es désormais un expert du protocole DHCP !<br>Veux-tu retourner aux sections ou en savoir plus sur le protocole DHCP ?";
            
            // Ajout du bouton "En savoir plus sur ce protocole"
            var learnMoreButton = document.createElement('button');
            learnMoreButton.innerHTML = "En savoir plus sur ce protocole";
            learnMoreButton.onclick = function() {
                // Redirection vers la page d'informations DHCP lorsque le bouton est cliqué
                window.location.href = "en_savoir_plus_dhcp.php";
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
    <h1>Quiz sur le Protocole DHCP</h1>
    <form onsubmit="submitForm(event)">
        <p>Quelle est la fonction principale du protocole DHCP (Dynamic Host Configuration Protocol) ?</p>
        <input type="radio" name="reponse" value="a"> Attribution dynamique des adresses IP aux appareils du réseau.<br>
        <input type="radio" name="reponse" value="b"> Routage des paquets de données sur Internet.<br>
        <input type="radio" name="reponse" value="c"> Traduction des noms de domaine en adresses IP.<br>
        <input type="radio" name="reponse" value="d"> Chiffrement des communications réseau pour assurer la confidentialité des données.<br>
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
