<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Connexion à la base de données
    include('connexion.php');
    include('requetesSql.php');
    include('fonctions.php');

    // Stocker les valeurs du $_POST dans une session
    stockerPostSession();

    $nom = testInput($_POST['nom']);
    $prenom = testInput($_POST['prenom']);
    $dateNaissance = testInput(dateConvert($_POST['dateNaissance']));
    $classe = testInput($_POST['section']);
    $action = $_POST['action'];

    // Vérification du format
    $erreur = '';
    $err = '';

    $err = verifierNom($nom);
    $erreur .= $err;

    $err = verifierNom($prenom);
    $erreur .= $err;

    $err = verifierDate($dateNaissance);
    $erreur .= $err;

    if ($erreur != '') {
        header('Location: pageSaisiEtudiant.php?' . $erreur);
        exit();
    } else {
        // Récupérer l'année scolaire
        $anneeScolaire = date('Y') . '-' . (date('Y') + 1);

        $stmtAnneeScolaire = $connexion->prepare($sqlAnneeId);
        $stmtAnneeScolaire->bindParam(':annee', $anneeScolaire);
        $stmtAnneeScolaire->execute();
        $rowAnneeId = $stmtAnneeScolaire->fetch(PDO::FETCH_ASSOC);

        if ($rowAnneeId) {
            // L'année scolaire existe, récupérer son ID
            $anneeScolaireId = $rowAnneeId['id'];
        } else {
            // L'année scolaire n'existe pas, l'insérer dans la base de données
            $stmtInsertAnneeScolaire = $connexion->prepare($sqlInsertAnnee);
            $stmtInsertAnneeScolaire->bindParam(':annee', $anneeScolaire);
            $stmtInsertAnneeScolaire->execute();

            // Récupérer l'id de l'année scolaire nouvellement insérée
            $anneeScolaireId = $connexion->lastInsertId();
        }

        // Récupérer l'id de la section
        $stmtClasse = $connexion->prepare($sqlClasseId);
        $stmtClasse->bindParam(':classe', $classe);
        $stmtClasse->execute();
        $rowClasse = $stmtClasse->fetch(PDO::FETCH_ASSOC);

        if ($rowClasse) {
            $classeId = $rowClasse['id'];
        } else {
            $stmtInsertClasse = $connexion->prepare($sqlInsertClasse);
            $stmtInsertClasse->bindParam(':classe', $classe);
            $stmtInsertClasse->execute();

            $classeId = $connexion->lastInsertId();
        }

        if ($action === 'insert') {
            // Requête d'insertion des données dans la table etudiants
            $stmtInsertEtudiant = $connexion->prepare($sqlInsertEtudiant);

            $chiNom = chiffrerDonnee($nom);
            $chiPrenom = chiffrerDonnee($prenom);
            $chiDate = chiffrerDonnee($dateNaissance);

            $stmtInsertEtudiant->bindParam(':nom', $chiNom);
            $stmtInsertEtudiant->bindParam(':prenom', $chiPrenom);
            $stmtInsertEtudiant->bindParam(':dateNaissance', $chiDate);
            $stmtInsertEtudiant->bindParam(':classeId', $classeId);
            $stmtInsertEtudiant->bindParam(':anneeId', $anneeScolaireId);

            // Exécution de la requête
            if ($stmtInsertEtudiant->execute()) {
                // Insertion réussie, effectuer les actions nécessaires
                // ...
                echo "C'est ok !";
                supprimerPost();
            } else {
                // Erreur lors de l'insertion, gérer l'erreur
                echo "Opps! " . $stmtInsertEtudiant->errorInfo();
            }
        } elseif ($action === 'update') {
            $id = $_POST['id']; // Récupérer l'ID de l'étudiant à mettre à jour

            $stmtUpdateEtudiant = $connexion->prepare($sqlUpdateEtudiant);

            // Bind les paramètres de la requête
            $stmtUpdateEtudiant->bindParam(':nom', $nom);
            $stmtUpdateEtudiant->bindParam(':prenom', $prenom);
            $stmtUpdateEtudiant->bindParam(':dateNaissance', $dateNaissance);
            $stmtUpdateEtudiant->bindParam(':classeId', $classeId);
            $stmtUpdateEtudiant->bindParam(':id', $id);

            // Exécution de la requête
            if ($stmtUpdateEtudiant->execute()) {
                // Mise à jour réussie, effectuer les actions nécessaires
                // ...
                echo "C'est ok !";
                supprimerPost();
            } else {
                // Erreur lors de la mise à jour, gérer l'erreur
                echo "Opps! " . $stmtUpdateEtudiant->errorInfo();
            }
        } else {
            // Valeur "action" invalide, gérer l'erreur
            echo "Action invalide.";
        }

        // Fermer la connexion
        $connexion = null;
    }
} else {
    header('Location: ../index.php');
}
?>
