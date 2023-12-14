<?php
    require_once('settings.php');

    /**
     * ICI VOUS ECRIVEZ LE CODE PHP QUI GERE LA LOGIQUE ET LES DONNEES DE l'APPLICATION
     */

    $msg = null;
    $article = null;

    if(isset($_GET['id']) && !empty($_GET['id'])){

        // On récupère l'ID de l'article passé en paramètre
        $id = $_GET['id'];

        // Récupérer l'article spécifié par l'ID
        $article = getArticleByIDDB($conn, $id);

        //DEBUG// disp_ar($article, 'STATUS', 'VD');
    }else{
        $msg = '<div class="alert alert-danger text-center" role="alert">Il n\'y a pas d\'article à afficher</div>';
    }    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection($article['title']); ?>
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
                <?php displayArticle($article); ?>
                                
            </div>  
            <footer>
                <?php displayFooter(); ?>
            </footer>     
        </div>
    </div>    
</body>
</html>