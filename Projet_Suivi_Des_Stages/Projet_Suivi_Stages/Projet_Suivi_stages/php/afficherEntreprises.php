<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
      <label for="service">Filtrer par service:</label>
      <select id="service" name="service" required>
        <option value="">Sélectionnez un service</option>
        <?php
        genererOptions($sqlService, 'service');
        ?>
      </select>
    </div>
    <div>
      <label for="ville">Filtrer par ville:</label>
      <select id="ville" name="ville" required>
        <option value="">Sélectionnez une ville</option>
        <?php
        genererOptions($sqlVille, 'ville');
        ?>
      </select>
    </div>
    <div>
      <label for="entreprise">Recherche par nom d entreprise:</label>
      <select id="entreprise" name="entreprise" style="width: 300px;">
        <option value="">Toutes les entreprises</option>
        <?php
        $resultatEntreprise = executeRequete($sqlEntreprise);

        while ($row = $resultatEntreprise->fetch(PDO::FETCH_ASSOC)) {
          $nom = dechiffrerDonnee($row['nom']);
          $id = $row['id'];
          echo "<option value='$id'>$nom</option>";
        }
        ?>
      </select>
    </div><br>
	

    <?php
    // Exécution de la requête
    $selectEntreprises = "SELECT entreprises.id, nom, adresse, ville, codePostal, telephone, mail, entreprises.service, siteWeb , activite.service
							FROM entreprises
							INNER JOIN activite
							ON entreprises.service = activite.id";

    $result = $connexion->query($selectEntreprises);
    ?>
	
    <table>
      <tr>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Code Postal</th>
    	<th>Ville</th>
        <th>Téléphone</th>
        <th>Mail</th>
        <th>Service</th>
        <th>Site Web</th>
        <th>Action</th>
      </tr>
      <!-- Les résultats de la requête seront affichés ici -->
      <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
        <tr id="<?php echo $row['id']; ?>">
          <td><?php echo dechiffrerDonnee($row['nom']); ?></td>
          <td><?php echo $row['adresse']; ?></td>
          <td><?php echo $row['codePostal']; ?></td>
      	  <td><?php echo $row['ville']; ?></td>
          <td><?php echo dechiffrerDonnee($row['telephone']); ?></td>
          <td><?php echo dechiffrerDonnee($row['mail']); ?></td>
          <td><?php echo $row['service']; ?></td>
          <td><a href="<?php echo "https:/"."/www.". $row['siteWeb']; ?>" target="_blank">Visiter</a></td>
          <td>
            <button onclick="afficherPopup(<?php echo $row['id']; ?>)">Modifier</button>
      		<button onclick="supprimerEntreprise(<?php echo $row['id']; ?>)">Supprimer</button>
          </td>
        </tr>
      <?php endwhile; ?>

    </table><br><br>
      <button onclick="telechargerEntreprises()">Télécharger les entreprises</button>
      
  </div>
  </main>
      
