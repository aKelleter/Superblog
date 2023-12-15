<?php
    require_once('settings.php');

    /**
     * ICI VOUS ECRIVEZ LE CODE PHP QUI GERE LA LOGIQUE ET LES DONNEES DE l'APPLICATION
     */

    // On vérifie l'objet de connexion $conn
    if(!is_object($conn)){            
        $msg = '<div class="msg-error"><p>'.$conn.'</p></div>';
    }else{
        
        // Vérifie si on supprime un article
        if((isset($_GET['id']) && !empty($_GET['id'])) && 
            (isset($_GET['action']) && !empty($_GET['action'])) && $_GET['action'] == 'deleteArticle')
        {
            $id = $_GET['id'];
            $status = deleteArticleDB($conn, $id);       
        }    
        
        // Récupérer tous les articles de la table articles
        $result = getAllArticlesDB($conn);

        // On vérifie le retour de la fonction : si c'est un tableau, on continue, sinon on affiche le message d'erreur
        (isset($result) && is_array($result) && !empty($result))? $execute = true : $msg = '<div class="msg-error"><p>Il n\'y a pas d\'article à afficher</p></div>';            
    }       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('Gestion des articles'); ?>
</head>
<body>
    <div class="container">
            <div id="header-logo">
                <h1><?php echo APP_NAME; ?></h1>
            </div>
            <div id="main-menu">
                <?php displayNavigation(); ?>
            </div>
            <h2 class="title">Gérer les articles</h2>
            <div id="message">
                <!-- Ici nous affichons les messages éventuels (CODE PHP)-->
            </div>
            <div id="content">
                <!-- 
                   Tout comme sur la page d'accueil on va ici lister les titres des articles et ce compris les non publiés.
                   avec en plus des liens pour modifier afficher, afficher et supprimer chaque article.
                   Vous devez créer une foncion d'affichage
                -->
                <?php                  
                    // Peut-on exécuter cette instruction               
                    if($execute)
                    displayArticlesForManager($result);
                ?>
                                
            </div>  
            <footer>
                <?php displayFooter(); ?>
            </footer>     
        </div>
    </div>    
</body>
</html>