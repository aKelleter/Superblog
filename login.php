<?php
    require_once('settings.php');

    // Redirection vers la page de gestion si l'utilisateur est connecté
    if ($_SESSION['IDENTIFY']) {
        header('Location: manager.php');
    }

    $user = null;
    $connexionSuccessfull = null;
    $msg = null;

    // On vérifie l'objet de connexion $conn
    if(!is_object($conn)){
        $msg = getMessage($conn, 'error');
    }else{

        // Vérifie si on effectue une identification
        if(isset($_POST['form']) && $_POST['form'] == 'login') {
            
            if($_POST['login'] == '' || $_POST['pwd'] == '') {
                $msg = getMessage('Veuillez remplir tous les champs', 'error');
                //header('refresh:3;url=login.php');
            }else{
                $datas = $_POST;
                //$user = userIdentificationDB($conn, $datas);
                $user = userIdentificationWithHashPwdDB($conn, $datas);            
                (!empty($user['email']))? $connexionSuccessfull = true : $connexionSuccessfull = false;
                //DEBUG//disp_ar($user, 'USER', 'VD');   die();
            }
        }

        // Traitement en fonction du retour de la fonction identificationDB()  
        if($connexionSuccessfull === true) {
            $_SESSION['IDENTIFY'] = true;
            $_SESSION['user_email'] = $user['email'];
            header('Location: manager.php');     
        }elseif($connexionSuccessfull === false){
            $msg = getMessage('Votre email et/ou votre mot de passe sont erronés', 'error');
            //header('refresh:3;url=login.php');
        }
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php displayHeadSection('S\'identifier'); ?>
</head>
<body>
    <div class="container">
            <div id="header-logo">
                <h1><?php echo APP_NAME; ?></h1>
            </div>
            <div id="main-menu">
                <?php displayNavigation(); ?>
            </div>
            <h2 class="title">S'identifier</h2>            
            <div id="message">
              
                <?php if(isset($msg)) echo $msg; ?>
            </div>
            <div id="content-login">
               
                <form class="mt-15" action="login.php" method="post">
                    <div class="form-ctrl">
                        <label for="login" class="form-ctrl">E-mail</label>
                        <input type="email" class="form-ctrl" id="login" name="login" value="<?php echo (!empty($_POST['login']))? $_POST['login'] : null; ?>" required>
                    </div>
                    <div class="form-ctrl">
                        <label for="pwd" class="form-ctrl">Mot de passe</label>
                        <input type="password" class="form-ctrl" id="pwd" name="pwd" value="" required>
                    </div>
                    <input type="hidden" id="form" name="form" value="login">
                    <button type="submit" class="btn-classic">Se connecter</button>
                </form>
                                
            </div>  
            <footer>
                <?php displayFooter(); ?>
            </footer>     
        </div>
    </div>    
</body>
</html>