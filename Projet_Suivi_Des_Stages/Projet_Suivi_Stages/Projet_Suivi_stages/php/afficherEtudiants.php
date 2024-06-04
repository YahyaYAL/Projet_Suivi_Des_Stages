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
  <div>
    <div>
      <label for="section">Filtrer par classe:</label>
      <select id="section" name="section">
        <option value="">Selectionnez une classe</option>
        <?php
        // Générez les options de la liste déroulante
        genererOptions($sqlSection, 'classe', $_SESSION['section']);
        ?>
      </select>
    </div>
    <label for="etudiant">Étudiant :</label>
    <select id="etudiant" name="etudiant" style="width: 200px;">
      <option value="">Tous les étudiants</option>
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
    </select>
  </div>

  <?php
  // Exécution de la requête
  $selectEtudiants = "SELECT user.id, user.nom, user.prenom, user.dateNaissance, classes.classe, anneeScolaire.annee 
  FROM user 
  INNER JOIN classes ON user.classe = classes.id
  INNER JOIN anneeScolaire ON user.anneeScolaire = anneeScolaire.id ";

  $result = $connexion->query($selectEtudiants);
  ?>

  <table>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Date de naissance</th>
      <th>Classe</th>
      <th>Année scolaire</th>
      <th>Action</th>
    </tr>
    <!-- Les résultats de la requête seront affichés ici -->
    <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
      <tr id="<?php echo $row['id']; ?>">
        <td><?php echo dechiffrerDonnee($row['nom']); ?></td>
        <td><?php echo dechiffrerDonnee($row['prenom']); ?></td>
        <td><?php echo dechiffrerDonnee($row['dateNaissance']); ?></td>
        <td><?php echo $row['classe']; ?></td>
        <td><?php echo $row['annee']; ?></td>
        <td>
          <button onclick="afficherPopup(<?php echo $row['id']; ?>)">Modifier</button>
          <button onclick="supprimerEtudiant(<?php echo $row['id']; ?>)">Supprimer</button>
        </td>
      </tr>
    <?php endwhile; ?>

  </table>
</main>
<script>
  // Événement onchange pour la liste déroulante de l'étudiant
  document.getElementById("etudiant").addEventListener("change", filtrerEtudiants);
  // Événement onchange pour la liste déroulante de la classe
  document.getElementById("section").addEventListener("change", filtrerEtudiants);

  // Fonction de filtrage des étudiants
  function filtrerEtudiants() {
    var selectedClasse = document.getElementById("section").value; // Récupérer la classe sélectionnée
    var selectedEtudiant = document.getElementById("etudiant").value; // Récupérer l'étudiant sélectionné

    // Réinitialiser les valeurs des autres listes déroulantes si un étudiant est sélectionné
    if (selectedEtudiant !== "") {
      document.getElementById("section").value = "";
    }

    // Réinitialiser l'affichage du tableau
    var rows = document.querySelectorAll("table tr");
    for (var i = 1; i < rows.length; i++) { // Commencer à partir de l'indice 1 pour ignorer l'en-tête du tableau
      rows[i].style.display = "none"; // Afficher toutes les lignes
    }

    // Parcourir les lignes du tableau et masquer celles qui ne correspondent pas aux critères de classe, d'année scolaire et d'étudiant sélectionnés
    for (var i = 1; i < rows.length; i++) { // Commencer à partir de l'indice 1 pour ignorer l'en-tête du tableau
      var classeCell = rows[i].querySelectorAll("td")[3]; // Récupérer la cellule de classe (4ème colonne)
      var etudiantId = rows[i].getAttribute("id"); // Récupérer l'identifiant de l'étudiant

      if ((selectedClasse !== "" && classeCell.innerHTML !== selectedClasse) ||
    		(selectedEtudiant !== "" && etudiantId !== selectedEtudiant)) {
  			rows[i].style.display = "none"; // Masquer la ligne si elle correspond aux critères de classe, d'année scolaire et d'étudiant sélectionnés
		} else {
  		rows[i].style.display = ""; // Afficher la ligne si elle ne correspond pas aux critères de classe, d'année scolaire et d'étudiant sélectionnés
		}
    }
  }
</script>

<script>
function afficherPopup(idEtudiant) {
  // Récupérer les données de l'étudiant correspondant à l'id
  var nom = document.getElementById(idEtudiant).querySelectorAll('td')[0].innerHTML;
  var prenom = document.getElementById(idEtudiant).querySelectorAll('td')[1].innerHTML;
  var dateNaissance = document.getElementById(idEtudiant).querySelectorAll('td')[2].innerHTML;
  var classe = document.getElementById(idEtudiant).querySelectorAll('td')[3].innerHTML;
  
  // Afficher le popup
  var popup = document.createElement('div');
  popup.id = 'popup';

  var closeButton = document.createElement('span');
  closeButton.innerHTML = '&times;';
  closeButton.className = 'close-button';
  closeButton.onclick = function() {
    document.body.removeChild(popup);
  };

  popup.innerHTML = `
    <h2>Modifier l'étudiant</h2>
    <form action="test.php" method="POST">
      <input type="hidden" name="id" value="${idEtudiant}">
      <input type="hidden" name="section1" value="${classe}">
      <label>Nom:</label>
      <input type="text" name="nom" value="${nom}"><br>
      <label>Prénom:</label>
      <input type="text" name="prenom" value="${prenom}"><br>
      <label>Date de naissance:</label>
      <input type="text" name="dateNaissance" value="${dateNaissance}"><br>
      <label>Classe: ${classe}</label><br><br>
      <select id="section" name="section">
        <?php
        echo "<option value=''>Modifiez la classe</option>";
        genererOptions($sqlSection, "classe");
        ?>
      </select><br><br>
      <input type="hidden" name="action" value="update">

      <button type="submit">Enregistrer</button>
    </form>
  `;
  
  popup.appendChild(closeButton);
  document.body.appendChild(popup);
}


function supprimerEtudiant(idEtudiant) {
  var nom = document.getElementById(idEtudiant).querySelectorAll('td')[0].innerHTML;
  var prenom = document.getElementById(idEtudiant).querySelectorAll('td')[1].innerHTML;
  
  // Demander confirmation avant de supprimer l'étudiant
  var confirmation = confirm(`Êtes-vous sûr de vouloir supprimer ${nom} ${prenom} ?`);
  
  if (confirmation) {
    // Créer un formulaire pour envoyer la demande de suppression
    var form = document.createElement('form');
    form.method = 'post';
    form.action = 'test.php';

    // Ajouter un champ caché pour l'identifiant de l'étudiant
    var inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'id';
    inputId.value = idEtudiant;

    // Ajouter un champ caché pour l'action de suppression
    var inputAction = document.createElement('input');
    inputAction.type = 'hidden';
    inputAction.name = 'action';
    inputAction.value = 'delete';

    // Ajouter les champs au formulaire
    form.appendChild(inputId);
    form.appendChild(inputAction);

    // Ajouter le formulaire à la page et le soumettre
    document.body.appendChild(form);
    form.submit();
  }
}

</script>
<script src="../js/configSelect2.js"></script>
</body>
</html>
