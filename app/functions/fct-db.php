<?php
/* ********************************************************************** */
/* *                           DB FUNCTIONS                             * */
/* *                           ------------                             * */
/* *    FONCTIONS RELATIVES AUX INTERACTIONS AVEC LA BASE DE DONNEES    * */
/* ********************************************************************** */

 /**
 * Connexion à la base de données
 * 
 * @param string $serverName
 * @param string $userName
 * @param string $userPwd
 * @param string $dbName
 * 
 * @return object $conn
 */
 function connectDB($serverName, $userName, $userPwd, $dbName) {
    try {
        // Création d'une connexion à la base de données
        $conn = new PDO("mysql:host=$serverName;dbname=$dbName;charset=utf8", $userName, $userPwd);

        // Définition du mode d'erreur de PDO sur Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;

    } catch (PDOException $e) {
        (DEBUG)? $st = 'Error : ' . $e->getMessage() : $st = "Error : Database connexion";            
        return $st; 
    }
}

/**
 * Récupérer tous les articles de la table articles
 * 
 * @param object $conn 
 * @param string $active (0, 1 ou %)
 * @return array $resultat
 */
function getAllArticlesDB($conn, $active = '%') {
    try {
        // Récupérer des données de notre table articles
        $req = $conn->prepare("SELECT * FROM articles WHERE active LIKE :active ORDER BY id DESC");
        $req->bindParam(':active', $active);
        $req->execute();
    
        // Retourne un tableau associatif pour chaque entrée de la table articles avec le nom des colonnes comme clé
        $resultat = $req->fetchall(PDO::FETCH_ASSOC);

        // Fermeture connexion
        $req = null;
        $conn = null;

        return $resultat;

    } catch (PDOException $e) {
        (DEBUG)? $errocode = 'Error : ' . $e->getMessage() : $errorcode = 300;            
        return $errorcode; 
    }
}

/**
 * Récupérer un article en fonction de son ID
 * 
 * @param object $conn 
 * @return array $resultat
 */
function getArticleByIDDB($conn, $id) {
    try {
        // Récupérer des données de notre table articles
        $req = $conn->prepare("SELECT * FROM articles WHERE id = :id");
        $req->bindParam(':id', $id);
        $req->execute();
    
        // Retourne un tableau associatif pour chaque entrée de la table articles avec le nom des colonnes comme clé
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        // Fermeture connexion
        $req = null;
        $conn = null;

        return $resultat;

    } catch (PDOException $e) {
        (DEBUG)? $errocode = 'Error : ' . $e->getMessage() : $errorcode = 300;            
        return $errorcode;
    }
}

/**
 * Ajout d'un article dans la base de données
 * 
 * @param mixed $conn 
 * @return true 
 */
function addArticleDB($conn, $datas) {
    try{
        // Préparation des données avant insertion dans la base de données
            $title = filterInputs($datas['title']);
            $content = nl2br(filterInputs($datas['content']));

            // Si on reçoit une valeur pour le status de publication de l'article
            if(isset($datas['published_article']) && !empty($datas['published_article']))
                $active = $datas['published_article'];
            else
                $active = 0;

        // Insertion des données dans la table articles
            $req = $conn->prepare("INSERT INTO articles (title, content, active) VALUES (:title, :content, :active)");
            $req->bindParam(':title', $title);
            $req->bindParam(':content', $content);
            $req->bindParam(':active', $active);
            $req->execute();

        // Fermeture connexion
            $req = null;
            $conn = null;

        return true;

    }catch(PDOException $e) {
        (DEBUG)? $errocode = 'Error : ' . $e->getMessage() : $errorcode = 300;            
        return $errorcode;      
    }       
}

/**
 * Modification d'un article dans la base de données
 * 
 * @param mixed $conn 
 * @param array $datas 
 * @return true 
 */
function updateArticleDB($conn, $datas) {
    try{
        //DEBUG// disp_ar($datas, 'DATAS', 'VD');
        // Préparation des données avant insertion dans la base de données
            $title = filterInputs($datas['title']);

            $content = nl2br($datas['content']);
            $content = preg_replace("/(<[a-zA-Z0-9=\"\/\ ]+>)<br \/>/", "$1", $content);        
            $content = htmlentities($content);
            
            $id = filterInputs($datas['id']);

            // Si on reçoit une valeur pour le status de publication de l'article
            if(isset($datas['published_article']) && !empty($datas['published_article']))
                $active = $datas['published_article'];
            else
                $active = 0;

        // Insertion des données dans la table articles
        $req = $conn->prepare("UPDATE articles SET title = :title, content = :content, active = :active WHERE id = :id");
        $req->bindParam(':title', $title);
        $req->bindParam(':content', $content);
        $req->bindParam(':active', $active);
        $req->bindParam(':id', $id);
        $req->execute();

        // Fermeture connexion
        $req = null;
        $conn = null;

        return true;

    }catch(PDOException $e) {
        (DEBUG)? $errocode = 'Error : ' . $e->getMessage() : $errorcode = 300;            
        return $errorcode;
    } 
}   

/**
 * Suppression d'un article dans la base de données
 * 
 * @param mixed $conn 
 * @return true 
 */
function deleteArticleDB($conn, $id) {
    try{
        // Préparation des données avant insertion dans la base de données
        $id = filterInputs($id);

        // Insertion des données dans la table articles
        $req = $conn->prepare("DELETE FROM articles WHERE id = :id");
        $req->bindParam(':id', $id);
        $req->execute();

        // Fermeture connexion
        $req = null;
        $conn = null;

        return true;

    }catch(PDOException $e) {
        (DEBUG)? $errocode = 'Error : ' . $e->getMessage() : $errorcode = 300;            
        return $errorcode;   
    }       

}   

/**
 * Identification d'un utilisateur
 * 
 * @param mixed $conn 
 * @param mixed $datas 
 * @return mixed 
 */
function userIdentificationDB($conn, $datas) {
    try{
        $resultat = null;

        // Préparation des données avant insertion dans la base de données
        $login = filterInputs($datas['login']);
        $pwd = filterInputs($datas['pwd']);

        // Sélection des données dans la table users
        $req = $conn->prepare("SELECT * FROM users WHERE email = :login AND passwd = :pwd");
        $req->bindParam(':login', $login);
        $req->bindParam(':pwd', $pwd);
        $req->execute();

        // Génère un résultat si il y a correspondance
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        // Fermeture connexion
        $req = null;
        $conn = null;

        if((isset($resultat['email']) && $resultat['email'] === $login) && (isset($resultat['passwd']) && $resultat['passwd'] === $pwd))
            return true;
        else
            return false;
        

    }catch(PDOException $e) {
        (DEBUG)? $errocode = 'Error : ' . $e->getMessage() : $errorcode = 300;            
        return $errorcode;      
    }       
}



