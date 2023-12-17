<?php
    require_once('settings.php');
    
    $msg = null;
    $result = null;
    $execute = false;

    // On vérifie l'objet de connexion $conn
    if(!is_object($conn)){
        //die($conn);
        //$msg = '<div class="msg-error">'.$conn.'</div>';
        $msg = getMessage($conn, 'error');
    }else{
        
        // Va cherche en DB les articles publiés
        $result = getAllArticlesDB($conn, 1);
        //DEBUG// disp_ar($result);

        // On vérifie le retour de la fonction : si c'est un tableau, on continue, sinon on affiche le message d'erreur
        /*
        if(isset($result) && is_array($result)){
            $execute = true;
        }else{
            $msg = displayMessage($result, 'error');
        }*/
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
                <!-- Ici nous affichons les messages éventuels (CODE PHP)-->
                <?php if(isset($msg)) echo $msg; ?>
            </div>
            <div id="content">
                <!-- 
                    Ouvrez une balise php pour lancer la fonction d'affichage 
                    des articles publiés. Fonction que vous allez écrire dans fct-ui.php 
                -->
                <!-- Exemple en HTML, vous, vous devez créer une fonction qui va afficher
                     les données de la DB. SUPPRIMEZ L'EXEMPLE.
                -->
                <!--
                    <p><a href="article.php?id=xx" class="titre-article">Titre du premier article</a></p>
                    <p><a href="article.php?id=xx" class="titre-article">Titre du second article</a></p>
                    <p><a href="article.php?id=xx" class="titre-article">Titre du troisième article</a></p>
                -->
                <?php               
                    // Peut-on exécuter cette instruction
                    if($execute)
                        displayArticles($result);
                ?>
            </div>  
            <footer>                
                <!-- 
                    Ouvrez une balise php pour lancer la fonction d'affichage 
                    du footer. Fonction que vous allez écrire dans fct-ui.php
                    Affichez le nom de l'app sa version sa date de mise à jour
                    et d'autres choses si vous le souhaitez 
                -->
                <!-- Exemple en HTML du footer, vous, vous devez créer une fonction qui va afficher
                     les données de la DB. SUPPRIMEZ L'EXEMPLE.
                -->
                <!--<p>Superblog - v0.0.1 - 13-12-2023 16:45 by Vous<p>-->
                <?php displayFooter(); ?>
            </footer>     
        </div>
    </div>    
</body>
</html>