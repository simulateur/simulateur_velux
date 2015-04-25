<?php
/* fonction formulaire permettant d'afficher un formulaire d'estimation vide*/
function formulaire(){
	 include'param/id.inc.php';
?>
	<!-- formulaire permettant d'estimer le remplacement de velux -->
	<form name="estimer" id="estimer" action="http://localhost/simulateur_velux/estimateur.php" method="post" enctype="multipart/form-data">
	<?php try {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$hote.';dbname='.$base,$utilisateur,$mdp);?>
				Ouverture du velux à remplacé <br/>
				<!-- champs select permettant de selectionner le velux à remplacer -->
				<select name="velux_actuel" id="velux_actuel">
					<option value="0">Ne Sait pas</option><?php 
					$selection_type = $bdd->query('SELECT * FROM ouverture');
					while ($donnees = $selection_type->fetch()) { ?>
						<option value="<?php echo $donnees['id_ouverture']?>"><?php echo $donnees['libelle_ouverture']?></option>
					<?php }?>
				
				</select>
				<br/>
			
				Estimation :<br/>
				<!-- champs select permettant de selectionner la taille du velux souhaitée -->
				<select name="selectTaille" id="selectTaille">
				 <option value="0"name="taille" id="taille">Taille</option>
					<?php 
						/* requete sql permettant de selectionner des informations dans la table taille pour le champs select*/
						$selection_taille = $bdd->query('SELECT * FROM taille');
						while ($donnees = $selection_taille->fetch()) { ?>
							<option value="<?php echo $donnees['reference_taille']?>"><?php echo $donnees['libelle_taille']?></option>
				 <?php }?>
					</select>
					<!-- champs select permettant de selectionner la finition du velux souhaitée -->
					<select name="selectFinition" id="selectFinition">
					<option value="0"name="finition" id="finition">Finition</option>
						 <?php
						 /* requete sql permettant de selectionner des informations dans la table finition de la bdd pour le champs select*/
						 $selection_finition = $bdd->query('SELECT * FROM finition');
						 while ($donnees = $selection_finition->fetch()) { ?>
						 	<option value="<?php echo $donnees['id_finition']?>"><?php echo $donnees['libelle_finition']?></option>
					<?php }?>
					</select>
					<!-- champs select permettant de selectionner l'ouverture du velux souhaitée -->	
					<select name="selectOuverture" id="selectOuverture">
					<option value="0" name="ouverture" id="ouverture">ouverture</option>
					<?php
						/* requete sql permettant de selectionner des informations de la table ouverture de la bdd dans le champs select*/
						$selection_ouverture = $bdd->query('SELECT * FROM ouverture');
			 			while ($donnees = $selection_ouverture->fetch()) { ?>
							<option value="<?php echo $donnees['id_ouverture']?>"><?php echo $donnees['libelle_ouverture']?></option>
					<?php }?>
					</select>
					<select name="selectType" id="selectType">
					<option value="0" name="type_velux" id="type_velux">Type Velux</option>
						<?php
						$selection_type = $bdd->query('SELECT * FROM type_velux');
						while ($donnees = $selection_type->fetch()) { ?>
							<option value="<?php echo $donnees['id_type']?>"><?php echo $donnees['libelle_type']?></option>
					<?php }?>
					</select>
					<select name="selectTuile" id="selectTuile">
					<option value="0" name="tuile" id="tuile">Tuile</option>
						<?php
						$selection_raccord = $bdd->query('SELECT * FROM raccord');
						while ($donnees = $selection_raccord->fetch()) { ?>
							<option value="<?php echo $donnees['id_raccord']?>"><?php echo $donnees['libelle_raccord']?></option>
					<?php }?>
					</select>
					<select name="selectVolet" id="selectVolet">
					<option value="0" name="volet" id="volet">Volet</option>
						<?php
						$selection_volet = $bdd->query('SELECT * FROM volet');
						while ($donnees = $selection_volet->fetch()) { ?>
							<option value="<?php echo $donnees['reference_volet']?>"><?php echo $donnees['libelle_volet']?></option>
					<?php }?>
					</select>
					<select name="selectStore" id="selectStore">
						<option value="0" name="Store" id="Store">Store</option>
						<?php
						$selection_store = $bdd->query('SELECT * FROM store');
						while ($donnees = $selection_store->fetch()) { ?>
							<option value="<?php echo $donnees['reference_store']?>"><?php echo $donnees['libelle_store']?></option>
					<?php }?>
					</select >
					<select name="couleur" id="couleur">
						<option value="0">Couleurs</option>
						<option value="1">Standards</option>
						<option value="2">Autres Couleurs</option>
					</select>
					<?php 
					
						
			}
			catch (Exception $erreur) {
				die('Erreur : '.$erreur->getMessage());
			}
				?>
			<input type="hidden" name="nomVelux" id="nomVelux" value="<?php echo $_SESSION['nomFenetre']?>">
			<input type="reset" name="boutResEstimer" id="boutResEstimer" value="Annuler">
			<input type="submit" name="boutSubEstimer" id="boutSubEstimer" value="Estimer">
		</form><?php
}
/* fonction permettant d'afficher un formulaire contenant les champs avec les informations selectionnées*/
function formulaireSub($veluxActuel,$taille,$finition,$ouverture,$type,$raccord,$volet,$store,$couleur){
	include'param/id.inc.php';
?>
	<form name="estimer" id="estimer" action="http://localhost/simulateur_velux/estimateur.php" method="post" enctype="multipart/form-data">
	<?php try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$hote.';dbname='.$base,$utilisateur,$mdp);?>
				Ouverture du velux à remplacé ?<br/>
				<select name="velux_actuel" id="velux_actuel">
					<option value="0">Ne Sait pas</option><?php 
					$selection_type = $bdd->query('SELECT * FROM ouverture');
					while ($donnees = $selection_type->fetch()) { 
						if($donnees['id_ouverture']==$veluxActuel){
							?><option  selected="selected"value="<?php echo $donnees['id_ouverture']?>"><?php echo $donnees['libelle_ouverture']?></option>
					<?php }
						else
						{
							?><option value="<?php echo $donnees['id_ouverture']?>"><?php echo $donnees['libelle_ouverture']?></option>
				<?php 	}
					 }?>
				
				</select>
				<br/>
			
				Estimation :<br/>
			
				<select name="selectTaille" id="selectTaille">
				 <option value="0"name="taille" id="taille">Taille</option>
					<?php 
					
						$selection_taille = $bdd->query('SELECT * FROM taille');
						while ($donnees = $selection_taille->fetch()) { 
							if($donnees['reference_taille']==$taille){
							?><option  selected="selected"value="<?php echo $donnees['reference_taille']?>"><?php echo $donnees['libelle_taille']?></option>
						<?php }
							else
							{
							?><option value="<?php echo $donnees['reference_taille']?>"><?php echo $donnees['libelle_taille']?></option>
				<?php 		}
				 	 }?>
					</select>
					<select name="selectFinition" id="selectFinition">
					<option value="0"name="finition" id="finition">Finition</option>
						 <?php
						 $selection_finition = $bdd->query('SELECT * FROM finition');
						 while ($donnees = $selection_finition->fetch()) { 
						 	if($donnees['id_finition']==$finition){
								?><option  selected="selected"value="<?php echo $donnees['id_finition']?>"><?php echo $donnees['libelle_finition']?></option>
						<?php }
							else
							{
							?><option value="<?php echo $donnees['id_finition']?>"><?php echo $donnees['libelle_finition']?></option>
				<?php 		} 
						}?>
					</select>	
					<select name="selectOuverture" id="selectOuverture">
					<option value="0" name="ouverture" id="ouverture">ouverture</option>
					<?php
						$selection_ouverture = $bdd->query('SELECT * FROM ouverture');
			 			while ($donnees = $selection_ouverture->fetch()) {
							if($donnees['id_ouverture']==$ouverture){
								?><option  selected="selected"value="<?php echo$donnees['id_ouverture']?>"><?php echo $donnees['libelle_ouverture']?></option>
						<?php }
							else
							{
							?><option value="<?php echo $donnees['id_ouverture']?>"><?php echo $donnees['libelle_ouverture']?></option>
				<?php 		} 
						}?>
					</select>
					<select name="selectType" id="selectType">
					<option value="0" name="type_velux" id="type_velux">Type Velux</option>
						<?php
						$selection_type = $bdd->query('SELECT * FROM type_velux');
						while ($donnees = $selection_type->fetch()) { 
							if($donnees['id_type']==$type){
								?><option  selected="selected"value="<?php echo $donnees['id_type']?>"><?php echo $donnees['libelle_type']?></option>
						<?php }
							else
							{
							?><option value="<?php echo $donnees['id_type']?>"><?php echo $donnees['libelle_type']?></option>
				<?php 		} 
						}?>
					</select>
					<select name="selectTuile" id="selectTuile">
					<option value="0" name="tuile" id="tuile">Tuile</option>
						<?php
						$selection_raccord = $bdd->query('SELECT * FROM raccord');
						while ($donnees = $selection_raccord->fetch()) { 
							if($donnees['id_raccord']==$raccord){
								?><option  selected="selected"value="<?php echo $donnees['id_raccord']?>"><?php echo $donnees['libelle_raccord']?></option>
						<?php }
							else
							{
							?><option value="<?php echo $donnees['id_raccord']?>"><?php echo $donnees['libelle_raccord']?></option>
				<?php 		}
					 }?>
					</select>
					<select name="selectVolet" id="selectVolet">
					<option value="0" name="volet" id="volet">Volet</option>
						<?php
						$selection_volet = $bdd->query('SELECT * FROM volet');
						while ($donnees = $selection_volet->fetch()) { 
							if($donnees['reference_volet']==$volet){
								?><option selected="selected"value="<?php echo $donnees['reference_volet']?>"><?php echo $donnees['libelle_volet']?></option>
						<?php }
							else
							{
							?><option value="<?php echo $donnees['reference_volet']?>"><?php echo $donnees['libelle_volet']?></option>
				<?php 		} 
						}?>
					</select>
					<select name="selectStore" id="selectStore">
						<option value="0" name="Store" id="Store">Store</option>
						<?php
						$selection_store = $bdd->query('SELECT * FROM store');
						while ($donnees = $selection_store->fetch()) { 
							if($donnees['reference_store']==$store){
								?><option  selected="selected" value="<?php echo $donnees['reference_store']?>"><?php echo $donnees['libelle_store']?></option>
						<?php }
							else
							{
							?><option value="<?php echo $donnees['reference_store']?>"><?php echo $donnees['libelle_store']?></option>
				<?php 		} 
						}?>
					</select >
					<select name="couleur" id="couleur">
						<?php if($couleur=="1"){
							?>
							<option value="0">Couleurs</option>
							<option value="1"selected="selected">Standards</option>
							<option value="2">Autres Couleurs</option><?php
						}
						else{
							if($couleur=="2"){
								?>
								<option value="0">Couleurs</option>
								<option value="1">Standards</option>
								<option value="2" selected="selected">Autres Couleurs</option><?php
							}
							else{?>
								<option value="0">Couleurs</option>
								<option value="1">Standards</option>
								<option value="2">Autres Couleurs</option><?php 
							}
						}
							?>
						
					</select>
					<?php 
					
						
			}
			catch (Exception $erreur) {
				die('Erreur : '.$erreur->getMessage());
			}
				?>
			<input type="hidden" name="nomVelux" id="nomVelux" value="<?php echo $_SESSION['nomFenetre']?>">
			<input type="reset" name="boutResEstimer" id="boutResEstimer" value="Annuler">
			<input type="submit" name="boutSubEstimer" id="boutSubEstimer" value="Estimer">
		</form><?php
}
/*fonction permettant d'interagir avec la bdd pour realiser l'estimation*/
function traitementDonnees($veluxActuel,$taille,$finition,$ouverture,$type,$raccord,$volet,$store,$couleur){
	$compteur=0;
	$phrase="";
	if($taille=="0"){
		$compteur=$compteur+1;
		$phrase=$phrase."-La taille du velux <br/>";
	}
	if($finition=="0"){
		$compteur=$compteur+1;
		$phrase=$phrase."-La finition du velux <br/>";
	}
	if($ouverture=="0"){
		$compteur=$compteur+1;
		$phrase=$phrase."-L'ouverture du velux <br/>";
	}
	if($type=="0"){
		$compteur=$compteur+1;
		$phrase=$phrase."-Le type du velux <br/>";
	}
	if($raccord=="0"){
		$compteur=$compteur+1;
		$phrase=$phrase."-Le raccord du velux <br/>";
	}
	if($compteur!=0){
		if($compteur>1){
			echo"Les champs suivants n'ont pas etaient remplis : <br/>".$phrase;
		}
		else{
			echo"Le champs suivant n'a pas etait rempli : <br/>".$phrase;
		}
	}
	else
	{
		include'param/id.inc.php';
		try {
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$base,$utilisateur,$mdp);
			$selection_velux = $bdd->prepare('SELECT * FROM estimer WHERE reference_taille=? AND id_finition=? AND id_ouverture=? AND id_type=?');
			$selection_velux->execute(array($taille,$finition,$ouverture,$type));
			$nbVelux=$selection_velux->rowCount();
			
			$selection_raccord=$bdd->prepare('SELECT * FROM posseder WHERE reference_taille=? AND id_raccord=?');
			$selection_raccord->execute(array($taille,$raccord));
			$nbRaccord=$selection_raccord->rowCount();
			
			$selection_volet=$bdd->prepare('SELECT * FROM concerner WHERE reference_taille=? AND reference_volet=?');
			$selection_volet->execute(array($taille,$volet));
			$nbVolet=$selection_volet->rowCount();
			
			$selection_store=$bdd->prepare('SELECT * FROM appartenir WHERE reference_taille=? AND reference_store=?');
			$selection_store->execute(array($taille,$store));
			$nbStore=$selection_store->rowCount();
			
			if($nbVelux!=0){
				if($nbRaccord!=0){
					if($nbVolet !=0){
						if($nbStore !=0){
							while ($donneesVelux = $selection_velux->fetch()) {
								$referenceVelux=$donneesVelux['reference_velux'];
								$prixBaseVelux=$donneesVelux['prix_velux_base'];
								$tauxTvaTravaux=$donneesVelux['taux_tva_travaux_velux'];
							}
							while ($donneesRaccord = $selection_raccord->fetch()) {
								$referenceRaccord=$donneesRaccord['reference_raccord'];
								$prixraccord=$donneesRaccord['prix_raccord'];
							}
							while ($donneesVolet = $selection_volet->fetch()) {
								$prixVolet=$donneesVolet['prix_volet'];
							}
							while ($donneesStore = $selection_store->fetch()) {
								$tauxTvaTravauxStore=$donneesStore['taux_tva_travaux_store'];
								$prixStore=$donneesStore['prix_store'];
							}
							$selection_marge = $bdd->query('SELECT * FROM marge_prix_brut_velux');
							while ($donneesMarge = $selection_marge->fetch()) {
								$tauxMarge=$donneesMarge['taux_marge'];
							}
							$selection_prestation=$bdd->query('SELECT * FROM prestation_induite');
							while ($donneesPrestation = $selection_prestation->fetch()) {
								$tauxTvaPrestation=$donneesPrestation['taux_tva_main_oeuvre_prestation'];
								$prixPrestation=$donneesPrestation['prix_prestation'];
							}
							$selection_reduction=$bdd->query('SELECT * FROM reduction_prix_initial_velux');
							while ($donneesReduction = $selection_reduction->fetch()) {
								$tauxReduction=$donneesReduction['taux_reduction'];
							}
							$selection_Prix_Pose_Store=$bdd->prepare('SELECT * FROM store WHERE reference_store =?');
							$selection_Prix_Pose_Store->execute(array($store));
							while ($donneesPoseStore = $selection_Prix_Pose_Store->fetch()) {
								$tauxtvaMainOeuvreStore=$donneesPoseStore['taux_tva_main_oeuvre_store'];
								$prixPoseStore=$donneesPoseStore['prix_pose_store'];
							}
							$selection_Prix_Pose_Volet=$bdd->prepare('SELECT * FROM volet WHERE reference_volet =?');
							$selection_Prix_Pose_Volet->execute(array($volet));
							while ($donneesPoseVolet = $selection_Prix_Pose_Volet->fetch()) {
								$tauxtvaMainOeuvreVolet=$donneesPoseVolet['taux_tva_main_oeuvre_volet'];
								$tauxTvaTravauxVolet=$donneesPoseVolet['taux_tva_travaux_volet'];
								$prixPoseVolet=$donneesPoseVolet['prix_pose_volet'];
							}
							
							$selection_Prix_Pose_Raccord=$bdd->prepare('SELECT * FROM raccord WHERE reference_raccord =?');
							$selection_Prix_Pose_Raccord->execute(array($raccord));
							while ($donneesPoseRaccord = $selection_Prix_Pose_Raccord->fetch()) {
								$prixPoseRaccord=$donneesPoseRaccord['prix_pose_raccord'];
							}
							if($couleur!="0"){
								if($couleur=="1"){
									$prixCouleur=0;
								}
								else{
									$prixCouleur=0;
								}	
							}
							else{
								$prixCouleur=0;
							}
							if($veluxActuel=="3" || $veluxActuel=="4"){
								$suplement=80;
							}
							else{
								$suplement=0;
							}
							
						}
						else{
							while ($donneesVelux = $selection_velux->fetch()) {
								$referenceVelux=$donneesVelux['reference_velux'];
								$prixBaseVelux=$donneesVelux['prix_velux_base'];
								$tauxTvaTravaux=$donneesVelux['taux_tva_travaux_velux'];
							}
							while ($donneesRaccord = $selection_raccord->fetch()) {
								$referenceRaccord=$donneesRaccord['reference_raccord'];
								$prixraccord=$donneesRaccord['prix_raccord'];
							}
							while ($donneesVolet = $selection_volet->fetch()) {
								$prixVolet=$donneesVolet['prix_volet'];
							}
							$PrixStore=0;
							$prixPoseStore=0;
							$tauxTvaTravauxStore=0;
							$tauxtvaMainOeuvreStore=0;
							$selection_marge = $bdd->query('SELECT * FROM marge_prix_brut_velux');
							while ($donneesMarge = $selection_marge->fetch()) {
								$tauxMarge=$donneesMarge['taux_marge'];
							}
							$selection_prestation=$bdd->query('SELECT * FROM prestation_induite');
							while ($donneesPrestation = $selection_prestation->fetch()) {
								$tauxTvaPrestation=$donneesPrestation['taux_tva_main_oeuvre_prestation'];
								$prixPrestation=$donneesPrestation['prix_prestation'];
							}
							$selection_reduction=$bdd->query('SELECT * FROM reduction_prix_initial_velux');
							while ($donneesReduction = $selection_reduction->fetch()) {
								$tauxReduction=$donneesReduction['taux_reduction'];
							}
							$selection_Prix_Pose_Volet=$bdd->prepare('SELECT * FROM volet WHERE reference_volet =?');
							$selection_Prix_Pose_Volet->execute(array($volet));
							while ($donneesPoseVolet = $selection_Prix_Pose_Volet->fetch()) {
								$tauxtvaMainOeuvreVolet=$donneesPoseVolet['taux_tva_main_oeuvre_volet'];
								$tauxTvaTravauxVolet=$donneesPoseVolet['taux_tva_travaux_volet'];
								$prixPoseVolet=$donneesPoseVolet['prix_pose_volet'];
							}
								
							$selection_Prix_Pose_Raccord=$bdd->prepare('SELECT * FROM raccord WHERE reference_raccord =?');
							$selection_Prix_Pose_Raccord->execute(array($raccord));
							while ($donneesPoseRaccord = $selection_Prix_Pose_Raccord->fetch()) {
								$prixPoseRaccord=$donneesPoseRaccord['prix_pose_raccord'];
							}
						}
					}
					else{
						if($nbStore !=0){
							while ($donneesVelux = $selection_velux->fetch()) {
								$referenceVelux=$donneesVelux['reference_velux'];
								$prixBaseVelux=$donneesVelux['prix_velux_base'];
								$tauxTvaTravaux=$donneesVelux['taux_tva_travaux_velux'];
							}
							while ($donneesRaccord = $selection_raccord->fetch()) {
								$referenceRaccord=$donneesRaccord['reference_raccord'];
								$prixraccord=$donneesRaccord['prix_raccord'];
							}
							$prixVolet=0;
							$tauxtvaMainOeuvreVolet=0;
							$tauxTvaTravauxVolet=0;
							$prixPoseVolet=0;
							while ($donneesStore = $selection_store->fetch()) {
								$tauxTvaTravauxStore=$donneesStore['taux_tva_travaux_store'];
								$prixStore=$donneesStore['prix_store'];
							}
							$selection_marge = $bdd->query('SELECT * FROM marge_prix_brut_velux');
							while ($donneesMarge = $selection_marge->fetch()) {
								$tauxMarge=$donneesMarge['taux_marge'];
							}
							$selection_prestation=$bdd->query('SELECT * FROM prestation_induite');
							while ($donneesPrestation = $selection_prestation->fetch()) {
								$tauxTvaPrestation=$donneesPrestation['taux_tva_main_oeuvre_prestation'];
								$prixPrestation=$donneesPrestation['prix_prestation'];
							}
							$selection_reduction=$bdd->query('SELECT * FROM reduction_prix_initial_velux');
							while ($donneesReduction = $selection_reduction->fetch()) {
								$tauxReduction=$donneesReduction['taux_reduction'];
							}
							$selection_Prix_Pose_Store=$bdd->prepare('SELECT * FROM store WHERE reference_store =?');
							$selection_Prix_Pose_Store->execute(array($store));
							while ($donneesPoseStore = $selection_Prix_Pose_Store->fetch()) {
								$tauxtvaMainOeuvreStore=$donneesPoseStore['taux_tva_main_oeuvre_store'];
								$prixPoseStore=$donneesPoseStore['prix_pose_store'];
							}
							$selection_Prix_Pose_Raccord=$bdd->prepare('SELECT * FROM raccord WHERE reference_raccord =?');
							$selection_Prix_Pose_Raccord->execute(array($raccord));
							while ($donneesPoseRaccord = $selection_Prix_Pose_Raccord->fetch()) {
								$prixPoseRaccord=$donneesPoseRaccord['prix_pose_raccord'];
							}
							if($couleur!="0"){
								if($couleur=="1"){
									$prixCouleur=0;
								}
								else{
									$prixCouleur=0;
								}
							}
							else{
								$prixCouleur=0;
							}
							if($veluxActuel=="3" || $veluxActuel=="4"){
								$suplement=80;
							}
							else{
								$suplement=0;
							}
						}
						else{
							while ($donneesVelux = $selection_velux->fetch()) {
								$referenceVelux=$donneesVelux['reference_velux'];
								$prixBaseVelux=$donneesVelux['prix_velux_base'];
								$tauxTvaTravaux=$donneesVelux['taux_tva_travaux_velux'];
							}
							while ($donneesRaccord = $selection_raccord->fetch()) {
								$referenceRaccord=$donneesRaccord['reference_raccord'];
								$prixraccord=$donneesRaccord['prix_raccord'];
							}
							$prixVolet=0;
							$tauxtvaMainOeuvreVolet=0;
							$tauxTvaTravauxVolet=0;
							$prixPoseVolet=0;
							
							$PrixStore=0;
							$prixPoseStore=0;
							$tauxTvaTravauxStore=0;
							$tauxtvaMainOeuvreStore=0;
							
							$selection_marge = $bdd->query('SELECT * FROM marge_prix_brut_velux');
							while ($donneesMarge = $selection_marge->fetch()) {
								$tauxMarge=$donneesMarge['taux_marge'];
							}
							$selection_prestation=$bdd->query('SELECT * FROM prestation_induite');
							while ($donneesPrestation = $selection_prestation->fetch()) {
								$tauxTvaPrestation=$donneesPrestation['taux_tva_main_oeuvre_prestation'];
								$prixPrestation=$donneesPrestation['prix_prestation'];
							}
							$selection_reduction=$bdd->query('SELECT * FROM reduction_prix_initial_velux');
							while ($donneesReduction = $selection_reduction->fetch()) {
								$tauxReduction=$donneesReduction['taux_reduction'];
							}
							$selection_Prix_Pose_Raccord=$bdd->prepare('SELECT * FROM raccord WHERE reference_raccord =?');
							$selection_Prix_Pose_Raccord->execute(array($raccord));
							while ($donneesPoseRaccord = $selection_Prix_Pose_Raccord->fetch()) {
								$prixPoseRaccord=$donneesPoseRaccord['prix_pose_raccord'];
							}
							if($couleur!="0"){
								if($couleur=="1"){
									$prixCouleur=0;
								}
								else{
									$prixCouleur=0;
								}
							}
							else{
								$prixCouleur=0;
							}
							if($veluxActuel=="3" || $veluxActuel=="4"){
								$suplement=80;
							}
							else{
								$suplement=0;
							}
						}
					}
					
					if($nbVolet!="0")
					{
						if($nbStore!="0")
						{
							if($couleur!="0")
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								$selection_libelle_volet=$bdd->prepare('SELECT * FROM volet WHERE reference_volet =?');
								$selection_libelle_volet->execute(array($volet));
								while ($donneesLibelleVolet = $selection_libelle_volet->fetch()) {
									$referenceVolet=$donneesLibelleVolet['reference_volet'];
									$libelleVolet=$donneesLibelleVolet['libelle_volet'];
								}
								$selection_libelle_store=$bdd->prepare('SELECT * FROM store WHERE reference_store =?');
								$selection_libelle_store->execute(array($store));
								while ($donneesLibelleStore = $selection_libelle_store->fetch()) {
									$referenceStore=$donneesLibelleStore['reference_store'];
									$libelleStore=$donneesLibelleStore['libelle_store'];
								}
								if($couleur=="1"){
									$couleur="Standards";
								}
								else 
								{
									$couleur="Autres Couleurs";
								}
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante : 
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : (".$referenceVolet.")".$libelleVolet."
								<br/>Store :(".$referenceStore.")".$libelleStore."
								<br/>Reference velux : ".$referenceVelux."
								<br/>Couleur : ".$couleur."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
					
							}
							else 
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								$selection_libelle_volet=$bdd->prepare('SELECT * FROM volet WHERE reference_volet =?');
								$selection_libelle_volet->execute(array($volet));
								while ($donneesLibelleVolet = $selection_libelle_volet->fetch()) {
									$referenceVolet=$donneesLibelleVolet['reference_volet'];
									$libelleVolet=$donneesLibelleVolet['libelle_volet'];
								}
								$selection_libelle_store=$bdd->prepare('SELECT * FROM store WHERE reference_store =?');
								$selection_libelle_store->execute(array($store));
								while ($donneesLibelleStore = $selection_libelle_store->fetch()) {
									$referenceStore=$donneesLibelleStore['reference_store'];
									$libelleStore=$donneesLibelleStore['libelle_store'];
								}
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante :
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : (".$referenceVolet.")".$libelleVolet."
								<br/>Store :(".$referenceStore.")".$libelleStore."
								<br/>Reference velux : ".$referenceVelux."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
							}
						}
						else 
						{
							if($couleur!="0")
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								$selection_libelle_volet=$bdd->prepare('SELECT * FROM volet WHERE reference_volet =?');
								$selection_libelle_volet->execute(array($volet));
								while ($donneesLibelleVolet = $selection_libelle_volet->fetch()) {
									$referenceVolet=$donneesLibelleVolet['reference_volet'];
									$libelleVolet=$donneesLibelleVolet['libelle_volet'];
								}
								
								if($couleur=="1"){
									$couleur="Standards";
								}
								else
								{
									$couleur="Autres Couleurs";
								}
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante :
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : (".$referenceVolet.")".$libelleVolet."
								<br/>Store :Sans
								<br/>Reference velux : ".$referenceVelux."
								<br/>Couleur : ".$couleur."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
						}
						else
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								$selection_libelle_volet=$bdd->prepare('SELECT * FROM volet WHERE reference_volet =?');
								$selection_libelle_volet->execute(array($volet));
								while ($donneesLibelleVolet = $selection_libelle_volet->fetch()) {
									$referenceVolet=$donneesLibelleVolet['reference_volet'];
									$libelleVolet=$donneesLibelleVolet['libelle_volet'];
								}
								
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante :
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : (".$referenceVolet.")".$libelleVolet."
								<br/>Store :Sans
								<br/>Reference velux : ".$referenceVelux."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
							}	
						}
					}
					else
					{
						if($nbStore!="0")
						{
							if($couleur!="0")
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								
								$selection_libelle_store=$bdd->prepare('SELECT * FROM store WHERE reference_store =?');
								$selection_libelle_store->execute(array($store));
								while ($donneesLibelleStore = $selection_libelle_store->fetch()) {
									$referenceStore=$donneesLibelleStore['reference_store'];
									$libelleStore=$donneesLibelleStore['libelle_store'];
								}
								
								if($couleur=="1"){
									$couleur="Standards";
								}
								else
								{
									$couleur="Autres Couleurs";
								}
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante :
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : Sans 
								<br/>Store :(".$referenceStore.")".$libelleStore."
								<br/>Reference velux : ".$referenceVelux."
								<br/>Couleur : ".$couleur."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
							}
							else
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								
								$selection_libelle_store=$bdd->prepare('SELECT * FROM store WHERE reference_store =?');
								$selection_libelle_store->execute(array($store));
								while ($donneesLibelleStore = $selection_libelle_store->fetch()) {
									$referenceStore=$donneesLibelleStore['reference_store'];
									$libelleStore=$donneesLibelleStore['libelle_store'];
								}
								
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante :
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : Sans
								<br/>Store :(".$referenceStore.")".$libelleStore."
								<br/>Reference velux : ".$referenceVelux."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
							}
						}
						else
						{
							if($couleur!="0")
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								
								if($couleur=="1"){
									$couleur="Standards";
								}
								else
								{
									$couleur="Autres Couleurs";
								}
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante :
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : Sans
								<br/>Store : Sans
								<br/>Reference velux : ".$referenceVelux."
								<br/>Couleur : ".$couleur."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
							}
							else
							{
								$selection_libelle_taille=$bdd->prepare('SELECT * FROM taille WHERE reference_taille =?');
								$selection_libelle_taille->execute(array($taille));
								while ($donneesLibelleTaille = $selection_libelle_taille->fetch()) {
									$libelleTaille=$donneesLibelleTaille['libelle_taille'];
								}
								$selection_libelle_finition=$bdd->prepare('SELECT * FROM finition WHERE id_finition =?');
								$selection_libelle_finition->execute(array($finition));
								while ($donneesLibelleFinition = $selection_libelle_finition->fetch()) {
									$libelleFinition=$donneesLibelleFinition['libelle_finition'];
								}
								$selection_libelle_ouverture=$bdd->prepare('SELECT * FROM ouverture WHERE id_ouverture =?');
								$selection_libelle_ouverture->execute(array($ouverture));
								while ($donneesLibelleOuverture = $selection_libelle_ouverture->fetch()) {
									$libelleOuverture=$donneesLibelleOuverture['libelle_ouverture'];
								}
								$selection_libelle_type=$bdd->prepare('SELECT * FROM type_velux WHERE id_type =?');
								$selection_libelle_type->execute(array($type));
								while ($donneesLibelleType = $selection_libelle_type->fetch()) {
									$libelleType=$donneesLibelleType['libelle_type'];
								}
								$selection_libelle_raccord=$bdd->prepare('SELECT * FROM raccord WHERE id_raccord =?');
								$selection_libelle_raccord->execute(array($raccord));
								while ($donneesLibelleRaccord = $selection_libelle_raccord->fetch()) {
									$libelleRaccord=$donneesLibelleRaccord['libelle_raccord'];
								}
								$selection_reference_raccord=$bdd->prepare('SELECT * FROM posseder WHERE id_raccord =? AND reference_taille=?');
								$selection_reference_raccord->execute(array($raccord,$taille));
								while ($donneesReferenceRaccord = $selection_reference_raccord->fetch()) {
									$referenceRaccord=$donneesReferenceRaccord['reference_raccord'];
								}
								
								
								$prixEstimation=0;
								echo"Resultat pour l'estimation suivante :
								<br/>Taille :(".$taille.")".$libelleTaille."
								<br/>Finition :".$libelleFinition."
								<br/>Ouverture :".$libelleOuverture."
								<br/>Type de velux :".$libelleType."
								<br/>Raccord :(".$referenceRaccord.")".$libelleRaccord."
								<br/>Volet : Sans
								<br/>Store : Sans
								<br/>Reference velux : ".$referenceVelux."
								<br/><br/>Total de l'estimation :".$prixEstimation." €";
							}
						}	
					}
			
				}
				else{
					echo"Estimation impossible car ce probuit n'existe pas.";
				}
			}
			else{
				echo"Estimation impossible car ce probuit n'existe pas.";
			}
		}
		catch (Exception $erreur) {
			die('Erreur : '.$erreur->getMessage());
		}
	}

	
}
