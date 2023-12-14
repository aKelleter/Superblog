<?php

    // Ouverture de la session et initialisation de la variable $_SESSION['IDENTIFY']
    session_start();
    if (!isset($_SESSION['IDENTIFY'])) {
        $_SESSION['IDENTIFY'] = false;
    }
    
    // Constantes de l'application
    const APP_NAME = "Superblog";
<<<<<<< HEAD
    const APP_VERSION = 'v0.0.1';
    const APP_UPDATED = '14-12-2023 16:30';
=======
    const APP_VERSION = 'v0.0.2';
    const APP_UPDATED = '13-12-2023 16:30';
>>>>>>> bb2e48fbbb2064e01bd7861d6a0c4027979845d8
    const APP_AUTHOR = 'Vous :)';

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



    
    