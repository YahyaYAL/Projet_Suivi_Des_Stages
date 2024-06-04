<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);

// Vérifier s'il y a des POSTs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include('connexion.php');
    include('fonctions.php');
	include('requetesSql.php');

    // Vérifier si l'action est "delete"
    if ($_POST['action'] === 'delete') {
        // Récupérer l'id de l'entreprise à supprimer
        $idEntreprise = $_POST['id'];
    
    	$sqlLogin = "DELETE FROM login WHERE id = :idEntreprise";
		$stmtDeleteLogin = $connexion->prepare($sqlLogin);
    	$stmtDeleteLogin->bindParam(':idEntreprise', $idEntreprise);
    	$stmtDeleteLogin->execute();
    
        // Exécuter la requête de suppression
        $sql = "DELETE FROM entreprises WHERE id = :idEntreprise";
        $stmtDelete = $connexion->prepare($sql);
        $stmtDelete->bindParam(':idEntreprise', $idEntreprise);

        if ($stmtDelete->execute()) {
            // La suppression s'est bien déroulée
            echo "L'entreprise a été supprimée avec succès.";
        } else {
            // Erreur lors de la suppression
            echo "Erreur lors de la suppression de l'entreprise.";
        }
    } else {
        // Récupérer les autres valeurs des posts
        $idEntreprise = $_POST['id'];
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $codePostal = $_POST['codePostal'];
        $telephone = $_POST['telephone'];
        $mail = $_POST['mail'];
        $service = $_POST['service'];
        $siteWeb = $_POST['siteWeb'];

    
        	// Récupérer l'id du service
    	$stmtServiceId = $connexion->prepare($sqlServiceId);
    	$stmtServiceId->bindParam(':service', $service);
    	$stmtServiceId->execute();
    	$rowServiceId = $stmtServiceId->fetch(PDO::FETCH_ASSOC);
    	$serviceId = $rowServiceId['id'];
    
        // Exécuter la requête de mise à jour
        $sql = "UPDATE entreprises 
                	SET nom = :nom, adresse = :adresse, ville = :ville, codePostal = :codePostal,
                	telephone = :telephone, mail = :mail, service = :serviceId, siteWeb = :siteWeb
                	WHERE id = :idEntreprise";
        $stmtUpdate = $connexion->prepare($sql);

        $chiNom = chiffrerDonnee($nom);
        $chiTelephone = chiffrerDonnee($telephone);
        $chiMail = chiffrerDonnee($mail);
        

        $stmtUpdate->bindParam(':nom', $chiNom);
        $stmtUpdate->bindParam(':adresse', $adresse);
        $stmtUpdate->bindParam(':ville', $ville);
        $stmtUpdate->bindParam(':codePostal', $codePostal);
        $stmtUpdate->bindParam(':telephone', $chiTelephone);
        $stmtUpdate->bindParam(':mail', $chiMail);
        $stmtUpdate->bindParam(':serviceId', $serviceId);
        $stmtUpdate->bindParam(':siteWeb', $siteWeb);
        $stmtUpdate->bindParam(':idEntreprise', $idEntreprise);

        if ($stmtUpdate->execute()) {
            // La mise à jour s'est bien déroulée
            echo "Mise à jour effectuée avec succès.";
        } else {
            // Erreur lors de la mise à jour
            echo "Erreur lors de la mise à jour.";
        }
    }
}
?>