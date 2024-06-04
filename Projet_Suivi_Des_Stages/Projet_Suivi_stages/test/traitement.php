<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Vérifier si l'option 'etudiant' a été soumise
 
    echo $_POST['etudiant'] . "<br>";
	echo $_POST['entreprise'] . "<br>";

}
 
?>
