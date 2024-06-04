<?php 
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload du fichier CSV</title>
</head>
<body>
    <h1>Upload du fichier CSV</h1>

	<form action="" method="post" enctype="multipart/form-data">
        <label for="csvfile">Sélectionner le fichier CSV à télécharger :</label>
        <input type="file" name="csvfile" id="csvfile">
        <br>
        <input type="submit" name="submit" value="Télécharger">
    </form>

    <?php
        
        $test1 = "Garcia1Léa104/09/2003DNMADE";
        echo $test1 . "<br>";
		echo hash('sha256', $test1) . "<br><br>";

		$test2 = "Garcia1Léa104/09/2003DNMADE";
        echo $test2 . "<br>";
		echo hash('sha256', $test2) . "<br><br>";
        
		

		// Hasher les données concaténées
		$idUniqueHash = hash('sha256', $idUnique);
        
    // Connexion à la base de données
    include('connexion.php');
    include('fonctions.php');
	include('requetesSql.php');

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {
        // Vérifier s'il n'y a pas eu d'erreur lors de l'upload
        if ($_FILES['csvfile']['error'] === UPLOAD_ERR_OK) {
            // Récupérer le nom du fichier temporaire
            $tmp_file = $_FILES['csvfile']['tmp_name'];

        	// Enregistrer le temps de début
			$tempsDebut = microtime(true);
        
            // Ouvrir le fichier CSV en lecture
            $handle = fopen($tmp_file, 'r');

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


        	//$isFirstLine = true;
            $nbLignesFichier = 0;
            $nbEtudiantsInseres = 0;
            $lignesNonInserees = array();

            // Afficher les lignes du fichier CSV dans un tableau
            echo "<h2>Contenu du fichier CSV</h2>";
            echo "<table>";
            echo "<tr><th>Nom</th><th>Prénom</th><th>Date de naissance</th><th>Classe</th></tr>";

            while (!feof($handle)) {
                $data = fgetcsv($handle, 1000, ';');

                if ($data === false || $data === null) {
                    continue;
                }
            
            	if ($nbLignesFichier === 0) {
        			$nbLignesFichier++;
        			continue;
    			}

    			$nbLignesFichier++;

                echo "<tr>";
                echo "<td>" . utf8_encode($data[0]) . "</td>";
                echo "<td>" . utf8_encode($data[1]) . "</td>";
                echo "<td>" . utf8_encode($data[2]) . "</td>";
                echo "<td>" . utf8_encode($data[3]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        
        	

            // Réinitialiser le pointeur de fichier pour relire le fichier
            fseek($handle, 0);
        	$nbLignesFichier = 0;

            // Parcourir les lignes du fichier CSV
            while (!feof($handle)) {
                $data = fgetcsv($handle, 1000, ';');
				
            	
            
                if ($data === false || $data === null) {
                    continue;
                }
            	
            	if ($nbLignesFichier === 0) {
        			$nbLignesFichier++;
        			continue;
    			}

    			$nbLignesFichier++;
            
            	// Concaténer le nom, prénom et date de naissance
				$idUnique = $data[0] . $data[1] . $data[2];

				// Hasher les données concaténées
				$idUniqueHash = hash('sha256', $idUnique);

				// Vérifier si l'étudiant existe déjà dans la table
                $stmtVerifierEtudiant = $connexion->prepare($sqlVerifierEtudiant);
                $stmtVerifierEtudiant->bindParam(':idUnique', $idUniqueHash);
                $stmtVerifierEtudiant->execute();

				if ($stmtVerifierEtudiant->rowCount() > 0) {
    				// L'étudiant existe déjà, passer à la ligne suivante
    				continue;
				}

                $nomChi = chiffrerDonnee(utf8_encode($data[0]));
                $prenomChi = chiffrerDonnee(utf8_encode($data[1]));
                $dateNaissanceChi = chiffrerDonnee($data[2]);
                $classe = $data[3];

            
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
            
            


                $stmtInsertEtudiant = $connexion->prepare($sqlInsertEtudiant);
                $stmtInsertEtudiant->bindParam(':nom', $nomChi);
                $stmtInsertEtudiant->bindParam(':prenom', $prenomChi);
                $stmtInsertEtudiant->bindParam(':dateNaissance', $dateNaissanceChi);
            	$stmtInsertEtudiant->bindParam(':idUnique', $idUniqueHash);
                $stmtInsertEtudiant->bindParam(':classeId', $classeId);
                $stmtInsertEtudiant->bindParam(':anneeId', $anneeScolaireId);
                $stmtInsertEtudiant->execute();

                if ($stmtInsertEtudiant->rowCount() > 0) {
                    $nbEtudiantsInseres++;
                } else {
                    $erreur = $stmtInsertEtudiant->errorInfo();
                    $messageErreur = $erreur[1];

                    $ligneNonInseree = [
                        'nom' => $nomChi,
                        'prenom' => $prenomChi,
                        'dateNaissance' => $dateNaissanceChi,
                        'classe' => $classe,
                        'erreur' => $messageErreur
                    ];

                    $lignesNonInserees[] = $ligneNonInseree;
                }
            }
			// Calculer le temps écoulé en secondes
			$tempsFin = microtime(true);
			$tempsTotal = $tempsFin - $tempsDebut;
        	
            echo "Nombre d'étudiants insérés : " . $nbEtudiantsInseres . "<br>";
            echo "Nombre de lignes du fichier : " . $nbLignesFichier . "<br>";
			echo "Temps écoulé : " . round($tempsTotal, 2) . " secondes";
        
            // Afficher les lignes non insérées avec les messages d'erreur
            if (!empty($lignesNonInserees)) {
                echo "Lignes non insérées : <br>";
                foreach ($lignesNonInserees as $ligne) {
                    echo "Nom : " . $ligne['nom'] . "<br>";
                    echo "Prénom : " . $ligne['prenom'] . "<br>";
                    echo "Date de naissance : " . $ligne['dateNaissance'] . "<br>";
                    echo "Classe : " . $ligne['classe'] . "<br>";
                    echo "Erreur : " . $ligne['erreur'] . "<br><br>";
                }
            }

            // Fermer le fichier CSV
            fclose($handle);
        	
        } elseif ($_FILES['csvfile']['error'] === UPLOAD_ERR_NO_FILE) {
            echo 'Veuillez sélectionner un fichier CSV à télécharger.';
        } else {
            echo 'Une erreur s\'est produite lors de l\'upload du fichier.';
        }
    }
    ?>

</body>
</html>
