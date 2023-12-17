<?php

    // Ouverture de la session et initialisation de la variable $_SESSION['IDENTIFY']
    session_start();
    if (!isset($_SESSION['IDENTIFY'])) {
        $_SESSION['IDENTIFY'] = false;
    }
    
    // Constantes de l'application
    const APP_NAME = "SuperBlog";
    const APP_VERSION = 'v0.5.1';
    const APP_UPDATED = '17-12-2023 15:50';
    const APP_AUTHOR = 'HAL 9000';

    // Constante d'activation/désactivation du mode DEBUG
    const DEBUG = false;

    // Charge les credentials de connexion à la DB
    require_once('conf/conf-db.php');

    // Chargement des fichiers de fonctions
    require_once('app/functions/fct-db.php');
    require_once('app/functions/fct-ui.php');
    require_once('app/functions/fct-tools.php');

    // Instancier un objet de connexion
    $conn = connectDB(SERVER_NAME, USER_NAME, USER_PWD, DB_NAME);



    
    