<?php

// Paramètres de la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "Kirikou202209!";
$nom_base = "Suivi_Des_Stages";

// Connexion à la base de données
try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$nom_base", $utilisateur, $motdepasse);
    // Configuration des options de PDO pour générer des exceptions en cas d'erreurs
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// echo "Connexion réussi...";

} catch(PDOException $e) {
    echo "La connexion a échoué : " . $e->getMessage();
}

?>
