<?php
session_start();
require_once 'config/init.conf.php';
require_once 'config/bdd.conf.php';
require_once 'include/fonction.inc.php';
//On insert les parties HTML du site
require_once 'include/connexion.inc.php';
include_once 'include/header.inc.php';
include_once 'include/nav.inc.php';

require_once("libs/Smarty.class.php");
?>



<?php





//activation des erreurs php
error_reporting(E_ALL);
ini_set('display-errors','on');

// activé les erreurs PDO
try{
  
  // Activation des erreurs PDO
   $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
   $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e){
  echo "Erreur : ".$e->getMessage();
}


//récupération PROPRE des variables AVANT de les utiliser
$q = !empty($_GET['q']) ? $_GET['q'] : NULL; 
$publie = "oui";
//pour pouvoir faire une recherche de texte dans une chaine de caractère, il faut ajouter % devant et derrière la recherche
$texte = !empty($_GET['q']) ? "%".$_GET['q']."%" : NULL;

if($q){
  $s = explode(" ", $q);
  /*$sql = "SELECT bootstrap "
        . "id, "
        . "titre, "
        . "texte, "
        . "publie, "
        . "FROM bootstrap "
        . "WHERE publie = :publie "
        . "AND (titre =:recherche OR texte = :recherche) "
       /* . "LIMIT :index, :nb_article_par_page"; */
	   $sql = "SELECT * FROM bootstrap where publie = :publie and (titre= :recherche or texte like :texte)";
  
 $sth = $bdd->prepare($sql); 
 $sth->execute(array(
        "recherche"=> $_GET['q'],
		"publie"=> $publie,
		"texte"=> $texte
    ));
  $i = 0;/*
  foreach($s as $mot){
      if(strlen($mot) > 3){
          if($i==0){
              $sql.=(' WHERE ');
          }
          else{
              $sql.('" OR ');
          }
          $sql.=('keywords LIKE  "%'.$mot.'%"');
          $i++;
               
      }
  }
   
  //execution "propre" d'une requête 
  try{
    $result = $bdd->query($sql);
  }catch(Exception $e){
    echo "Erreur dans la requête :" .$sql ." <br>".$e->getMessage();
  }*/
  
  while($data = $sth->fetch()){
	  echo $data['texte'];
	  echo "<br>";
  }
}


$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');



//** un-comment the following line to show the debug console
//$smarty->debugging = true;

include_once 'include/header.inc.php';
include_once 'include/nav.inc.php';

$smarty->display('recherche.tpl');

include_once 'include/footer.inc.php';




?>