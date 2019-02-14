<?php 
session_start();
include_once 'config/bdd.conf.php';
include_once 'config/init.conf.php';
//on insert les parties HTML
require_once 'include/connexion.inc.php';
include_once 'include/header.inc.php';
include_once 'include/nav.inc.php';
require_once 'include/fonction.inc.php';

//le formulaire n'a pas été validé :
	//on affiche l'article 
	?>
	<div class="container">
		<div class="row">
				&nbsp;
		</div>
		<?php 
		//compter le nombre d'enregistrements
		
		
		$req="SELECT COUNT(*) as resultat FROM commentaires WHERE articles_id=:articles_id;";
		$answer = $bdd->prepare($req); 
		$answer->execute(array("articles_id"=> $_GET['id']));
		$data1=$answer->fetch();
		$nombre_lignes=$data1['resultat'];
		if ($nombre_lignes==0)
		{
			//aucun commentaire
			?>
			<div class="row">
				<h4>Il n'y a aucun commentaire</h4>
				<div class="col-lg-2">
				<a href="index.php" class="btn btn-sucess " name="btn">Retour aux articles</a>
				</div>
			</div>
			<?php
		}
		else
		{
		echo 'id'.$_GET['id'];
		//requête d'affichage de l'article et des commentaires
		$sql = "SELECT titre, texte, DATE_FORMAT(date, '%d/%m/%y') as date_fr,
		pseudo, commentaire, articles_id FROM bootstrap
		INNER JOIN commentaires 
		ON bootstrap.ID=commentaires.articles_id WHERE commentaires.articles_id=:articles_id;";
		
		$sth = $bdd->prepare($sql); 
		$sth->execute(array("articles_id"=> $_GET['id']));
		//(pas de while car une seule ligne à récupérer)
		$data = $sth->fetch();
	
		
		//affichage de l'article
		?>
		<div class="row">
			<div class="card col-lg-10">
				<div class="card-body">
					<h5 class="card-title">
					<p>Article du : <a href="#" class="pull-left btn btn-primary " name="btn" ><?= $data['date_fr']; ?></a></p>
					<?= $data['titre']; ?></h5>
					<p class="card-text"><?=$data['texte']; ?></p>
				</div>
			</div>
			<div class="col-lg-2">
				<a href="index.php">Retour aux articles</a>
			</div>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<!--saut ligne-->
		<div class="row"><h4>Commentaires :</h4></div>
		
		<div class="row">
			<?php
			//réexécuter la requête pour afficher tout
			$sth->execute(array("articles_id"=> $_GET['id']));
			while ($data=$sth->fetch())
			{
				?>
				<div class="row card col-lg-12">
					<div class="card-body">
						<h4 class="card-title text-success">
							<?php 
							if (empty($data['pseudo']))
							{
								//cas ou le pseudo n'est pas rempli
								echo 'anonyme';
							}
							else
							{
								echo $data['pseudo']; 
							}
							?>
						</h4>
						<p class="card-text text-primary"><?php echo $data['commentaire']; ?></p>
					</div>
				</div>
				<br />
				<div class="row col-lg-12">
				    &nbsp;
				</div>
			<?php
			}
			?>
				
		</div>
		<?php
		}
		?>
	</div>
			