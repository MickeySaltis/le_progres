<?php

// Démarre une nouvelle session ou reprend une session existante
    session_start();

// Appel de la fonction checkAuthentification
    require 'function/admin-function.php';
    checkAuthentification();

// Appel de la fonction bddConnect
    require 'function/bdd-function.php';
    $bdd= bddConnect();

// Appel de la fonction getMyArticles
    require 'function/article-function.php';
    $articles= getMyArticles($bdd, $_SESSION["utilisateur"]["id"]);

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
                <a class="btn btn-success mt-3 mx-2" href="add-article.php">Ajouter un article.</a>
                <a class="btn btn-danger mt-3 mx-2" href="logout.php">Me déconnecter.</a>
            </div>           

            <h1 class="my-3">Administration Le Progrés</h1>
                <h2 class="my-3">Mes articles</h2>

                    <!-- Tableau Article de l'Admin -->
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Type</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                            </tr>
                        </thead>

                        <?php
                            foreach ($articles as $article){
                                echo('<tbody>
                                        <tr class="'.$article["type"].'">
                                            <th scope="row">'.$article["titre"].'</th>
                                            <td>'.$article["type"].'</td>
                                            <td>'.substr($article["contenu"],0 ,20).'</td>
                                            <td><img class="img-thumbnail w-25" src="uploads/'.$article["image"].'"alt="..."></td>
                                            <td>
                                                <a class="btn btn-primary my-2" href="edit-article.php?id='.$article["id"].'">Editer</a><br>
                                                <a class="btn btn-primary my-2" href="remove-article.php?id='.$article["id"].'">Supprimer</a>
                                            </td>
                                        </tr>
                                    </tbody>');
                            }
                        ?>
                        
                    </table>

        </div>

    </body>

        <!-- JS bundle Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>