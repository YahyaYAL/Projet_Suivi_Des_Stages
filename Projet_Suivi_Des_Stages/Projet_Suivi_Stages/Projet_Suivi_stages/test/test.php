<?php
include('../php/fonctions.php');
include('../php/requetesSql.php');
?>
<!DOCTYPE html>
<html>
<head>
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body>

  <h2>Liste déroulante avec deux colonnes</h2>

  <form method="post" action="traitement.php">
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
    </select>

    <br><br>

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

    <input type="submit" value="Soumettre">
  </form>

  <script>
    $(document).ready(function() {
      $('#etudiant').select2({
      templateResult: formatResult,
  	  placeholder: "Sélectionnez un étudiant",
  	  minimumInputLength: 1,
      allowClear: true,
  	  language: {
      	noResults: function() {
      	return "Aucun résultat trouvé";
    },
    inputTooShort: function(args) {
        var remainingChars = args.minimum - args.input.length;
        return "Veuillez saisir au moins " + remainingChars + " caractère";
      }
  }
});


      $('#entreprise').select2({
        placeholder: "Sélectionnez une entreprise",
      	minimumInputLength: 1,
      	allowClear: true,
      	language: {
      		noResults: function() {
      			return "Aucun résultat trouvé";
    		},
    		inputTooShort: function(args) {
        		var remainingChars = args.minimum - args.input.length;
        		return "Veuillez saisir au moins " + remainingChars + " caractère";
      		}	
  		}
      });

      function formatResult(option) {
        if (!option.id) {
          return option.text;
        }

        var data = option.text.split(' ');
        var nom = data.slice(0, -1).join(' ');
        var prenom = data[data.length - 1];

        var result = $('<span>' + nom + ' <span style="color: gray;">(' + prenom + ')</span></span>');

        return result;
      }
    });
  </script>

</body>
</html>
