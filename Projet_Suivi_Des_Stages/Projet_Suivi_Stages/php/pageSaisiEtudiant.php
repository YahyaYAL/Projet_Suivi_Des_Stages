<?php
include('fonctions.php');
verifierSession();
//verifierReferer('php/.php', 'pageSaisiEtudiant.php');

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

        <a class='deconnexion' href='pageSaisiEtudiant.php?deconnexion=true'>Déconnexion</a>


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

        <h2>Étudiant</h2>
        <form method="post" action="traitementEtudiant.php" autocomplete="off">

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" autocomplete="off" required value="<?php afficherValeurSession('nom'); ?>">
            <span class="error"><?php afficherErr('errNom'); ?></span><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" autocomplete="off" required value="<?php afficherValeurSession('prenom'); ?>">
            <span class="error"><?php afficherErr('errNom'); ?></span><br><br>

            <label for="dateNaissance">Date de naissance:</label>
            <input type="date" id="dateNaissance" name="dateNaissance" autocomplete="off" required value="<?php afficherValeurSession('dateNaissance'); ?>">
            <span class="error"><?php afficherErr('errDate'); ?></span><br><br>

            <label for="section">Section :</label>
            <select id="section" name="section" required >
                 <?php
    				genererOptions($sqlSection, 'classe', $_SESSION['section']);
    			 ?>
            </select><br><br>

            <label for="option">Option :</label>
            <select id="option" name="option" required>
                <?php genererOptions($sqlOption, 'option', $_SESSION['option']); ?>
            </select><br><br>

            <label for="annee">Année :</label>
            <select id="annee" name="annee" required>
    			<?php genererOptions($sqlAnnee, 'annee', $_SESSION['annee']); ?>
            </select><br><br>

            <label for="telephone">Téléphone :</label>
            <input type="tel" id="telephone" name="telephone" autocomplete="off" required value="<?php afficherValeurSession('telephone'); ?>">
            <span class="error"><?php afficherErr('errTelephone'); ?></span><br><br>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" autocomplete="off" required value="<?php afficherValeurSession('email'); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
            <span class="error"><?php afficherErr('errEmail'); ?></span><br><br>

            <input type="submit" value="Soumettre">
        </form>

    </div>

    </main>
 </body>

</html>