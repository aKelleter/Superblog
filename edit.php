<?php
    require_once('settings.php');

    // Redirection vers la page de login si l'utilisateur n'est pas connecté
    if (!$_SESSION['IDENTIFY']) {
        header('Location: login.php');
    }
    
    $msg = null;
    $tinyMCE = true;
    $execute = false;
 
    if(!is_object($conn)){
        $msg = getMessage($conn, 'error');
    }else{

        // Récupérer des données de l'article à modifier via son id
        if(isset($_GET['id']) && !empty($_GET['id']))
        {
            $id = $_GET['id'];
            $article = getArticleByIDDB($conn, $id);
        }else
            header('Location: manager.php');
    }

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
            <div id="message">             
                <?php if(isset($msg)) echo $msg; ?>
            </div>
            <div id="content-edit">
               
                <form action="manager.php" method="post">     
                    <input type="hidden" name="id" value="<?php if(isset($article['id'])) echo $article['id']; else echo ''; ?>">               
                    <div class="form-ctrl">
                        <label for="title" class="form-ctrl">Titre</label>
                        <input type="text" class="form-ctrl" id="title" name="title" value="<?php if(isset($article['title'])) echo $article['title']; else echo ''; ?>" required>
                    </div>
                    <div class="form-ctrl">                                          
                        <label for="published_article" class="form-ctrl">Status de l'article <small>(publication)</small></label> 
                        <?php if(isset($article['content'])) displayFormRadioBtnArticlePublished($article['active'], 'EDIT'); else echo ''; ?>                  
                    </div>   
                    <div class="form-ctrl">
                        <label for="content" class="form-ctrl">Contenu</label>
                        <textarea class="" id="content" name="content" rows="5"><?php if(isset($article['content'])) echo html_entity_decode($article['content']); else echo ''; ?></textarea>
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