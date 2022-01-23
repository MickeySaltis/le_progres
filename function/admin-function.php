<?php

// Fonction appel un seul admin via son USERNAME
    function getUserByUsername($bdd, $username){
        $query = $bdd->prepare('SELECT * FROM admin WHERE username = :username');
        $query->execute(['username' => $username]);

        $resultat = $query->fetch();
        return $resultat;

    }

// Fonction qui vérifie qu'il y a une valeur dans la superglobale $_SESSION, sinon renvoie sur la page admin-login.php
    function checkAuthentification(){   
        if(!isset($_SESSION["utilisateur"])) {
                header("Location: admin-login.php");
            }
    }
?>