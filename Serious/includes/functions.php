<?php

// Fonction pour charger les questions d'un niveau donné
function loadQuestions($level) {
    $file = "data/niveau$level.json";
    if (file_exists($file)) {
        $questions = json_decode(file_get_contents($file), true);
    } else {
        $questions = array();
    }
    return $questions;
}

// Fonction pour vérifier si un utilisateur existe
function userExists($username) {
    $users = getUsers();
    return isset($users[$username]);
}

// Fonction pour vérifier les informations d'identification de l'utilisateur
function verifyUser($username, $password) {
    $users = getUsers();
    if (isset($users[$username])) {
        return password_verify($password, $users[$username]['password']);
    }
    return false;
}

// Fonction pour récupérer les utilisateurs
function getUsers() {
    $file = "users/user.json";
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
    } else {
        $users = array();
    }
    return $users;
}

// Fonction pour enregistrer les utilisateurs
function saveUsers($users) {
    $file = "users/user.json";
    file_put_contents($file, json_encode($users));
}

// Fonction pour mettre à jour le score total d'un utilisateur
function updateUserTotalScore($username) {
    $users = getUsers();
    if (isset($users[$username])) {
        $level1Score = getUserLevelScore($username, 1);
        $level2Score = getUserLevelScore($username, 2);
        $level3Score = getUserLevelScore($username, 3);

        $totalScore = $level1Score + $level2Score + $level3Score;

        $users[$username]['total_score'] = $totalScore;
        saveUsers($users);
    }
}

// Fonction pour récupérer le score total d'un utilisateur
function getUserTotalScore($username) {
    $users = getUsers();
    if (isset($users[$username]['total_score'])) {
        return $users[$username]['total_score'];
    }
    return 0;
}

// Fonction pour mettre à jour le score d'un utilisateur pour un niveau donné
function updateUserLevelScore($username, $level, $score) {
    $users = getUsers();
    if (isset($users[$username])) {
        $users[$username]['scores'][$level] = $score;
        saveUsers($users);

        // Mettre à jour le score total après chaque mise à jour du score de niveau
        updateUserTotalScore($username);
    }
}

// Fonction pour récupérer le score d'un utilisateur pour un niveau donné
function getUserLevelScore($username, $level) {
    $users = getUsers();
    if (isset($users[$username]['scores'][$level])) {
        return $users[$username]['scores'][$level];
    }
    return 0;
}

// Fonction pour récupérer les scores d'un utilisateur pour tous les niveaux
function getUserLevelScores($username) {
    $users = getUsers();
    if (isset($users[$username]['scores'])) {
        return $users[$username]['scores'];
    }
    return array();
}

// Fonction pour ajouter un nouvel utilisateur
function addUser($user) {
    $users = getUsers();
    $users[$user['username']] = $user;
    saveUsers($users);
}
// Fonction pour récupérer les utilisateurs avec leurs scores totaux
function getUsersWithTotalScores() {
    $file = "users/user.json";
    if (file_exists($file)) {
        $users = json_decode(file_get_contents($file), true);
        foreach ($users as $username => $userData) {
            $totalScore = isset($userData['total_score']) ? $userData['total_score'] : 0;
            $users[$username]['total_score'] = $totalScore;
        }
    } else {
        $users = array();
    }
    return $users;
}

?>
