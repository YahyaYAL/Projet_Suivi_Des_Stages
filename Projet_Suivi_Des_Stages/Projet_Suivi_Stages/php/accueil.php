<?php
include('fonctions.php');
//verifierReferer('accueil.php');
verifierSession();
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

        <a class='deconnexion' href='accueil.php?deconnexion=true'>Déconnexion</a>


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
        
    
</main>
</body>
</html>