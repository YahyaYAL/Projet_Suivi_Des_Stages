<?php

// Paramètres de la base de données
$serveur = "localhost";
$utilisateur = "adminStage";
$motDePasse = "Kirikou202209!";
$nomBdd = "Suivi_Des_Stages";

// Connexion à la base de données
try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nomBdd", $utilisateur, $motDePasse);
    
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 //echo "Connexion ok...";

} catch(PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}

?>
