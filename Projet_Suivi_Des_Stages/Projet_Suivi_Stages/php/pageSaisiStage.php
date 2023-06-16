<?php
include('fonctions.php');
verifierSession();

include('requetesSql.php');
?>

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
            <input list="etudiants" id="etudiant" name="etudiant" autocomplete="off" required value="<?php afficherValeurSession('etudiant'); ?>">
            <datalist id="etudiants">
                <?php
                // Récupérer les noms des étudiants
                $resultatEtudiant = executeRequete($sqlEtudiant);

                // Génération des options en utilisant fetch()
                while ($row = $resultatEtudiant->fetch(PDO::FETCH_ASSOC)) {
    				$nom = dechiffrerDonnee($row['nom']);
    				$prenom = dechiffrerDonnee($row['prenom']);
    				$id = $row['id'];

    				echo "<option value='$nom $prenom' data-id='$id'>$nom $prenom</option>";
				}
                ?>
            </datalist>


            <br><br>

            <label for="entreprise">Entreprise :</label>
            <input list="entreprises" id="entreprise" name="entreprise" autocomplete="off" required value="<?php afficherValeurSession('entreprise'); ?>">
            <br><br>
            <datalist id="entreprises">
                <?php
            		genererOptions2($sqlEntreprise, 'nom', $_SESSION['entreprise']);
                ?>
            </datalist>

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
 </body>

</html>