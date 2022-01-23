<?php

// Appel de la fonction bddConnect
    require 'function/bdd-function.php';
    $bdd= bddConnect();

// Appel de la fonction getAllArticles
    require 'function/article-function.php';
    $articles= getAllArticles($bdd);


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
                <a class=" btn btn-primary mt-3" href="admin-login.php">Me connecter.</a>
            </div>

            <h1 class="my-3">Le Progrés</h1>
                
                <h2 class="my-2">Les articles</h2>

                <div class="container-fluid row ">
                   
                    <!-- Card Article -->
                   <?php
                        // Boucle pour afficher autant de card que de valeur dans le tableau article
                        //substr coupe un string; permet d'afficher qu'une partie de contenu
                        foreach ($articles as $article){
                            echo(' <div class="card py-3 container col-md-6-sm-6 " style="width: 25%;">
                            <img src="uploads/'.$article["image"].'" class="card-img-top" alt="...">
                            <div class="card-body '.$article["type"].'">
                                <h4 class="card-title">'.$article["titre"].'</h4>
                                <h5 class="card-title">'.$article["type"].'</h5>
                                <p class="card-text">'.substr($article["contenu"],0 ,20).'</p>
                                <a href="article.php?id='.$article["id"].'" class="btn btn-primary">Lire la suite</a>
                            </div>
                        </div> ');
                        }
                    ?>

                </div>

                    

        </div>




    </body>

        <!-- JS bundle Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>