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

        <a class='deconnexion' href='pageSaisiEntreprise.php?deconnexion=true'>Déconnexion</a>


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
    </nav>
</header>

 <body>
 	<main>

		<div class="container">
            <h2>Entreprise</h2>

            <form method="post" action="traitementEntreprise.php">

                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required value="<?php afficherValeurSession('nom'); ?>">
                <span class="error"><?php afficherErr('errNom'); ?></span><br><br>

                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required value="<?php afficherValeurSession('adresse'); ?>">
                <br><br>

                <label for="codepostal">Code postal :</label>
                <input type="text" id="codepostal" name="codepostal" required value="<?php afficherValeurSession('codepostal'); ?>">
                <br><br>

                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required value="<?php afficherValeurSession('ville'); ?>">
                <br><br>

                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" required value="<?php afficherValeurSession('telephone'); ?>">
                <span class="error"><?php afficherErr('errTelephone'); ?><br><br>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required value="<?php afficherValeurSession('email'); ?>">
                <span class="error"><?php afficherErr('errEmail'); ?><br><br>

                <label for="service">Service :</label>
                <select id="service" name="service" required>
                    <?php
						genererOptions($sqlService, 'service', $_SESSION['service']);
                    ?>
                </select><br><br>

                <label for="siteweb">Site web :</label>
                <input type="text" id="siteweb" name="siteweb" value="<?php afficherValeurSession('siteweb'); ?>">
                <br><br>

                <input type="submit" value="Soumettre">

            </form>
    	</div>
                
    </main>
 </body>

</html>