<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
include('fonctions.php');
verifierReferer();
verifierSession();

include('requetesSql.php');
?>

<html>
 <head>
 <meta charset="utf-8">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
 <link rel="stylesheet" href="../css/generale.css" media="screen" type="text/css">
 <link rel="stylesheet" href="../css/page_saisi.css" media="screen" type="text/css">
 </head>

<header>
    <!-- bar de navigation -->
    <nav>
        <div>
            <h1>Logo.</h1>
        </div>
        <ul>
			<li><a href="accueil.php">Accueil</a></li>
            <li><a href="pageSaisiEtudiant.php">Saisir un étudiant</a></li>
            <li><a href="pageSaisiEntreprise.php">Saisir une entreprise</a></li>
            <li><a href="pageSaisiStage.php">Saisir un stage</a></li>
        </ul>

        <a class='deconnexion' href='pageSaisiStage.php?deconnexion=true'>Déconnexion</a>


        <?php
        if (isset($_GET['deconnexion'])) {
            if ($_GET['deconnexion'] == true) {
                // fermer la connexion
                $connexion = null;
                // fermer la session
                session_unset();
                header("location: ../index.php");
                exit(); // Arrêter l'exécution du script après la redirection
            }
        }
        ?>
</header>

 <body>
 	<main>

		<div class="container">
        <h2>Stage</h2>

        <form method="post" action="traitementStage.php">

                <label for="etudiant">Étudiant :</label>
    			<select id="etudiant" name="etudiant" style="width: 300px;">
      
      			<?php
      				// Récupérer les données des étudiants
      				$resultatEtudiant = executeRequete($sqlEtudiant);

      				// Génération des options en utilisant fetch()
      				while ($row = $resultatEtudiant->fetch(PDO::FETCH_ASSOC)) {
        				$nom = dechiffrerDonnee($row['nom']);
        				$prenom = dechiffrerDonnee($row['prenom']);
        				$id = $row['id'];

        				echo "<option value='$id'>$nom $prenom</option>";
      				}
      			?>
    			</select><br><br>

    			<label for="entreprise">Entreprise :</label>
    			<select id="entreprise" name="entreprise" style="width: 300px;">
      			<?php
      				// Récupérer les données des entreprises
      				$resultatEntreprise = executeRequete($sqlEntreprise);

      				// Génération des options en utilisant fetch()
      				while ($ENTrow = $resultatEntreprise->fetch(PDO::FETCH_ASSOC)) {
        				$ENTnom = dechiffrerDonnee($ENTrow['nom']);
        				$ENTid = $ENTrow['id'];

        				echo "<option value='$ENTid'>$ENTnom</option>";
      				}
      			?>
    			</select><br><br>

            <label for="dateDebut">Date de début :</label>
            <input type="date" id="dateDebut" name="dateDebut" required value="<?php afficherValeurSession('dateDebut'); ?>">
            <br><br>

            <label for="dateFin">Date de fin :</label>
            <input type="date" id="dateFin" name="dateFin" required value="<?php afficherValeurSession('dateFin'); ?>">
            <br><br>

            <h3>Tuteur</h3><br>
            <label for="nomTuteur">Nom :</label>
            <input type="text" id="nomTuteur" name="nomTuteur" autocomplete="off" required value="<?php afficherValeurSession('nomTuteur'); ?>">
            <span class="error"><?php afficherErr('errNom'); ?></span><br><br>

            <label for="prenomTuteur">Prénom :</label>
            <input type="text" id="prenomTuteur" name="prenomTuteur" autocomplete="off" required value="<?php afficherValeurSession('prenomTuteur'); ?>">
            <span class="error"><?php afficherErr('errNom'); ?></span><br><br>
            
            <label>Civilité :</label>
			<input type="radio" id="monsieur" name="civilite" value="monsieur" required>
			<label for="monsieur">Monsieur</label>
			<input type="radio" id="madame" name="civilite" value="madame" required>
			<label for="madame">Madame</label><br><br>
         
            <label for="fonctionTuteur">Fonction :</label>
            <input type="text" id="fonctionTuteur" name="fonctionTuteur" autocomplete="off" required value="<?php afficherValeurSession('fonctionTuteur'); ?>">
            <br><br>

            <label for="numeroTuteur">Téléphone :</label>
            <input type="text" id="numeroTuteur" name="numeroTuteur" autocomplete="off" required value="<?php afficherValeurSession('numeroTuteur'); ?>">
            <span class="error"><?php afficherErr('errTelephone'); ?></span><br><br>

            <label for="mailTuteur">Mail :</label>
            <input type="email" id="mailTuteur" name="mailTuteur" autocomplete="off" required value="<?php afficherValeurSession('mailTuteur'); ?>">
            <span class="error"><?php afficherErr('errEmail'); ?></span><br><br>
  
            <input type="submit" value="Soumettre">
        </form>
            
       
    </div>

    </main>
    <script src="../js/configSelect2.js"></script>
 </body>

</html>