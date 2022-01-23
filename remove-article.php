<?php

// Démarre une nouvelle session ou reprend une session existante
    session_start();

// Appel de la fonction checkAuthentification
    require 'function/admin-function.php';
    checkAuthentification();

// Appel de la fonction bddConnect
    require 'function/bdd-function.php';
    $bdd= bddConnect();

// Superglobale _GET pour cibler le ID via les paramètres URL
    $id = $_GET["id"];

// Appel de la fonction deleteOne
    require 'function/article-function.php';
    deleteOne($bdd, $id);

// On redirige l'utilisateur sur sa page admin
    header("Location: admin.php");

?>