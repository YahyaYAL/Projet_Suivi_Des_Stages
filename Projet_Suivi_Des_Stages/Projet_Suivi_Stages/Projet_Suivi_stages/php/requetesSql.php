<?php 
	$sqlTest = "INSERT INTO test (nom, sexe, age, taille, poids) VALUES (:nom, :sexe, :age, :taille, :poids)";



	// Requête de verification de connexion
	$requete = "SELECT count(*) AS count 
        			FROM login 
                    WHERE identifiant = :username AND mdp = :password";
	

	// Requête pour récupérer les classes
	$sqlSection = "SELECT classe FROM classes";

	// Requête pour récupérer les options des classes
    $sqlOption = "SELECT option FROM options"; 

	// Requête pour récupérer les années
    $sqlAnnee = "SELECT annee FROM anneeScolaire";

	$sqlVille = "SELECT ville FROM entreprises";

	// Requête pour récupérer les services des entreprises
    $sqlService = "SELECT service FROM activite";

	// Requête pour récupérer le nom et prénom des étudiants
    $sqlEtudiant = "SELECT user.id, user.nom, user.prenom, user.dateNaissance
    					FROM user";

	$sqlVerifierEtudiant = "SELECT user.idUnique
    							FROM user
                                WHERE user.idUnique LIKE :idUnique";

	// Requête pour récupérer les noms des entreprises
    $sqlEntreprise = "SELECT entreprises.nom, entreprises.id FROM entreprises";




	// Requêtes préparées

	// Récupérer l'id de la section
    $sqlClasseId = "SELECT id FROM classes WHERE classe = :classe";

	// Récupérer l'id de l'option
    $sqlOptionId = "SELECT id FROM options WHERE option = :option";

	// Récupérer l'id de l'année
    $sqlAnneeId = "SELECT id FROM anneeScolaire WHERE annee = :annee";
	
	// Récupérer l'id du service
    $sqlServiceId = "SELECT id FROM activite WHERE service = :service";

	// Récupérer l'ID de l'entreprise
    $sqlEntrepriseId = "SELECT id FROM entreprises WHERE nom = :entreprise";
	
	// Récupérer l'ID de l'étudiant
    $sqlEtudiantId = "SELECT id FROM user WHERE CONCAT(nom, ' ', prenom) = :etudiant";

	


	// Requêtes d'insértion préparées 

	// Requête pour insérer un étudiant
    $sqlInsertEtudiant = "INSERT INTO user 
        (nom, prenom, dateNaissance, idUnique, classe, anneeScolaire) 
        VALUES (:nom, :prenom, :dateNaissance, :idUnique, :classeId, :anneeId)";

	$sqlInsertClasse = "INSERT INTO classes (classe) VALUES (:classe)";

	$sqlInsertAnnee = "INSERT INTO anneeScolaire (annee) VALUES (:annee)";

	// Requête pour insérer une entreprise
    $sqlInsertEntreprise = "INSERT INTO entreprises 
        (nom, adresse, ville, codePostal, telephone, mail, service, siteWeb) 
        VALUES (:nom, :adresse, :ville, :codePostal, :telephone, :email, :serviceId, :siteweb)";
	
	// Requête pour insérer un tuteur
    $sqlInsertTuteur = "INSERT INTO tuteurs 
		(nom, prenom, civilite, fonction, telephone, mail) 
        VALUES (:nomTuteur, :prenomTuteur, :civilite, :fonctionTuteur, :numeroTuteur, :mailTuteur)";
	
	// Requête pour insérer un stage
    $sqlInsertStage = "INSERT INTO stages 
    	(etudiant, entreprise, tuteur, dateDebut, dateFin) 
        VALUES (:etudiantId, :entrepriseId, :tuteurId, :dateDebut, :dateFin)";





	$sqlUpdateEtudiant = "UPDATE user 
    	SET nom = :nom, prenom = :prenom, dateNaissance = :dateNaissance, classe = :classeId
        WHERE id = :id";

?>