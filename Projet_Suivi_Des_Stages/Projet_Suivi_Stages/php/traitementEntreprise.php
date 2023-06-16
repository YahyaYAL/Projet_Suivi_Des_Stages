<?php

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	include('connexion.php');
	include('requetesSql.php');
	include('fonctions.php');

	// Stocker les valeurs du $_POST dans une sessiton
	stockerPostSession();


	$nom = testInput($_POST['nom']);
	//$chef = $_POST['chef'];
	$adresse = testInput($_POST['adresse']);
	$ville = testInput($_POST['ville']);
	$codePostal = testInput($_POST['codepostal']);
	$telephone = testInput($_POST['telephone']);
	$email = testInput($_POST['email']);
	$service = testInput($_POST["service"]);
	$siteweb = testInput($_POST['siteweb']);


	// Vérification du format
    $erreur = '';
    $err = '';

	$err = verifierNom($nom);
    $erreur .= $err;

	$err = verifierTelephone($telephone);
    $erreur .= $err;

	$err = verifierEmail($email);
    $erreur .= $err;


	if ($erreur != '') {
        header('Location: pageSaisiEntreprise.php?' . $erreur);
        exit();
    } else {
    
    	// Récupérer l'id du service
    	$stmtServiceId = $connexion->prepare($sqlServiceId);
    	$stmtServiceId->bindParam(':service', $service);
    	$stmtServiceId->execute();
    	$rowServiceId = $stmtServiceId->fetch(PDO::FETCH_ASSOC);
    	$serviceId = $rowServiceId['id'];

    	$chiNom = chiffrerDonnee($nom);
        $chiTelephone = chiffrerDonnee($telephone);
        $chiMail = chiffrerDonnee($email);
    
    	// Requête d'insertion des données dans la table entreprises
    	$stmtInsertEntreprise = $connexion->prepare($sqlInsertEntreprise);
    
    	$stmtInsertEntreprise->bindParam(':nom', $chiNom);
    	$stmtInsertEntreprise->bindParam(':adresse', $adresse);
    	$stmtInsertEntreprise->bindParam(':ville', $ville);
    	$stmtInsertEntreprise->bindParam(':codePostal', $codePostal);
    	$stmtInsertEntreprise->bindParam(':telephone', $chiTelephone);
    	$stmtInsertEntreprise->bindParam(':email', $chiMail);
    	$stmtInsertEntreprise->bindParam(':serviceId', $serviceId);
    	$stmtInsertEntreprise->bindParam(':siteweb', $siteweb);

    	// Exécution de la requête
    	if ($stmtInsertEntreprise->execute()) {
       		// Redirection vers page_saisi.php avec un message de succès
        	// header("Location: page_saisi.php?message=success");
        	// exit();
        	echo "C'est ok !";
        	supprimerPost();
    	} else {
        	// Redirection vers page_saisi.php avec un message d'erreur
        	// header("Location: page_saisi.php?message=error");
        	// exit();
        	echo "Opps! : " . $stmtInsertEntreprise->errorInfo();
    	}

		// Fermer la connexion
		$connexion = null;
    }
}else
{
    header('Location: ../index.php');
}
?>