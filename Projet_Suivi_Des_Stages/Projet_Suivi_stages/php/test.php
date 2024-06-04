<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);

// Vérifier s'il y a des POSTs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include('connexion.php');
    include('fonctions.php');

    // Vérifier si l'action est "delete"
    if ($_POST['action'] === 'delete') {
        // Récupérer l'id de l'étudiant à supprimer
        $idEtudiant = $_POST['id'];
    
    	$sqlLogin = "DELETE FROM login WHERE id = :idEtudiant";
		$stmtDeleteLogin = $connexion->prepare($sqlLogin);
    	$stmtDeleteLogin->bindParam(':idEtudiant', $idEtudiant);
    	$stmtDeleteLogin->execute();
    
        // Exécuter la requête de suppression
        $sql = "DELETE FROM user WHERE id = :idEtudiant";
        $stmtDelete = $connexion->prepare($sql);
        $stmtDelete->bindParam(':idEtudiant', $idEtudiant);

        if ($stmtDelete->execute()) {
            // La suppression s'est bien déroulée
            echo "L'étudiant a été supprimé avec succès.";
        } else {
            // Erreur lors de la suppression
            echo "Erreur lors de la suppression de l'étudiant.";
        }
    } else {
        // Récupérer les autres valeurs des posts
        $idEtudiant = $_POST['id'];
        $classe1 = $_POST['section1'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['dateNaissance'];
        $classe = $_POST['section'];

        // Vérifier si la valeur du poste section est vide
        if (empty($classe)) {
            $classe = $classe1;
        }

        // Récupérer l'id de la section
        $sqlClasseId = "SELECT id FROM classes WHERE classe = :classe";
        $stmtClasse = $connexion->prepare($sqlClasseId);
        $stmtClasse->bindParam(':classe', $classe);
        $stmtClasse->execute();
        $rowClasse = $stmtClasse->fetch(PDO::FETCH_ASSOC);
        $classeId = $rowClasse['id'];

        // Exécuter la requête de mise à jour
        $sql = "UPDATE user 
                SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, classe = :classeId
                WHERE id = :idEtudiant";
        $stmtUpdate = $connexion->prepare($sql);

        $chiNom = chiffrerDonnee($nom);
        $chiPrenom = chiffrerDonnee($prenom);
        $chiDate = chiffrerDonnee($dateNaissance);

        $stmtUpdate->bindParam(':nom', $chiNom);
        $stmtUpdate->bindParam(':prenom', $chiPrenom);
        $stmtUpdate->bindParam(':dateNaissance', $chiDate);
        $stmtUpdate->bindParam(':classeId', $classeId);
        $stmtUpdate->bindParam(':idEtudiant', $idEtudiant);

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