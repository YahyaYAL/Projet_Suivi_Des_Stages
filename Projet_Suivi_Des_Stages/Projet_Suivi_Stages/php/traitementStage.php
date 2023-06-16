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

    $etudiant = testInput($_POST['etudiant']);
	$entreprise = testInput($_POST['entreprise']);
    $dateDebut = testInput($_POST['dateDebut']);
    $dateFin = testInput($_POST['dateFin']);
    $nomTuteur = testInput($_POST['nomTuteur']);
	$prenomTuteur = testInput($_POST['prenomTuteur']);
	$civiliteTuteur =  testInput($_POST['civilite']);
	$fonctionTuteur = testInput($_POST['fonctionTuteur']);
    $numeroTuteur = testInput($_POST['numeroTuteur']);
    $mailTuteur = testInput($_POST['mailTuteur']);
	$etudiantId = $_POST['etudiantId'];
	
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
    
    
        $stmtInsertTuteur->bindParam(':nomTuteur', $nomTuteur);
        $stmtInsertTuteur->bindParam(':prenomTuteur', $prenomTuteur);
    	$stmtInsertTuteur->bindParam(':civilite', $civiliteTuteur);
    	$stmtInsertTuteur->bindParam(':fonctionTuteur', $fonctionTuteur);
        $stmtInsertTuteur->bindParam(':numeroTuteur', $numeroTuteur);
        $stmtInsertTuteur->bindParam(':mailTuteur', $mailTuteur);
        $stmtInsertTuteur->execute();

        // Récupérer l'ID généré automatiquement
        $tuteurId = $connexion->lastInsertId();

        // Récupérer l'ID de l'entreprise
        $stmtEntrepriseId = $connexion->prepare($sqlEntrepriseId);
        $stmtEntrepriseId->bindParam(':entreprise', $entreprise);
        $stmtEntrepriseId->execute();
        $rowEntrepriseId = $stmtEntrepriseId->fetch(PDO::FETCH_ASSOC);
        $entrepriseId = $rowEntrepriseId['id'];

        // Récupérer l'ID de l'étudiant
        $stmtEtudiantId = $connexion->prepare($sqlEtudiantId);
        $stmtEtudiantId->bindParam(':etudiant', $etudiant);
        $stmtEtudiantId->execute();
        $rowEtudiantId = $stmtEtudiantId->fetch(PDO::FETCH_ASSOC);
        $etudiantId = $rowEtudiantId['id'];

        // Insérer un stage dans la table stages
    /*
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
        	supprimerPost();
        } else {
            echo "Une erreur s'est produite lors de l'ajout du stage.";
        }
*/
    echo $etudiantId . "<br>" .
    $etudiantId . "<br>" .
    $tuteurId . "<br>" .
    $dateDebut . "<br>" .
    $dateFin . "<br>" . "<br>";
    		
    foreach ($_POST as $cle => $valeur) {
    echo $cle . " : " . $valeur . "<br>";
   
}
    
    echo $etudiantId . "<br>";
    echo $entrepriseId . "<br>";
    
    // Fermer la connexion à la base de données
    $connexion = null;
    }
}else
{
    header('Location: ../index.php');
}

?>