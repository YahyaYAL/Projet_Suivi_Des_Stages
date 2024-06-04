<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	include('connexion.php');
	include('requetesSql.php');
	include('fonctions.php');

	// Stocker les valeurs du $_POST dans une sessiton
	stockerPostSession();

    $etudiantId = testInput($_POST['etudiant']);
	$entrepriseId = testInput($_POST['entreprise']);
    $dateDebut = testInput(dateConvert($_POST['dateDebut']));
    $dateFin = testInput(dateConvert($_POST['dateFin']));
    $nomTuteur = testInput($_POST['nomTuteur']);
	$prenomTuteur = testInput($_POST['prenomTuteur']);
	$civiliteTuteur =  testInput($_POST['civilite']);
	$fonctionTuteur = testInput($_POST['fonctionTuteur']);
    $numeroTuteur = testInput($_POST['numeroTuteur']);
    $mailTuteur = testInput($_POST['mailTuteur']);
	
	// Vérification du format
    $erreur = '';
    $err = '';

    $err = verifierNom($nomTuteur);
    $erreur .= $err;

	$err = verifierNom($prenomTuteur);
    $erreur .= $err;
	
	$err = verifierTelephone($numeroTuteur);
    $erreur .= $err;

    $err = verifierEmail($mailTuteur);
    $erreur .= $err;
	

	if ($erreur != '') {
        header('Location: pageSaisiStage.php?' . $erreur);
        exit();
    } else {
    	 // Insérer les informations du tuteur dans la table "tuteurs"
        $stmtInsertTuteur = $connexion->prepare($sqlInsertTuteur);
    
    	$chiNom = chiffrerDonnee($nomTuteur);
        $chiPrenom = chiffrerDonnee($prenomTuteur);
        $chiCivilite = chiffrerDonnee($civiliteTuteur);
        $chiNumero = chiffrerDonnee($numeroTuteur);
        $chiMail = chiffrerDonnee($mailTuteur);
    
    
        $stmtInsertTuteur->bindParam(':nomTuteur', $chiNom);
        $stmtInsertTuteur->bindParam(':prenomTuteur', $chiPrenom);
    	$stmtInsertTuteur->bindParam(':civilite', $chiCivilite);
    	$stmtInsertTuteur->bindParam(':fonctionTuteur', $fonctionTuteur);
        $stmtInsertTuteur->bindParam(':numeroTuteur', $chiNumero);
        $stmtInsertTuteur->bindParam(':mailTuteur', $chiMail);
        $stmtInsertTuteur->execute();

        // Récupérer l'ID généré automatiquement
        $tuteurId = $connexion->lastInsertId();

        // Insérer un stage dans la table stages
        $stmtInsertStage = $connexion->prepare($sqlInsertStage);
        $stmtInsertStage->bindParam(':etudiantId', $etudiantId);
        $stmtInsertStage->bindParam(':entrepriseId', $entrepriseId);
        $stmtInsertStage->bindParam(':tuteurId', $tuteurId);
        $stmtInsertStage->bindParam(':dateDebut', $dateDebut);
        $stmtInsertStage->bindParam(':dateFin', $dateFin);
        $stmtInsertStage->execute();

        // Vérifier si l'insertion s'est bien déroulée
        if ($stmtInsertStage->rowCount() > 0) {
            echo "c'est ok !";
        } else {
            echo "Une erreur s'est produite lors de l'ajout du stage.";
        }
    	supprimerPost();
	}
    // Fermer la connexion à la base de données
    $connexion = null;
    }
else
{
    header('Location: ../index.php');
}

?>