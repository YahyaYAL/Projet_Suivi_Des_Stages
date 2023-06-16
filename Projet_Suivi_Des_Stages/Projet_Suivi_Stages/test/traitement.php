<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Vérifier si l'option 'etudiant' a été soumise
  if (isset($_POST['etudiant'])) {
    $etudiant = $_POST['etudiant'];

    // Afficher l'option sélectionnée
    echo "L'option sélectionnée est : " . $etudiant;
  } else {
    // Aucune option sélectionnée
    echo "Aucune option sélectionnée";
  }
}
?>
