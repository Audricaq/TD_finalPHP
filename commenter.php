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
	if (!isset($_GET['valid']))
	{  
	//le formulaire n'a pas été validé :
	//on affiche l'article 
		?>
		
			<div class="row">
				&nbsp;
			</div>
			<?php 
			//requête d'affichage de l'article
			$sql = "SELECT titre, texte, DATE_FORMAT(date, '%d/%m/%y') as date_fr FROM bootstrap WHERE id=:numid";
			$sth = $bdd->prepare($sql); 
			$sth->execute(array("numid"=> $_GET['id']));
			
			//on mémorise l'id de l'article pour insérer plus tard dans la table
			$_SESSION['id']=$_GET['id'];
			
			while($data = $sth->fetch())
			{
				//affichage de l'article
				?>
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">
								<p><a href="#" class="pull-left btn btn-primary " name="btn" ><?= $data['date_fr']; ?></a></p>
								<?= $data['titre']; ?></h5>
								<p class="card-text"><?=$data['texte']; ?></p>
						</div>
					</div>
				</div>
				<!--saut ligne-->
				<div class="row">&nbsp;</div>
				<?php
			}
			
			$smarty = new Smarty();
			$smarty->setTemplateDir('templates/');
			$smarty->setCompileDir('templates_c/');
			//$smarty->setConfigDir('/web/www.example.com/guestbook/configs/');
			//$smarty->setCacheDir('/web/www.example.com/guestbook/cache/');
			//** un-comment the following line to show the debug console
			//$smarty->debugging = true;
			
			//affichage du formulaire
			$smarty->display('commenter.tpl');
			?>
		
		<?php
	}
	else
	{
		//le formulaire a été validé :
		//on insère les données dans la table commentaires
		try
		{
			$sql = "INSERT INTO commentaires VALUES(NULL,:pseudo,:commentaire,:articles_id)";
			$sth1 = $bdd->prepare($sql); 
		
			//sécurisation des données
			$sth1->execute(array("pseudo"=> $_POST['pseudo'],
							"commentaire"=>$_POST['commentaire'],
							"articles_id"=>$_SESSION['id']));
		
		
			echo $_POST['pseudo'], " votre commentaire a bien été inséré   ";
			?>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<a href="index.php" class="btn btn-success " name="btn">Retour</a>
			</div>
			<?php
		}
		catch (Exception $e)
		{
			//gestion erreurs
			echo " Erreur ! ".$e->getMessage(),'  ';
			?>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<a href="index.php" class="btn btn-sucess " name="btn">Retour</a>
			</div>
			<?php
		}
			
	}
	?>
	</div><!--container-->		
 


	