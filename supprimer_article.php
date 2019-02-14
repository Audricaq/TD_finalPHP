<?php
session_start();
include_once 'config/bdd.conf.php';
include_once 'config/init.conf.php';
//on insert les parties HTML
require_once 'include/connexion.inc.php';
include_once 'include/header.inc.php';
include_once 'include/nav.inc.php';
require_once 'include/fonction.inc.php';
require_once("libs/Smarty.class.php");
include_once 'include/footer.inc.php'; 


?>
<div class="container">
	<?php
	if(!isset($_GET['reponse']))
	//demander confirmation
	{
		?>
		<div class="row">
			<h5 class="col-lg-8">Êtes vous sûr de vouloir supprimer l'article et ses commentaires ?</h5>
		</div>
		<div class="row">
			<div class="col-lg-1">
				&nbsp;
			</div>
		
			<a href="supprimer_article.php?reponse=oui&id=<?=$_GET['id']; ?>" button type="submit" class="col-lg-1 btn btn-primary" name="submit" value="ajouter">Oui</button></a>
			<div class="col-lg-1">
				&nbsp;
			</div>
			<a href="index.php" button type="submit" class="col-lg-1 btn btn-primary" name="submit" value="ajouter">Non</button></a>			
		</div>
		<?php
	}
	else
	{
		//validé
		//on supprime les commentaires
		$sql='DELETE FROM commentaires WHERE articles_id=:id;';
		$requete1 = $bdd->prepare($sql); 
		$requete1->execute(array("id"=> $_GET['id']));
		
		//on supprime l'article
		$sql1='DELETE FROM bootstrap WHERE id=:ident;';
		$requete1 = $bdd->prepare($sql1); 
		$requete1->execute(array("ident"=> $_GET['id']));
		?>
		<div class="row">
			&nbsp;
		</div>
		
		<div class="row">
			<h5>L'article et ses commentaires ont été supprimés</h5>
		</div>
		<div class="row">
			<a href="index.php" button class="col-lg-1 btn btn-primary" " name="btn">Retour</a>
		</div>
		<?php 
		
	}
	?>
</div><!--container-->