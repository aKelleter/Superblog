<?php
    require_once('settings.php');

    /**
     * ICI VOUS ECRIVEZ LE CODE PHP QUI GERE LA LOGIQUE ET LES DONNEES DE l'APPLICATION
     */

     $tinyMCE = true;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('Ajouter un article'); ?>
</head>
<body>
    <div class="container">
            <div id="header-logo">
                <h1><?php echo APP_NAME; ?></h1>
            </div>
            <div id="main-menu">
                <?php displayNavigation(); ?>
            </div>
            <h2 class="title">Ajouter un article</h2>
            <hr>
            <div id="content-add">
                <!-- 
                    Créez ici un formulaire HTML pour ajouter un nouvel article
                    * Astuces :
                        - L'attribut "action" de votre balise form devra contenir "manager.php"
                          C'est dans le fichier manager.php que l'on va traiter les donées du formulaire
                        - L'attribut "method" devra contenir "post"                    
                -->
                <form action="manager.php" method="post">                    
                    <div class="form-ctrl">
                        <label for="title" class="form-ctrl">Titre</label>
                        <input type="text" class="form-ctrl" id="title" name="title" value="" required>
                    </div>
                    <div class="form-ctrl">                                          
                        <label for="published_article" class="form-ctrl">Status de l'article <small>(publication)</small></label> 
                        <?php displayFormRadioBtnArticlePublished(false, 'ADD'); ?>                  
                    </div>   
                    <div class="form-ctrl">
                        <label for="content" class="form-ctrl">Contenu</label>
                        <textarea class="" id="content" name="content" rows="8"></textarea>
                    </div>
                    <input type="hidden" id="form" name="form" value="add">
                    <button type="submit" class="btn-classic">Ajouter</button>
                </form>
                                
            </div>  
            <footer>
                <?php displayFooter(); ?>
            </footer>     
        </div>
    </div>    
    <?php displayJSSection($tinyMCE); ?>  
</body>
</html>