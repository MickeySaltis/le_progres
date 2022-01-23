<?php

// Démarre une nouvelle session ou reprend une session existante
    session_start();

// Appel de la fonction bddConnect
    require 'function/bdd-function.php';
    $bdd= bddConnect();

// Connexion à admin-function
    require 'function/admin-function.php';  
    
    

// Conditions d'erreurs

    $errors=[];

    // Soumettre le Formulaire
    if($_SERVER["REQUEST_METHOD"] == 'POST'){

        // Username non rempli
        if(empty($_POST["username"])) {
            $errors[] = "Veuillez saisir votre identifiant.";
        }
        // Password non rempli
        if(empty($_POST["password"])) {
            $errors[] = "Veuillez saisir votre mot de passe.";
        }

        $utilisateur = getUserByUsername($bdd, $_POST["username"]);

        //Test
        //var_dump($utilisateur);

        // Username incorrect
        if(!$utilisateur) {
            $errors[] = " Les identifiants sont incorrect.";
        } else {
            // Password incorrect
            if(!password_verify($_POST["password"], $utilisateur["password"])) {
                $errors[] = " Les identifiants sont incorrect.";
            } else {
                // Tout est OK, on donne comme valeur l'utilisateur à la superglobale $_SESSION
                $_SESSION["utilisateur"] = $utilisateur;
                // On redirige l'utilisateur sur la page admin.php
                header("Location: admin.php");
            }
        }
    }

?>


<html>

    <head>

        <meta charset="utf-8" />
        <!-- CSS -->
        <link rel="stylesheet" href="css/style.css" />
        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
    <body>

        <div class="container text-center">

            <h1 class="my-4">Se connecter</h1>

                <!-- Formulaire Connexion -->
                <div class="container card w-50 shadow p-3 mb-5 bg-body rounded">
                    <form class="container card-body" method="post" action="admin-login.php">
                        <div class="mb-3">
                            <label for="username" class="form-label">Identifiant</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="username">
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" id="Password" placeholder="password">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Se connecter</button>
                    </form>

                    <!-- Affichages des erreurs -->
                    <?php
                        foreach($errors as $error) {
                            echo('<div class="alert alert-danger" role="alert">
                                    '.$error.'
                                </div>');
                        }
                    ?>
                </div>
                    

        </div>




    </body>

        <!-- JS bundle Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>
