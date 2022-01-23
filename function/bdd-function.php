<?php

// Connexion à la BDD
    function bddConnect(){
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=le_progres;charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        } 
// En cas d'erreur de connexion   
        catch (\Exception $e){
            echo('Impossible de se connecter ! ');
            throw $e;
        }
    }

?>