<script>
function afficherPopup(idEntreprise) {
  // Récupérer les données de l'entreprise correspondante à l'id
  var nom = document.getElementById(idEntreprise).querySelectorAll('td')[0].innerHTML;
  var adresse = document.getElementById(idEntreprise).querySelectorAll('td')[1].innerHTML;
  var codePostal = document.getElementById(idEntreprise).querySelectorAll('td')[2].innerHTML;
  var ville = document.getElementById(idEntreprise).querySelectorAll('td')[3].innerHTML;
  var telephone = document.getElementById(idEntreprise).querySelectorAll('td')[4].innerHTML;
  var mail = document.getElementById(idEntreprise).querySelectorAll('td')[5].innerHTML;
  var service = document.getElementById(idEntreprise).querySelectorAll('td')[6].innerHTML;
  var siteWeb = document.getElementById(idEntreprise).querySelectorAll('td')[7].querySelector('a').getAttribute('href').replace(/^https?:\/\//, '');

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
    <h2>Modifier l'entreprise</h2>
    <form action="testEntreprise.php" method="POST">
      <input type="hidden" name="id" value="${idEntreprise}">
      <label>Nom:</label>
      <input type="text" name="nom" value="${nom}"><br>
      <label>Adresse:</label>
      <input type="text" name="adresse" value="${adresse}"><br>
      <label>Ville:</label>
      <input type="text" name="ville" value="${ville}"><br>
      <label>Code Postal:</label>
      <input type="text" name="codePostal" value="${codePostal}"><br>
      <label>Téléphone:</label>
      <input type="text" name="telephone" value="${telephone}"><br>
      <label>Mail:</label>
      <input type="text" name="mail" value="${mail}"><br>
      <label>Service:</label>
      <input type="text" name="service" value="${service}"><br>
      <label>Site Web:</label>
      <input type="text" name="siteWeb" value="${siteWeb}"><br>

      <input type="hidden" name="action" value="edit">

      <button type="submit">Enregistrer</button>
    </form>
  `;
  
  popup.appendChild(closeButton);
  document.body.appendChild(popup);
}


function supprimerEntreprise(idEntreprise) {
  var nom = document.getElementById(idEntreprise).querySelectorAll('td')[0].innerHTML;
  var adresse = document.getElementById(idEntreprise).querySelectorAll('td')[1].innerHTML;
  var ville = document.getElementById(idEntreprise).querySelectorAll('td')[3].innerHTML;
  
  // Demander confirmation avant de supprimer l'entreprise
  var confirmation = confirm(`Êtes-vous sûr de vouloir supprimer l'entreprise ${nom} située à ${adresse}, ${ville} ?`);
  
  if (confirmation) {
    // Créer un formulaire pour envoyer la demande de suppression
    var form = document.createElement('form');
    form.method = 'post';
    form.action = 'testEntreprise.php';

    // Ajouter un champ caché pour l'identifiant de l'entreprise
    var inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'id';
    inputId.value = idEntreprise;

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
                             
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<script>
  // Événement onchange pour la liste déroulante du service
  document.getElementById("service").addEventListener("change", filtrerEntreprises);
  // Événement onchange pour la liste déroulante de la ville
  document.getElementById("ville").addEventListener("change", filtrerEntreprises);
  // Événement onchange pour la liste déroulante de l'entreprise
  document.getElementById("entreprise").addEventListener("change", filtrerEntreprises);

  // Fonction de filtrage des entreprises
  function filtrerEntreprises() {
    var selectedService = document.getElementById("service").value; // Récupérer le service sélectionné
    var selectedVille = document.getElementById("ville").value; // Récupérer la ville sélectionnée
    var selectedEntreprise = document.getElementById("entreprise").value; // Récupérer l'entreprise sélectionnée

    // Réinitialiser les valeurs des autres listes déroulantes si une entreprise est sélectionnée
    if (selectedEntreprise !== "") {
      document.getElementById("service").value = "";
      document.getElementById("ville").value = "";
    }

    // Réinitialiser l'affichage du tableau
    var rows = document.querySelectorAll("table tr");
    for (var i = 1; i < rows.length; i++) { // Commencer à partir de l'indice 1 pour ignorer l'en-tête du tableau
      rows[i].style.display = "none"; // Afficher toutes les lignes
    }

    // Parcourir les lignes du tableau et masquer celles qui ne correspondent pas aux critères de service, de ville et d'entreprise sélectionnés
    for (var i = 1; i < rows.length; i++) { // Commencer à partir de l'indice 1 pour ignorer l'en-tête du tableau
      var serviceCell = rows[i].querySelectorAll("td")[6]; // Récupérer la cellule de service (7ème colonne)
      var villeCell = rows[i].querySelectorAll("td")[3]; // Récupérer la cellule de ville (3ème colonne)
      var entrepriseId = rows[i].getAttribute("id"); // Récupérer l'identifiant de l'entreprise

      if ((selectedService !== "" && serviceCell.innerHTML !== selectedService) ||
          (selectedVille !== "" && villeCell.innerHTML !== selectedVille) ||
          (selectedEntreprise !== "" && entrepriseId !== selectedEntreprise)) {
      	rows[i].remove();
        //rows[i].style.display = "none"; // Masquer la ligne si elle ne correspond pas aux critères de service, de ville et d'entreprise sélectionnés
      } else {
        rows[i].style.display = ""; // Afficher la ligne si elle correspond aux critères de service, de ville et d'entreprise sélectionnés
      }
    }
  }
                             

function telechargerEntreprises() {
  // Créer un tableau pour stocker les données des entreprises
  var entreprises = [];

  // Récupérer les lignes du tableau d'entreprises affichées
  var rows = document.querySelectorAll("table tr");

  // Parcourir les lignes du tableau et ajouter les données des entreprises au tableau
  for (var i = 1; i < rows.length; i++) {
    var entreprise = {};
    entreprise.nom = rows[i].querySelectorAll("td")[0].innerHTML;
    entreprise.adresse = rows[i].querySelectorAll("td")[1].innerHTML;
    entreprise.codePostal = rows[i].querySelectorAll("td")[2].innerHTML;
    entreprise.ville = rows[i].querySelectorAll("td")[3].innerHTML;
    entreprise.telephone = rows[i].querySelectorAll("td")[4].innerHTML;
    entreprise.mail = rows[i].querySelectorAll("td")[5].innerHTML;
    entreprise.service = rows[i].querySelectorAll("td")[6].innerHTML;
    entreprise.siteWeb = rows[i].querySelectorAll("td")[7].querySelector("a").getAttribute("href").replace(/^https?:\/\//, "");
    
    entreprises.push(entreprise);
  }
  // Appeler une fonction pour exporter les données des entreprises vers un fichier XLSX
  exporterXLSX(entreprises);
}

function exporterXLSX(entreprises) {
  // Créer une feuille de calcul
  var worksheet = XLSX.utils.json_to_sheet(entreprises);

  // Créer un classeur
  var workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, "Entreprises");

  // Générer les données binaires du fichier XLSX
  var excelData = XLSX.write(workbook, { bookType: "xlsx", type: "array" });

  // Convertir les données binaires en un objet Blob
  var blob = new Blob([excelData], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });

  // Créer un lien de téléchargement
  var link = document.createElement("a");
  link.href = window.URL.createObjectURL(blob);
  link.download = "entreprises.xlsx";

  // Ajouter le lien à la page et cliquer dessus pour déclencher le téléchargement
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
                                                                          
</script>
<script src="../js/configSelect2.js"></script>
</body>
</html>
