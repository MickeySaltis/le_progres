<?php

// Appel de la fonction bddConnect
    require 'function/bdd-function.php';
    $bdd= bddConnect();

// Superglobale _GET pour cibler le ID via les paramètres URL
    $idArticle = $_GET["id"];

// Appel de la fonction getOneArticles
    require 'function/article-function.php';
    $article= getOneArticles($bdd, $idArticle);

    // Test
    //var_dump($article);
    //die();
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

            <h1 class="my-3">Le Progrés</h1>

                <h2 class="my-2">L'article " <?php echo($article["titre"]);?> "</h2>

                    <!-- Détail Article -->
                    <div class=" mb-3 py-2 container-fluid row d-flex justify-content-center <?php echo($article["type"]);?>">
                    
                        <div class="col-md-6-sm-6">
                            <img alt="Image article" class="img-thumbnail w-50" src="uploads/<?php echo($article["image"]);?>">
                        </div>
                        <div class="col-md-6-sm-6">
                            <p class="pt-2"><?php echo($article["contenu"]);?></p>
                        </div>

                        <a class="my-2 btn btn-primary" href="index.php">Retour aux articles</a>

                    </div>                   

        </div>




    </body>

        <!-- JS bundle Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>