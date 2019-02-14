   <div class="row">
		<!--centrer le formulaire-->
		<div class="col-md-2">
			&nbsp;
		</div>
		
        <div class="card col-md-8">
            <div class="card-body">
			
				<form action="commenter.php?valid=ok" class="col-md-12" method="post" enctype="multipart/form-data" id="form_connexion">

					<div class="form-group">
						<label for="pseudo" class="col-form-label">Pseudo  :</label>
						<input type="text" class="col-lg-10 form-control" id="pseudo" name="pseudo" placeholder="Entrer votre Pseudo" value="">
						
					</div>

					<div class="form-group">
						<label for="mdp">Adresse email:</label>
						<input type="email" class="col-lg-10 form-control" id="email" name="email" placeholder="Entrer votre Email" value="">
						<span id="email_manquant"></span>
					</div>
					<div class="form-group">
						<textarea class="col-lg-10" id="commentaire" name="commentaire"
          rows="5" id="commentaire"></textarea>
						<div id="mess_commentaire" ></div>
					</div>
					<button type="submit" class="btn btn-primary" name="submit" value="ajouter">Valider</button>
					<a href="index.php" class="btn btn-success">Annuler</button></a>
				</form>
            </div>
        </div>
    </div>   
	<script><!--fonctions javascript-->
		
		var form  = document.getElementsByTagName('form')[0];
		
		//vérifier les données du formulaire avant envoi: click sur submit
		form.addEventListener("submit", function (event) {
			
			var commentaire=document.getElementById("commentaire").value;
			
			//variable de test si formulaire ok
			var test=false;
			//valeur du champ email
			var champ_mail=document.getElementById("email").value;
			
			
			var mail=document.getElementById('email_manquant');
			//initialiser les messages d'erreur
			mail.textContent='';
			mess_commentaire.textContent='';
			
			
			//si l'email est manquant
			if (champ_mail=='') 
			{
				//faire apparaître le message si email manquant 
				mail.textContent="vous avez oublié de remplir l'email"
				mail.style.color='red';
				test=true;
			}
			
			//le commentaire est manquant
			if (document.getElementById("commentaire").value=="") 
			{
				//même chose 
				mess_commentaire.textContent="il faut remplir le commentaire"
				mess_commentaire.style.color='red';
				test=true;
			}
			
			//si il y a une erreur on empêche l'envoi du formulaire
			if(test==true)
			{
				event.preventDefault();
			}
		}, false);
	</script>
	
	
