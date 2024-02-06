<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz sur le Protocole ARP</title>
    <style>
        /* Style pour le pop-up */
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
                    questionElement.innerHTML = "Qu'est-ce qu'une attaque ARP?";
                    radioElements[0].nextSibling.nodeValue = " Une attaque visant à compromettre les informations stockées dans les cookies d'un navigateur.";
                    radioElements[1].nextSibling.nodeValue = " Une attaque ciblant le protocole de résolution d'adresse pour associer de manière incorrecte des adresses IP à des adresses MAC.";
                    radioElements[2].nextSibling.nodeValue = " Une attaque exploitant les vulnérabilités d'un pare-feu pour accéder à un réseau sécurisé.";
                    radioElements[3].nextSibling.nodeValue = " Une attaque de phishing visant à obtenir des informations sensibles en usurpant l'identité d'un site web.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[1].value = "a"; // Correct answer
                    radioElements[0].value = "b";
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;
                case 3:
                    questionElement.innerHTML = "Quelle est la différence entre ARP (Address Resolution Protocol) et RARP (Reverse Address Resolution Protocol)?";
                    radioElements[0].nextSibling.nodeValue = " ARP est utilisé pour associer des adresses MAC à des adresses IP, tandis que RARP est utilisé pour associer des adresses IP à des adresses MAC.";
                    radioElements[1].nextSibling.nodeValue = " ARP est utilisé pour associer des adresses IP à des adresses MAC, tandis que RARP est utilisé pour résoudre des noms de domaine.";
                    radioElements[2].nextSibling.nodeValue = " ARP est utilisé pour résoudre les adresses IP des serveurs DNS, tandis que RARP est utilisé pour configurer les adresses IP dynamiquement.";
                    radioElements[3].nextSibling.nodeValue = " ARP est utilisé pour router les paquets de données sur un réseau, tandis que RARP est utilisé pour vérifier la fiabilité des connexions réseau.";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "a"; // Correct answer
                    radioElements[1].value = "b";
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;
                case 4:
                    questionElement.innerHTML = "Si une attaque ARP est réalisée, quelle couche OSI est affectée ?";
                    radioElements[0].nextSibling.nodeValue = " Couche physique";
                    radioElements[1].nextSibling.nodeValue = " Couche liaison de données";
                    radioElements[2].nextSibling.nodeValue = " Couche réseau ";
                    radioElements[3].nextSibling.nodeValue = " Couche transport";
                    // Mettez à jour la réponse correcte et les mauvaises réponses
                    radioElements[0].value = "b"; // Correct answer
                    radioElements[1].value = "a";
                    radioElements[2].value = "c";
                    radioElements[3].value = "d";
                    break;

                // Ajoutez d'autres cas pour les questions suivantes au besoin
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

        function submitForm(event) {
            event.preventDefault(); // Empêche le rechargement de la page
            var reponse = document.querySelector('input[name="reponse"]:checked').value;

            // Vérifiez la réponse et affichez le résultat
            if (reponse == "a") { // Check if the selected answer is correct
                document.getElementById('result').innerHTML = "<p>C'est correct !</p>";
                playSound("correct");
                if (currentQuestion < 4) {
                    showPopup();
                } else {
                    closePopup();
                }
            } else {
                document.getElementById('result').innerHTML = "<p>Désolé, c'est incorrect.</p>";
                playSound("incorrect");
            }
        }
    </script>
</head>
<body>
    <h1>Quiz sur le Protocole ARP</h1>
    <form onsubmit="submitForm(event)">
        <p>Qu'est-ce que le protocole ARP (Address Resolution Protocol)?</p>
        <input type="radio" name="reponse" value="c"> Un protocole de sécurité utilisé pour chiffrer les communications réseau.<br>
        <input type="radio" name="reponse" value="b"> Un protocole de routage utilisé pour déterminer le meilleur chemin pour les paquets de données.<br>
        <input type="radio" name="reponse" value="a"> Un protocole de résolution d'adresse utilisé pour associer des adresses IP à des adresses MAC.<br>
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
            <p>Voulez-vous répondre à la prochaine question?</p>
            <button onclick="changeQuestion()">Répondre à la prochaine question</button>
        </div>
    </div>

    <script>
        // Initialisation de la première question
        showNextQuestion();
    </script>
</body>
</html>
