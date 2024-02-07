<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur le Protocole DNS</title>
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
                    questionElement.innerHTML = "Quelle est la fonction principale du protocole DNS ?";
                    radioElements[0].nextSibling.nodeValue = " Gérer les connexions réseau sécurisées entre les serveurs.";
                    radioElements[1].nextSibling.nodeValue = " Déterminer le type de données à transmettre sur le réseau.";
                    radioElements[2].nextSibling.nodeValue = " Mapper des adresses IP à des adresses MAC.";
                    radioElements[3].nextSibling.nodeValue = " Traduire les noms de domaine en adresses IP.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[3].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[1].value = "c";
                    radioElements[2].value = "d";
                    break;
                case 3:
                    questionElement.innerHTML = "Quel est le rôle d'un serveur DNS ?";
                    radioElements[0].nextSibling.nodeValue = " Gérer les connexions VPN sur le réseau.";
                    radioElements[1].nextSibling.nodeValue = " Fournir des services de messagerie électronique.";
                    radioElements[2].nextSibling.nodeValue = " Stocker des fichiers multimédias pour un accès en ligne.";
                    radioElements[3].nextSibling.nodeValue = " Répondre aux requêtes de résolution de noms de domaine en traduisant les noms de domaine en adresses IP.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[3].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[1].value = "c";
                    radioElements[2].value = "d";
                    break;
                case 4:
                    questionElement.innerHTML = "Quelle est la différence entre les enregistrements DNS de type A et de type CNAME ?";
                    radioElements[0].nextSibling.nodeValue = " Les enregistrements de type A sont utilisés pour associer un nom de domaine à une adresse IP, tandis que les enregistrements de type CNAME sont utilisés pour créer un alias pour un autre nom de domaine.";
                    radioElements[1].nextSibling.nodeValue =  " Les enregistrements de type A sont utilisés pour gérer les adresses IP dynamiques, tandis que les enregistrements de type CNAME sont utilisés pour les adresses IP statiques.";
                    radioElements[2].nextSibling.nodeValue =  " Les enregistrements de type A sont utilisés pour les serveurs de messagerie, tandis que les enregistrements de type CNAME sont utilisés pour les serveurs de base de données.";
                    radioElements[3].nextSibling.nodeValue = " Les enregistrements de type A sont utilisés pour les serveurs web, tandis que les enregistrements de type CNAME sont utilisés pour les serveurs de fichiers.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "a"; // Correct answer
                    radioElements[1].value = "b";
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;
                case 5:
                    questionElement.innerHTML = "Quel est l'effet principal d'une attaque de détournement DNS ?";
                    radioElements[0].nextSibling.nodeValue = " Redirection des utilisateurs vers des sites Web malveillants.";
                    radioElements[1].nextSibling.nodeValue =  " Modification des enregistrements DNS pour bloquer l'accès à certains sites légitimes.";
                    radioElements[2].nextSibling.nodeValue =  " Interception du trafic Internet pour voler des informations sensibles ";
                    radioElements[3].nextSibling.nodeValue = " Création de faux enregistrements DNS pour rediriger le trafic vers des serveurs compromis. ";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "a"; // Correct answer
                    radioElements[1].value = "b";
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
            if (currentQuestion < 5) {
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
            popupText.innerHTML = "Bravo, tu es désormais un vrai professionnel du protocole DNS.<br>Voulez-vous retourner aux sections ou en savoir plus sur le protocole DNS ?";
            
            // Ajout du bouton "En savoir plus sur ce protocole"
            var learnMoreButton = document.createElement('button');
            learnMoreButton.innerHTML = "En savoir plus sur ce protocole";
            learnMoreButton.onclick = function() {
                // Redirection vers la page d'informations DNS lorsque le bouton est cliqué
                window.location.href = "en_savoir_plus_dns.php";
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
                if (currentQuestion < 5) {
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
    <h1>Quiz sur le Protocole DNS</h1>
    <form onsubmit="submitForm(event)">
        <p>Qu'est-ce que le protocole DNS (Domain Name System) ?</p>
        <input type="radio" name="reponse" value="c"> Un protocole de sécurité utilisé pour chiffrer les communications réseau.<br>
        <input type="radio" name="reponse" value="b"> Un protocole de routage utilisé pour déterminer le meilleur chemin pour les paquets de données.<br>
        <input type="radio" name="reponse" value="a"> Un protocole de résolution d'adresse utilisé pour associer des noms de domaine à des adresses IP.<br>
        <input type="radio" name="reponse" value="d"> Un protocole de transfert de fichiers utilisé pour copier des données entre des serveurs distants.<br>
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
