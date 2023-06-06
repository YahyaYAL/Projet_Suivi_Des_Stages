<html>
 <head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="../css/generale.css" media="screen" type="text/css">
 <link rel="stylesheet" href="../css/page_saisi.css" media="screen" type="text/css">
 </head>

<header>
    <!-- bar de navigation -->
    <nav>
        <div>
            <h1>Logo.</h1>
        </div>
		<a class='deconnexion' href='page_saisi.php?deconnexion=true'>Déconnexion</a>
 
 		<!-- tester si l utilisateur est connecté -->
		<?php
 			session_start();
 			if(isset($_GET['deconnexion']))
 			{ 
 				if($_GET['deconnexion']==true)
 				{ 
                	// fermer la connexion
					mysqli_close($db); 
                
 					session_unset();
 					header("location: ../index.php");
 				}
            }
		?>
    </nav>
</header>

 <body>
 	<main>

        <div class="container">
        
        	<h2>Étudiant</h2>
    		<form method="post" action="traitementEtudiant.php">
        
        		<label for="nom">Nom :</label>
        		<input type="text" id="nom" name="nom" required><br><br>

        		<label for="prenom">Prénom :</label>
        		<input type="text" id="prenom" name="prenom" required><br><br>
                
                <label for="dateNaissance">Date de naissance:</label>
        		<input type="date" id="dateNaissance" name="dateNaissance" required><br><br>

        		<label for="section">Section :</label>
                <select id="section" name="section" required>
        		<?php
    				// Connexion à la base de données
    				include('connexion_mysql.php');
    
    				// Requête SQL pour récupérer les sections
    				$sqlSections = "SELECT classe FROM classes";
    				$sectionResultat = mysqli_query($db, $sqlSections);

    				// Génération des options en utilisant mysqli_fetch_assoc()
    				while ($row = mysqli_fetch_assoc($sectionResultat)) {
        				$section = $row['classe'];
        				echo "<option value='$section'>$section</option>";
    				}
					// Fermer la connexion
					mysqli_close($db);
   				 ?>
				</select><br><br>

        		<label for="option">Option :</label>
        		<select id="option" name="option" required>
        		<?php
    				// Connexion à la base de données
    				include('connexion_mysql.php');
    
    				// Requête SQL pour récupérer les options
    				$sqlOption = "SELECT options.option 
									FROM avoir 
    
    								INNER JOIN options
    								ON avoir._option = options.id
    
    								INNER JOIN classes
    								ON avoir.classse = classes.id
    
    								WHERE classes.classe = '" . $selectedSection . "'";


					$sqlOption2 = "SELECT option FROM options" ;

    				$optionResultat = mysqli_query($db, $sqlOption2);

    				// Génération des options en utilisant mysqli_fetch_assoc()
    				while ($row = mysqli_fetch_assoc($optionResultat)) {
        				$option = $row['option'];
        				echo "<option value='$option'>$option</option>";
    				}
					// Fermer la connexion
					mysqli_close($db);
   				 ?>
				</select><br><br>

        		<label for="annee">Année :</label>
        		<select id="annee" name="annee" required>
        		<?php
    				// Connexion à la base de données
    				include('connexion_mysql.php');
    
    				// Requête SQL pour récupérer les années
    				$sqlAnnee = "SELECT annee FROM annees";
    				$anneeResultat = mysqli_query($db, $sqlAnnee);

    				// Génération des options en utilisant mysqli_fetch_assoc()
    				while ($row = mysqli_fetch_assoc($anneeResultat)) {
        				$annee = $row['annee'];
        				echo "<option value='$annee'>$annee</option>";
    				}
					// Fermer la connexion
					mysqli_close($db);
   				 ?>
                 </select><br><br>

        		<label for="telephone">Téléphone :</label>
        		<input type="tel" id="telephone" name="telephone" required><br><br>

        		<label for="email">Email :</label>
        		<input type="email" id="email" name="email" required><br><br>

        		<input type="submit" value="Soumettre">
    		</form>
            
        </div>

		<div class="container">
        	<h2>Entreprise</h2>
                
    		<form method="post" action="traitementEntreprise.php">
                
        		<label for="nom">Nom :</label>
        		<input type="text" id="nom" name="nom" required><br><br>

        		<label for="adresse">Adresse :</label>
        		<input type="text" id="adresse" name="adresse" required><br><br>

        		<label for="ville">Ville :</label>
        		<input type="text" id="ville" name="ville" required><br><br>

        		<label for="codepostal">Code postal :</label>
        		<input type="text" id="codepostal" name="codepostal" required><br><br>

        		<label for="telephone">Téléphone :</label>
        		<input type="tel" id="telephone" name="telephone" required><br><br>

        		<label for="email">Email :</label>
        		<input type="email" id="email" name="email" required><br><br>
                
                <label for="service">Service :</label>
				<select id="service" name="service" required>
                <?php
    				// Connexion à la base de données
    				include('connexion_mysql.php');
    
    				// Requête SQL pour récupérer les services
    				$sqlService = "SELECT service FROM services";
    				$resultat = mysqli_query($db, $sqlService);

    				// Génération des options en utilisant mysqli_fetch_assoc()
    				while ($row = mysqli_fetch_assoc($resultat)) {
        				$service = $row['service'];
        				echo "<option value='$service'>$service</option>";
    				}
					// Fermer la connexion
					mysqli_close($db);
   				 ?>
				</select><br><br>		

        		<label for="siteweb">Site web :</label>
        		<input type="text" id="siteweb" name="siteweb" ><br><br>

        		<input type="submit" value="Soumettre">
                
    		</form>
        </div>

		<div class="container">
        	<h2>Stage</h2>
                
    		<form method="post" action="traitement_formulaire_stage.php">
                
                <label for="etudiant">Étudiant :</label>
        		<input type="text" id="etudiant" name="etudiant" required><br><br>
                
                <label for="entreprise">Entreprise :</label>
        		<input type="text" id="entreprise" name="entreprise" required><br><br>
                
        		<label for="datedebut">Date de début :</label>
        		<input type="date" id="datedebut" name="datedebut" required><br><br>

        		<label for="datefin">Date de fin :</label>
        		<input type="date" id="datefin" name="datefin" required><br><br>

        		<label for="nomtuteur">Nom de tuteur :</label>
        		<input type="text" id="nomtuteur" name="nomtuteur" required><br><br>

        		<label for="numerotuteur">Numéro de tuteur :</label>
        		<input type="text" id="numerotuteur" name="numerotuteur" required><br><br>

        		<label for="mailtuteur">Mail de tuteur :</label>
        		<input type="email" id="mailtuteur" name="mailtuteur" required><br><br>

        		<input type="submit" value="Soumettre">
    		</form>
        </div>

    </main>
 </body>

</html>