<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
include('fonctions.php');
//verifierReferer();
//verifierSession();

include('requetesSql.php');
include('connexion.php');
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
    <?php
    if (isset($_GET['page']) && $_GET['page'] === 'etudiants') {
      include('afficherEtudiants.php');
    }
    ?>
	
    <button onclick="afficherEtudiants()">Étudiants</button>

    <script>
      function afficherEtudiants() {
        var mainElement = document.querySelector("main");
        mainElement.innerHTML = ""; // Effacer le contenu actuel de la balise <main>

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            mainElement.innerHTML = xhr.responseText;
          }
        };
        xhr.open("GET", "afficherEtudiants.php", true);
        xhr.send();
      }
    </script>
  </main>
</body>
</html>