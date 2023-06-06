<?php
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$dateNaissance = $_POST['dateNaissance'];
$section = $_POST['section'];
$option = $_POST['option'];
$annee = $_POST['annee'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];

//connexion à la base de données
include('connexion_mysql.php');

// Vérifier l'existence de la section
$sqlSection = "SELECT id FROM classes WHERE classe = '" . $section."'";
$resultatSection = mysqli_query($db, $sqlSection);
if (mysqli_num_rows($resultatSection) != 0) {
    $rowSection = mysqli_fetch_assoc($resultatSection);
    $sectionId = $rowSection['id'];
} else {
	echo  mysqli_error($db) ;
}

// Vérifier l'existence de l'option
$sqlOption = "SELECT id FROM options WHERE options.option = '". $option ."'";
$resultatOption = mysqli_query($db, $sqlOption);
if (mysqli_num_rows($resultatOption) != 0) {
    $rowOption = mysqli_fetch_assoc($resultatOption);
    $optionId = $rowOption['id'];
} else {
    
	echo  mysqli_error($db) ;
}


$sqlAnnee = "SELECT id FROM annees WHERE annee = '" . $annee . "'";
$resultatAnnee = mysqli_query($db, $sqlAnnee);
if (mysqli_num_rows($resultatAnnee) != 0) {
    $rowAnnee = mysqli_fetch_assoc($resultatAnnee);
    $anneeId = $rowAnnee['id'];
} else {
    
	echo  mysqli_error($db) ;
}

// Requête d'insertion des données dans la table etudiants
$sqlInsertEtudiant = "INSERT INTO etudiants 
    (nom, prenom, dateNaissance, classe, _option, annee, telephone, mail) 
    VALUES ('$nom', '$prenom', '$dateNaissance', '$sectionId', '$optionId', '$anneeId', '$telephone', '$email')";

// Exécution de la requête
if (mysqli_query($db, $sqlInsertEtudiant)) {
	// Redirection vers page_saisi.php avec un message de succès
    //header("Location: page_saisi.php?message=success");
    //exit();
	echo "C'est ok! " . mysqli_error($db) ;
} else {
	// Redirection vers page_saisi.php avec un message d'erreur
    //header("Location: page_saisi.php?message=error");
    //exit();
	echo $sqlAnnee;
	echo "Opps! " . mysqli_error($db) ;
}

?>