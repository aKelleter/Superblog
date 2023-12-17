<?php
    require_once('settings.php');

    /**
     * ICI VOUS ECRIVEZ LE CODE PHP QUI GERE LA LOGIQUE ET LES DONNEES DE l'APPLICATION
     */

    
    // Redirection vers la page de login si l'utilisateur n'est pas connecté
    if (!$_SESSION['IDENTIFY']) {
        header('Location: login.php');
    }
    
    $msg = null;
    $result = null;
    $execute = false;
    $status = null;

    // On vérifie l'objet de connexion $conn
    if(!is_object($conn)){            
        $msg = getMessage($conn, 'error');
    }else{
        // Vérifie met à jour un article
        if(isset($_POST['form']) && $_POST['form'] == 'update') {
            $datas = $_POST;
            $status = updateArticleDB($conn, $datas);     

        // Vérifie si on supprime un article
        }elseif((isset($_GET['id']) && !empty($_GET['id'])) && 
            (isset($_GET['action']) && !empty($_GET['action'])) && $_GET['action'] == 'deleteArticle')
        {
            $id = $_GET['id'];
            $status = deleteArticleDB($conn, $id);   
            
        // Vérifie si on ajoute un article    
        }elseif(isset($_POST['form']) && $_POST['form'] == 'add'){    
            $datas = $_POST;
            $status = addArticleDB($conn, $datas);     
        }     
             
        // Traitements des status de retour des fonctions et affichage des messages correspondants
        if($status) {
            $msg = getMessage('Action effectuée avec succès', 'success');
            header('refresh:2;url=manager.php');
        }elseif($status === false) {
            $msg = getMessage('Erreur lors de la l\'action', 'error');
            header('refresh:2;url=manager.php');
        }

        // Récupérer tous les articles de la table articles
        $result = getAllArticlesDB($conn);

        // On vérifie le retour de la fonction : si c'est un tableau, on continue, sinon on affiche le message d'erreur
        (isset($result) && is_array($result) && !empty($result))? $execute = true : $msg = getMessage('Il n\'y a pas d\'article à afficher', 'error');
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
            <hr>
            <div id="message">              
                <?php if(isset($msg)) echo $msg; ?>
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