<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur les injections SQL</title>
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
                    questionElement.innerHTML = "Quelles sont les conséquences possibles d'une injection SQL réussie ?";
                    radioElements[0].nextSibling.nodeValue = " Vol de données personnelles.";
                    radioElements[1].nextSibling.nodeValue = " Exécution de code arbitraire sur le serveur.";
                    radioElements[2].nextSibling.nodeValue = " Suppression ou altération de données dans la base de données.";
                    radioElements[3].nextSibling.nodeValue = " Toutes les réponses ci-dessus.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[3].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[1].value = "c";
                    radioElements[2].value = "d";
                    break;
                case 3:
                    questionElement.innerHTML = "Comment les attaquants exploitent-ils généralement les vulnérabilités d'injection SQL ?";
                    radioElements[0].nextSibling.nodeValue = " En envoyant des requêtes malicieuses à une application Web qui interagit avec une base de données.";
                    radioElements[1].nextSibling.nodeValue = " En infectant les serveurs avec des logiciels malveillants qui compromettent les données.";
                    radioElements[2].nextSibling.nodeValue = " En accédant physiquement aux serveurs et en volant des informations sensibles.";
                    radioElements[3].nextSibling.nodeValue = " En envoyant des e-mails de phishing pour tromper les utilisateurs et obtenir leurs informations d'identification.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "a"; // Correct answer
                    radioElements[1].value = "b";
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;
                case 4:
                    questionElement.innerHTML = "Quelles sont les principales méthodes pour prévenir les attaques par injection SQL ?";
                    radioElements[0].nextSibling.nodeValue = " Éviter l'utilisation de bases de données dans les applications Web.";
                    radioElements[1].nextSibling.nodeValue = " Utiliser des pare-feu pour bloquer les requêtes suspectes.";
                    radioElements[2].nextSibling.nodeValue = " Utiliser des requêtes préparées ou des ORM (Object-Relational Mapping).";
                    radioElements[3].nextSibling.nodeValue = " Renforcer les mots de passe pour les bases de données.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[2].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[1].value = "c";
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
            popupText.innerHTML = "Bravo, tu es désormais un expert des attaques par injection SQL.<br>Voulez-vous retourner aux sections ou en savoir plus sur les injections SQL ?";
            
            // Ajout du bouton "En savoir plus sur ces attaques"
            var learnMoreButton = document.createElement('button');
            learnMoreButton.innerHTML = "En savoir plus sur ces attaques";
            learnMoreButton.onclick = function() {
                // Redirection vers la page d'informations sur les injections SQL lorsque le bouton est cliqué
                window.location.href = "en_savoir_plus_injections_sql.php";
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
    <h1>Quiz sur les injections SQL</h1>
    <form onsubmit="submitForm(event)">
        <p>Qu'est-ce qu'une injection SQL ?</p>
        <input type="radio" name="reponse" value="c"> Injection de données non sécurisées dans une base de données.<br>
        <input type="radio" name="reponse" value="b"> Introduction de code malveillant dans un serveur de messagerie.<br>
        <input type="radio" name="reponse" value="a"> Injection de code SQL malveillant dans une requête pour compromettre une base de données.<br>
        <input type="radio" name="reponse" value="d"> Introduction de virus dans une application Web.<br>
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
