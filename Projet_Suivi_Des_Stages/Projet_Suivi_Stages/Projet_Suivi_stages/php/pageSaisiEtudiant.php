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
    <input type="text" id="nom" name="nom" autocomplete="off" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ -]+" value="<?php afficherValeurSession('nom'); ?>">
    <span class="error"><?php afficherErr('errNom'); ?></span><br><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" autocomplete="off" required pattern="[A-Za-zÀ-ÖØ-öø-ÿ -]+" value="<?php afficherValeurSession('prenom'); ?>">
    <span class="error"><?php afficherErr('errNom'); ?></span><br><br>

    <label for="dateNaissance">Date de naissance:</label>
    <input type="date" id="dateNaissance" name="dateNaissance" autocomplete="off" required value="<?php afficherValeurSession('dateNaissance'); ?>">
    <span class="error"><?php afficherErr('errDate'); ?></span><br><br>

    <label for="section">Section :</label>
    <select id="section" name="section" required>
        <?php
        genererOptions($sqlSection, 'classe', $_SESSION['section']);
        ?>
    </select><br><br>
        
    <label for="anneeScolaire">Année scolaire :</label>
    <?php
    $anneeScolaire = date('Y') . '-' . (date('Y') + 1);
    ?>
    <input type="text" id="anneeScolaire" name="anneeScolaire" value="<?php echo $anneeScolaire; ?>" readonly><br><br>
        
    <input type="submit" value="Soumettre">
</form>



    </div>

    </main>
 </body>

</html>