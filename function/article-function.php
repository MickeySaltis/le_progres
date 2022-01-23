<?php

// Fonction appel de tout les articles stockés dans le tableau article de la BDD
    function getAllArticles($bdd){
        $query = $bdd->prepare('SELECT * FROM article');
        $query->execute();
        // OU $query = $bdd->query('SELECT * FROM article');

        $resultat = $query->fetchAll();
        return $resultat;

        // Test pour vérif retour des valeurs
        // var_dump($query->fetchAll());
    }

// Fonction appel un seul article via son ID
    function getOneArticles($bdd, $id){
        $query = $bdd->prepare('SELECT * FROM article WHERE id = :id');
        $query->execute(['id' => $id]);

        $resultat = $query->fetch();
        return $resultat;
    }

// Fonction appel  tout les articles stockés dans le tableau article de la BDD qui sont liés à l'utilisateur
    function getMyArticles($bdd, $id){
        $query = $bdd->prepare('SELECT * FROM article WHERE id_admin = :id');
        $query->execute(["id"=>$id]);
        $resultat = $query->fetchAll();      
        return $resultat;
    }


// Fonction pour supprimer un article dela BDD via son ID
    function deleteOne($bdd, $id){
        $query = $bdd->prepare('DELETE FROM article WHERE id = :id');
        $query->execute(['id' => $id]);
    }

    
?>