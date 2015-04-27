<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="Stylesheet" type="text/css" media="screen" href="css/style.css"/>
<title>Estimateur</title>
</head>

    <body>
    <section class="estimation">
	<?php include'param/id.inc.php';
	include'function/autres/function.php'?>
	
	<input type="button" name="imprimer" id="imprimer" class="imprimer" value="imprimer" onclick="window.print()";>
	<?php
	
		session_start();
	/* verifie si on a bien cliquer sur le bouton estimer*/
	if(isset($_POST['boutSubEstimer'])){
		/*recuperation des données du formulaire d permettant l'estimation et celle-ci sont stockées dans des variables de sessions*/
		$_SESSION['typeActuel']=$_POST['velux_actuel'];
		$_SESSION['taille']=$_POST['selectTaille'];
		$_SESSION['finition']=$_POST['selectFinition'];
		$_SESSION['ouverture']=$_POST['selectOuverture'];
		$_SESSION['type']=$_POST['selectType'];
		$_SESSION['raccord']=$_POST['selectTuile'];
		$_SESSION['volet']=$_POST['selectVolet'];
		$_SESSION['store']=$_POST['selectStore'];
		$_SESSION['couleur']=$_POST['couleur'];
		$_SESSION['nomFenetre']=$_POST['nomVelux'];?>
		<!-- formulaire permettant de renommer la piece -->
		
				<form name="renommer" id="renommer" class="renommer" action="http://localhost/simulateur_velux/estimateur.php" method="post" enctype="multipart/form-data">
					<span id='Formfenetre1'><?php echo $_SESSION['nomFenetre']?> :<input style="maxlength="100" type="text" name="fenetre1Nom"id="fenetre1Nom"
					placeholder="Renommer une piece"></span> 
					<input type="hidden" name="typeActuel" id="typeActuel" value="<?php echo $_SESSION['typeActuel'];?>">
					<input type="hidden" name="taille" id="taille" value="<?php echo $_SESSION['taille'];?>">
					<input type="hidden" name="finition" id="finition" value="<?php echo $_SESSION['finition'];?>">
					<input type="hidden" name="ouverture" id="ouverture" value="<?php echo $_SESSION['ouverture'];?>">
					<input type="hidden" name="type" id="type" value="<?php echo $_SESSION['type'];?>">
					<input type="hidden" name="raccord" id="raccord" value="<?php echo $_SESSION['raccord'];?>">
					<input type="hidden" name="volet" id="volet" value="<?php echo $_SESSION['volet'];?>">
					<input type="hidden" name="store" id="store" value="<?php echo $_SESSION['store'];?>">
					<input type="hidden" name="couleur" id="couleur" value="<?php echo $_SESSION['couleur'];?>">
					<span><input class="fenetre1Boutton" type="submit" name="fenetre1Boutton" id="fenetre1Boutton" value="renommer"/></span><br/><?php 
					?>
				</form>
	<section name="estimation" id="estimation"class="estimer">	
	 <?php 
				/* appel de la fonction formulaireSub permettant d'afficher le formulaire avec les données slectionnées*/ 
				formulaireSub($_SESSION['typeActuel'],$_SESSION['taille'],$_SESSION['finition'],$_SESSION['ouverture'],$_SESSION['type'],$_SESSION['raccord'],$_SESSION['volet'],$_SESSION['store'],$_SESSION['couleur'],$_SESSION['nomFenetre']);?>
		
		
		<form name="nouvelleEst" id="nouvelleEst" style="margin-left:250px; action="http://localhost/simulateur_velux/estimateur.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="nomPiece" id="nomPiece" value="<?php echo $_SESSION['nomFenetre'] ?>">
			<input type="submit" name="boutSubNew" id="boutSubNew" value="Nouvelle Estimation">
		</form>
			<section class="traitement">
			<?php 
			
			/* appel de la fonction traitementDonnees permettant d'afficher l'estimation */
			traitementDonnees($_SESSION['typeActuel'],$_SESSION['taille'],$_SESSION['finition'],$_SESSION['ouverture'],$_SESSION['type'],$_SESSION['raccord'],$_SESSION['volet'],$_SESSION['store'],$_SESSION['couleur'],$_SESSION['nomFenetre']);
	?></section>
	</section><?php 
	}
	/* si on à pas cliquer sur le bouton estimer*/
	else 
	{
		/* Verification que l'on à bien cliquer sur le bouton renommer*/
		if(isset($_POST['fenetre1Boutton'])){
			/*recuperation des données du formulaire renommer.
			 * Celles-ci sont stockées dans des variables de sessions*/
			$_SESSION['nomFenetre']=htmlspecialchars($_POST['fenetre1Nom']);
			$_SESSION['typeActuel']=$_POST['typeActuel'];
			$_SESSION['taille']=$_POST['taille'];
			$_SESSION['finition']=$_POST['finition'];
			$_SESSION['ouverture']=$_POST['ouverture'];
			$_SESSION['type']=$_POST['type'];
			$_SESSION['raccord']=$_POST['raccord'];
			$_SESSION['volet']=$_POST['volet'];
			$_SESSION['store']=$_POST['store'];
			$_SESSION['couleur']=$_POST['couleur'];?>
			<!-- formulaire permettant de renommer la piece -->
			
				<form name="renommer" id="renommer" class="renommer" action="http://localhost/simulateur_velux/estimateur.php" method="post" enctype="multipart/form-data">
					<span id='Formfenetre1'><?php echo $_SESSION['nomFenetre']?> :<input style="maxlength="100" type="text" name="fenetre1Nom"id="fenetre1Nom" 
					placeholder="Renommer une piece"/></span> 
					<input type="hidden" name="typeActuel" id="typeActuel" value="<?php echo $_SESSION['typeActuel'];?>">
					<input type="hidden" name="taille" id="taille" value="<?php echo $_SESSION['taille'];?>">
					<input type="hidden" name="finition" id="finition" value="<?php echo $_SESSION['finition'];?>">
					<input type="hidden" name="ouverture" id="ouverture" value="<?php echo $_SESSION['ouverture'];?>">
					<input type="hidden" name="type" id="type" value="<?php echo $_SESSION['type'];?>">
					<input type="hidden" name="raccord" id="raccord" value="<?php echo $_SESSION['raccord'];?>">
					<input type="hidden" name="volet" id="volet" value="<?php echo $_SESSION['volet'];?>">
					<input type="hidden" name="store" id="store" value="<?php echo $_SESSION['store'];?>">
					<input type="hidden" name="couleur" id="couleur" value="<?php echo $_SESSION['couleur'];?>">
					<span><input class="fenetre1Boutton" type="submit" name="fenetre1Boutton" id="fenetre1Boutton" value="renommer"/></span>
					<br/>
				</form>
			
			<section name="estimation" id="estimation"class="estimer">
				<?php
				/*verification que l'on à bien selectionnés les champs obligatoires*/
				if($_SESSION['taille']=='0' && $_SESSION['finition']=='0' && $_SESSION['ouverture']=='0' && $_SESSION['type']=='0' ){
					formulaire();
					
				}
				else 
				{
					formulaireSub($_SESSION['typeActuel'],$_SESSION['taille'],$_SESSION['finition'],$_SESSION['ouverture'],$_SESSION['type'],$_SESSION['raccord'],$_SESSION['volet'],$_SESSION['store'],$_SESSION['couleur'],$_SESSION['nomFenetre']);
					?>
			
						<form name="nouvelleEst" id="nouvelleEst" action="http://localhost/simulateur_velux/estimateur.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="nomPiece" id="nomPiece" value="<?php echo $_SESSION['nomFenetre'] ?>">
							<input type="submit" name="boutSubNew" id="boutSubNew" value="Nouvelle Estimation">
						</form>
					<section class="traitement">
					<?php 
					
					traitementDonnees($_SESSION['typeActuel'],$_SESSION['taille'],$_SESSION['finition'],$_SESSION['ouverture'],$_SESSION['type'],$_SESSION['raccord'],$_SESSION['volet'],$_SESSION['store'],$_SESSION['couleur'],$_SESSION['nomFenetre']);
					?>
					</section><?php 
				}
			?></section><?php 
		
			
			
		}
		/* si on à pas cliquer sur le bouton renommer*/
		else{
					
					/*recuperation dans variables de sessions des données du formulaire permettant de renommer la piece*/
					$_SESSION['typeActuel']='0';
					$_SESSION['taille']='0';
					$_SESSION['finition']='0';
					$_SESSION['ouverture']='0';
					$_SESSION['type']='0';
					$_SESSION['raccord']='0';
					$_SESSION['volet']='0';
					$_SESSION['store']='0';
					$_SESSION['couleur']='0';
					if(isset($_POST['boutSubNew']))
					{
						$_SESSION['nomFenetre']=htmlspecialchars($_POST['nomPiece']);
					}
					else 
					{
						$_SESSION['nomFenetre']="Nom de la piece";
					}
					
				?>
				<!-- formulaire permettant de renommer la piece -->
				
					<form name="renommer" id="renommer"  class="renommer" action="http://localhost/simulateur_velux/estimateur.php" method="post" enctype="multipart/form-data">
						<span id='Formfenetre1'><?php echo $_SESSION['nomFenetre']?> :<input style="maxlength="100" type="text" name="fenetre1Nom"id="fenetre1Nom" 
						placeholder="Renommer une piece"></span>
						<input type="hidden" name="typeActuel" id="typeActuel" value="<?php echo $_SESSION['typeActuel'];?>">
						<input type="hidden" name="taille" id="taille" value="<?php echo $_SESSION['taille'];?>">
						<input type="hidden" name="finition" id="finition" value="<?php echo $_SESSION['finition'];?>">
						<input type="hidden" name="ouverture" id="ouverture" value="<?php echo $_SESSION['ouverture'];?>">
						<input type="hidden" name="type" id="type" value="<?php echo $_SESSION['type'];?>">
						<input type="hidden" name="raccord" id="raccord" value="<?php echo $_SESSION['raccord'];?>">
						<input type="hidden" name="volet" id="volet" value="<?php echo $_SESSION['volet'];?>">
						<input type="hidden" name="store" id="store" value="<?php echo $_SESSION['store'];?>">
						<input type="hidden" name="couleur" id="couleur" value="<?php echo $_SESSION['couleur'];?>"> 
						<span>
							
							<span><input class="fenetre1Boutton" type="submit" name="fenetre1Boutton" id="fenetre1Boutton" value="renommer"/></span>
						</span>
						<br/>
					</form>
				
				 <section name="estimation" id="estimation"class="estimer">
					<!-- appel de la fonction formulaire permettant d'afficher un formulaire d'estimation vide -->
					<?php formulaire();?>
				</section><?php 
			
		}
		
		 
	}?>
	
	</section>
   </body>
  

</html>