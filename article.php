<?php
    require_once('settings.php');

    /**
     * ICI VOUS ECRIVEZ LE CODE PHP QUI GERE LA LOGIQUE ET LES DONNEES DE l'APPLICATION
     */

    $msg = null;
    $result = null;
    $execute = false;

    if(isset($_GET['id']) && !empty($_GET['id'])){

        // On récupère l'ID de l'article passé en paramètre
        $id = $_GET['id'];

        // On vérifie l'objet de connexion $conn
        if(!is_object($conn)){            
            $msg = '<div class="msg-error"><p>'.$conn.'</p></div>';
        }else{
            
             // Récupérer l'article spécifié par l'ID
            $result = getArticleByIDDB($conn, $id);

            // On vérifie le retour de la fonction : si c'est un tableau, on continue, sinon on affiche le message d'erreur
            (isset($result) && is_array($result) && !empty($result))? $execute = true : $msg = '<div class="msg-error"><p>Il n\'y a pas d\'article à afficher</p></div>';            
        }       
        
    }else{
        $msg = '<div class="alert alert-danger text-center" role="alert">Il n\'y a pas d\'article à afficher</div>';
    }    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection((isset($result['title'])?$result['title']:APP_NAME)); ?>
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
                <!-- Ici nous affichons les messages éventuels (CODE PHP) -->
                <?php if(isset($msg)) echo $msg; ?>
            </div>
            <div id="content">
                <!-- 
                      Vous devez créer une fonction d'affichage pour afficher l'article:
                      Son titre et son contenu
                -->
                
                <?php 
                   // Peut-on exécuter cette instruction
                   if($execute)
                       displayArticleByID($result); 
                ?>
                                
            </div>  
            <footer>
                <?php displayFooter(); ?>
            </footer>     
        </div>
    </div>    
</body>
</html>