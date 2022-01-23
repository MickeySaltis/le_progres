<?php

// Démarre une nouvelle session ou reprend une session existante
    session_start();

// Détruire la session et redirige sur la page index.php
    session_destroy();
    header("Location: index.php");
?>