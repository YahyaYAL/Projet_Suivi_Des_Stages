<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connexion à la base de données
    include('connexion.php');
    include('requetesSql.php');
	include('fonctions.php');
	
	// Stocker les valeurs du $_POST dans une sessiton
	stockerPostSession();

    $nom = testInput($_POST['nom']);
    $prenom = testInput($_POST['prenom']);
    $dateNaissance = testInput($_POST['dateNaissance']);
    $section = testInput($_POST['section']);
    $option = testInput($_POST['option']);
    $annee = testInput($_POST['annee']);
    $telephone = testInput($_POST['telephone']);
    $email = testInput($_POST['email']);


    // Vérification du format
    $erreur = '';
    $err = '';

    $err = verifierNom($nom);
    $erreur .= $err;

    $err = verifierNom($prenom);
    $erreur .= $err;

    $err = verifierDate($dateNaissance);
    $erreur .= $err;

    $err = verifierTelephone($telephone);
    $erreur .= $err;

    $err = verifierEmail($email);
    $erreur .= $err;


    if ($erreur != '') {
        header('Location: pageSaisiEtudiant.php?' . $erreur);
        exit();
    } else {

            // Récupérer l'id de la section
            $stmtSection = $connexion->prepare($sqlSectionId);
            $stmtSection->bindParam(':section', $section);
            $stmtSection->execute();
            $rowSection = $stmtSection->fetch(PDO::FETCH_ASSOC);
            $sectionId = $rowSection['id'];

            // Récupérer l'id de l'option
            $stmtOption = $connexion->prepare($sqlOptionId);
            $stmtOption->bindParam(':option', $option);
            $stmtOption->execute();
            $rowOption = $stmtOption->fetch(PDO::FETCH_ASSOC);
            $optionId = $rowOption['id'];

            // Récupérer l'id de l'année
            $stmtAnnee = $connexion->prepare($sqlAnneeId);
            $stmtAnnee->bindParam(':annee', $annee);
            $stmtAnnee->execute();
            $rowAnnee = $stmtAnnee->fetch(PDO::FETCH_ASSOC);
            $anneeId = $rowAnnee['id'];

            // Requête d'insertion des données dans la table etudiants
            $stmtInsertEtudiant = $connexion->prepare($sqlInsertEtudiant);

    		$chiNom = chiffrerDonnee($nom);
    		$chiPrenom = chiffrerDonnee($prenom);
    		$chiDate = chiffrerDonnee($dateNaissance);
            $chiTelephone = chiffrerDonnee($telephone);
            $chiMail = chiffrerDonnee($email);


            $stmtInsertEtudiant->bindParam(':nom', $chiNom);
            $stmtInsertEtudiant->bindParam(':prenom', $chiPrenom);
            $stmtInsertEtudiant->bindParam(':dateNaissance', $chiDate);
            $stmtInsertEtudiant->bindParam(':sectionId', $sectionId);
            $stmtInsertEtudiant->bindParam(':optionId', $optionId);
            $stmtInsertEtudiant->bindParam(':anneeId', $anneeId);
            $stmtInsertEtudiant->bindParam(':telephone', $chiTelephone);
            $stmtInsertEtudiant->bindParam(':email', $chiMail);

            // Exécution de la requête
            if ($stmtInsertEtudiant->execute()) {
                // Redirection vers page_saisi.php avec un message de succès
                //header("Location: pageSaisiEtudiant.php");
                //exit();
                echo "C'est ok !" ;
            	supprimerPost();
            } else {
                // Redirection vers page_saisi.php avec un message d'erreur
                //header("Location: pageSaisiEtudiant.php");
                //exit();
                echo "Opps! " . $stmtInsertEtudiant->errorInfo();
            }
    
        // Fermer la connexion
        $connexion = null;
    }
}else
{
    header('Location: ../index.php');
}
?>
