<?php
function selection_id($table,$id_champs){
	try {
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$hote.';dbname='.$base,$utilisateur,$mdp);
		$selection_taille = $bdd->prepare('SELECT * FROM taille');
		$selection_taille->execute(array());
				while ($donnees = $selection_taille->fetch()) { ?>
					$id=$donnees[''];
		 <?php }
				
	}
	catch (Exception $erreur) {
		die('Erreur : '.$erreur->getMessage());
	}
			
}
?>
