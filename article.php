<?php
session_start();
include_once 'config/bdd.conf.php';
include_once 'config/init.conf.php';
//on insert les parties HTML
require_once 'include/connexion.inc.php';
include_once 'include/header.inc.php';
include_once 'include/nav.inc.php';
require_once 'libs/Smarty.class.php';


if (isset($_POST['submit'])){
    print_r2($_POST);
    print_r2($_FILES);
    
    $publie = isset($_POST['publie']) ? $_POST['publie']:0;
    $date = date("Y-m-d");
    
    /*@var $bddPDO*/
    $sql_insert = "INSERT INTO bootstrap"
            ."(titre, texte, publie, date)"
            ."VALUES (:titre, :texte, :publie, :date);";
    $sth = $bdd-> prepare($sql_insert);
    
    $sth->bindvalue(':titre', $_POST['titre'], PDO::PARAM_STR);
    $sth->bindvalue(':texte', $_POST['texte'], PDO::PARAM_STR);
    $sth->bindvalue(':publie', $publie, PDO::PARAM_BOOL);
    $sth->bindvalue(':date', $date, PDO::PARAM_STR);
    
    $result = $sth->execute();
    
    //var_dump($result);
    
    $id_article = $bdd->lastInsertId();
    
    if ($_FILES['image']['error']==0){
        $extention = pathinfo($FILES['image']['name'], PATHINFO_EXTENSION);
        $extention = strtolower($extention);
        
        $result_img = move_uploaded_file($FILES['image']['tmp_name'], 'img/' . $idarticle . '.' . $extention);
    }
    
    $notification = '<b>Félicitation</b> votre article a été inséré dans la base de données.';
    $result_notification = TRUE;
    
    $_SESSION['notification']['message'] = $notification;
    $_SESSION['notification']['result'] = $result_notification;
    
    header("Location: index.php");
    exit();
}else{

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');



//** un-comment the following line to show the debug console
//$smarty->debugging = true;

include_once 'include/header.inc.php';
include_once 'include/nav.inc.php';

$smarty->display('articles.tpl');

include_once 'include/footer.inc.php';





  


}
include_once 'include/footer.inc.php';
?>

