<?php

// Démarre une nouvelle session ou reprend une session existante
    session_start();

// Appel de la fonction checkAuthentification
    require 'function/admin-function.php';
    checkAuthentification();

// Appel de la fonction bddConnect
    require 'function/bdd-function.php';
    $bdd= bddConnect();


// Conditions d'erreurs

    $types=[
        'politique', 
        'sport', 
        'faits-divers',
        'autres'
    ];

    $errors=[];

    $uniqName=null;

    // Soumettre le Formulaire
    if($_SERVER["REQUEST_METHOD"] == 'POST'){

        // Titre non rempli
        if(empty($_POST["titre"])) {
            $errors[] = "Veuillez saisir un titre pour l'article.";
        }

        // Type en dehors du tableau $types
        if(!in_array($_POST["type"], $types)) {
            $errors[] = "Ce type n'existe pas.";
        }

        // Contenu non rempli
        if(empty($_POST["contenu"])) {
            $errors[] = "Veuillez saisir un contenu pour l'article.";
        }

        // Aucune erreur est remonté
        if(count($errors) == 0) {

            // Enregistrer l'image soumise à certaines conditions

            $allowedExtension = ['image/jpeg', 'image/png'];

            // Taille supérieur à 1 MO
            if($_FILES["image"]["size"]>1000000) {
                $errors[] = 'Le fichier est trop volumineux.';
            }
                
            // Type de l'image non conforme aux valeurs du tableau $allowedExtension
            if(!in_array($_FILES["image"]['type'], $allowedExtension)) {
                $errors[] = 'Le type du fichier n\'est pas accepté.
                                Les types acceptés sont: JPEG et PNG.';
            }

            // Enregistrer l'image sous un nom UNIQUE pour évité d'être écrasé par une autre image qui a le même nom
            $uniqName = uniqid().'.'.explode('/', $_FILES["image"]['type'])[1];

            // Toujours aucune erreur de remonté
            if(count($errors) == 0){

                // Récupérer l'image stocké temporairement pour l'enregistrer dans le dossier "uploads"
                move_uploaded_file($_FILES["image"]["tmp_name"], 'uploads/'.$uniqName);
            }

            // Insérer le nouveau article dans la BDD
            $query = $bdd->prepare("INSERT INTO article (titre, type, contenu, image, id_admin)
                                    VALUES (:titre, :type, :contenu, :image, :id_admin)");
                    $query->execute([
                        "titre"=> $_POST["titre"],
                        "type"=> $_POST["type"],
                        "contenu"=> $_POST["contenu"],
                        "image"=> $uniqName,
                        "id_admin"=> $_SESSION["utilisateur"]["id"]
                    ]);

                    // Rediriger l'admin sur sa page admin.php
                    header("Location: admin.php");
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

            <div class="d-flex justify-content-end">
                <a class="btn btn-warning mt-3 mx-2" href="admin.php">Annuler l'ajout.</a>
                <a class="btn btn-danger mt-3 mx-2" href="logout.php">Me déconnecter.</a>
            </div>

            <h1 class="my-3">Administration Le Progrés</h1>

                <h2 class="my-2">Ajouter un article.</h2>

                    <div class="my-4 container card w-50 shadow p-3 mb-5 bg-body rounded">
                    
                        <!-- Formulaire Ajouter un Article -->
                        <form enctype="multipart/form-data" method="post" action="add-article.php">
                            <div class="mb-3">
                                <label for="titre" class="form-label">Titre</label>
                                <input type="text" name="titre" class="form-control" id="titre" placeholder="titre">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" name="type" id="type">
                                    <?php
                                        foreach($types as $type) {
                                            echo('<option value="'.$type.'">'.$type.'</option>');
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="contenu" class="form-label">Contenu</label>
                                <input type="text" name="contenu" class="form-control" id="contenu" placeholder="contenu">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Ajouter l'article.</button>
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