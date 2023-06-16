<?php 
	// Requête de verification de connexion
	$requete = "SELECT count(*) AS count 
        			FROM login 
                    WHERE identifiant = :username AND mdp = :password";
	

	// Requête pour récupérer les classes
	$sqlSection = "SELECT classe FROM classes";

	// Requête pour récupérer les options des classes
    $sqlOption = "SELECT option FROM options"; 

	// Requête pour récupérer les années
    $sqlAnnee = "SELECT annee FROM annees";

	// Requête pour récupérer les services des entreprises
    $sqlService = "SELECT service FROM activite";

	// Requête pour récupérer le nom et prénom des étudiants
    $sqlEtudiant = "SELECT etudiants.id, etudiants.nom, etudiants.prenom 
    					FROM etudiants";

	// Requête pour récupérer les noms des entreprises
    $sqlEntreprise = "SELECT entreprises.nom, entreprises.id FROM entreprises";




	// Requêtes préparées

	// Récupérer l'id de la section
    $sqlSectionId = "SELECT id FROM classes WHERE classe = :section";

	// Récupérer l'id de l'option
    $sqlOptionId = "SELECT id FROM options WHERE option = :option";

	// Récupérer l'id de l'année
    $sqlAnneeId = "SELECT id FROM annees WHERE annee = :annee";
	
	// Récupérer l'id du service
    $sqlServiceId = "SELECT id FROM activite WHERE service = :service";

	// Récupérer l'ID de l'entreprise
    $sqlEntrepriseId = "SELECT id FROM entreprises WHERE nom = :entreprise";
	
	// Récupérer l'ID de l'étudiant
    $sqlEtudiantId = "SELECT id FROM etudiants WHERE CONCAT(nom, ' ', prenom) = :etudiant";

	


	// Requêtes d'insértion préparées 

	// Requête pour insérer un étudiant
    $sqlInsertEtudiant = "INSERT INTO etudiants 
        (nom, prenom, dateNaissance, classe, _option, annee, telephone, mail) 
        VALUES (:nom, :prenom, :dateNaissance, :sectionId, :optionId, :anneeId, :telephone, :email)";

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


?>