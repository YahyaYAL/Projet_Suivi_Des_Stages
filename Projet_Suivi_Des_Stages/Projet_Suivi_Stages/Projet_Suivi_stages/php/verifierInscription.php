<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	// Connexion à la base de données
		include('connexion.php');
		include('fonctions.php');
		include('requetesSql.php');
	
	if (isset($_POST['action']) && $_POST['action'] === 'verifier') {
    	

		$nom = $_POST['lastname'];
		$prenom = $_POST['firstname'];
		$date = dateConvert($_POST['dateNaissance']);
		$mail = $_POST['email'];

		echo $nom;
		echo $prenom;
		echo $date;
		echo $mail;


		// Récupérer toutes les données chiffrées des étudiants de la base de données
		$sqlSelectEtudiants = "SELECT id, nom, prenom, dateNaissance FROM user";
		$stmtSelectEtudiants = $connexion->query($sqlSelectEtudiants);
		$etudiantsChiffres = $stmtSelectEtudiants->fetchAll(PDO::FETCH_ASSOC);


		$EtudiantExistant = false;

		foreach ($etudiantsChiffres as $etudiantChiffre) {
    		$nomChiffre = $etudiantChiffre['nom'];
    		$prenomChiffre = $etudiantChiffre['prenom'];
    		$dateNaissanceChiffre = $etudiantChiffre['dateNaissance'];

    		$nomDechiffre = dechiffrerDonnee($nomChiffre);
    		$prenomDechiffre = dechiffrerDonnee($prenomChiffre);
    		$dateNaissanceDechiffre = dechiffrerDonnee($dateNaissanceChiffre);
		
    		echo $nomDechiffre ." ";
			echo $prenomDechiffre ." ";
			echo $dateNaissanceDechiffre ." " . "<br>";
                
    		if ($nomDechiffre == $nom && $prenomDechiffre == $prenom && $dateNaissanceDechiffre === $date) {
        		// L'étudiant existe déjà, passer à la ligne suivante
        		$EtudiantExistant = true;
        		$id = $etudiantChiffre['id'];
        		break;
    		}
		}


		if ($EtudiantExistant === true) {
			$etudiantInscrit = false;

			$sqlMailUser = "SELECT identifiant FROM login";
			$stmtMailUser = $connexion->query($sqlMailUser);
			$ArrayMailChiffres = $stmtMailUser->fetchAll(PDO::FETCH_ASSOC);
	
	

			foreach ($ArrayMailChiffres as $mailChiffre) {
    			$mailDechiffre = dechiffrerDonnee($mailChiffre['identifiant']);
    
    			if ($mailDechiffre === $mail){
        			$etudiantInscrit = true;
        			break;
        		}
    		}
	
		// l'étudiant inscrit
		if ($etudiantInscrit === true) {
			header('Location: inscription.php?err=2');
			exit();
		}else{
    		session_start();
			$_SESSION['isExist'] = true;
    		$_SESSION['id'] = $id;
    		$_SESSION['mail'] = $mail;
			header('Location: inscription.php');
			exit();
    	}

	}else{
		// L'étudiant n'existe pas
		header('Location: inscription.php?err=1');
	}
    	
    }

	if (isset($_POST['action']) && $_POST['action'] === 'inscription') {
		
		$email2 = chiffrerDonnee($_POST['email2']);
	 	$mdp = $_POST['mdp'];
    	$mdp2 = $_POST['mdp2'];
    	
    
    	if ($mdp === $mdp2) {
        	$mdp = chiffrerDonnee($_POST['mdp']);
        	$sqlInsertLogin = "INSERT INTO login (id, identifiant, mdp) 
        					VALUES (:id, :identifiant, :mdp)";
        	session_start();
        	$id = $_SESSION['id'];
        
        	$stmtInsertLogin = $connexion->prepare($sqlInsertLogin);
        	$stmtInsertLogin->bindValue(':id', $id); 
    		$stmtInsertLogin->bindValue(':identifiant', $email2);
    		$stmtInsertLogin->bindValue(':mdp', $mdp);
        
        	// Exécuter la requête
    		if ($stmtInsertLogin->execute()) {
        		// Insertion réussie
        		echo "Le login a été inséré avec succès !";
            	
    		} else {
        		// Échec de l'insertion
        		echo "Erreur : Impossible d'insérer le login.";
        		 $stmtInsertLogin->errorInfo();
    		}
        }else {
    		// Les mots de passe ne correspondent pas
    		echo "Erreur : Les mots de passe ne correspondent pas.";
		}
    	session_destroy();
	}

}
?>