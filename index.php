<?php
    require_once('settings.php');
       
    $msg = null;
    $result = null;
    $execute = false;

    // On vérifie l'objet de connexion $conn
    if(!is_object($conn)){
        $msg = getMessage($conn, 'error');
    }else{
        
        // Va cherche en DB les articles publiés
        $result = getAllArticlesDB($conn, 1);
        //DEBUG// disp_ar($result);

        // Vérifie si le résultat est un tableau dans le cas contraire on affiche le message d'erreur retourné par la fonction
        (isset($result) && is_array($result))? $execute = true : $msg = getMessage($result, 'error');            
    }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('Accueil'); ?>
</head>
<body>
    <div class="container">
        <div id="header-logo">
            <h1><?php echo APP_NAME; ?></h1>
        </div>
        <div id="main-menu">
            <?php displayNavigation(); ?>
        </div>
        <div id="message">              
            <?php if(isset($msg)) echo $msg; ?>
        </div>
        <div id="content">              
            <?php               
                // Peut-on exécuter l'affichage des articles
                if($execute)
                    displayArticles($result);
            ?>
        </div>  
        <footer>                              
            <?php displayFooter(); ?>
        </footer>             
    </div>    
</body>
</html>