<?php
    require_once('settings.php');

    /**
     * ICI VOUS ECRIVEZ LE CODE PHP QUI GERE LA LOGIQUE ET LES DONNEES DE l'APPLICATION
     */

    $tinyMCE = true;

    // Récupérer des données de l'article à modifier via son id
    if(isset($_GET['id']) && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        $article = getArticleByIDDB($conn, $id);
    }else
        header('Location: manager.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('Editer un article'); ?>
</head>
<body>
    <div class="container">
            <div id="header-logo">
                <h1><?php echo APP_NAME; ?></h1>
            </div>
            <div id="main-menu">
                <?php displayNavigation(); ?>
            </div>
            <h2 class="title">Modifier un article</h2>
            <hr>
            <div id="content-edit">
                <!-- 
                    Créez ici un formulaire HTML pour modifier le contenu d'un article
                    * Astuces :
                        - L'attribut "action" de votre balise form devra contenir "manager.php"
                          C'est dans le fichier manager.php que l'on va traiter les donées du formulaire
                        - L'attribut "method" devra contenir "post"                    
                -->
                <form action="manager.php" method="post">     
                    <input type="hidden" name="id" value="<?php echo $article['id']; ?>">               
                    <div class="form-ctrl">
                        <label for="title" class="form-ctrl">Titre</label>
                        <input type="text" class="form-ctrl" id="title" name="title" value="<?php echo $article['title']; ?>" required>
                    </div>
                    <div class="form-ctrl">                                          
                        <label for="published_article" class="form-ctrl">Status de l'article <small>(publication)</small></label> 
                        <?php displayFormRadioBtnArticlePublished($article['active'], 'EDIT'); ?>                  
                    </div>   
                    <div class="form-ctrl">
                        <label for="content" class="form-ctrl">Contenu</label>
                        <textarea class="" id="content" name="content" rows="5"><?php echo html_entity_decode($article['content']); ?></textarea>
                    </div>
                    <input type="hidden" id="form" name="form" value="update">
                    <button type="submit" class="btn-classic">Modifier</button>
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