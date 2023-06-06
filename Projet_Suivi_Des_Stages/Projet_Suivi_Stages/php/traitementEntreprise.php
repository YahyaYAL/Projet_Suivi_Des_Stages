<?php
$nom = $_POST['nom'];
//$chef = $_POST['chef'];
//$siret = $_POST['siret'];
$adresse = $_POST['adresse'];
$ville = $_POST['ville'];
$codePostal = $_POST['codepostal'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$service = $_POST["service"];
$siteweb = $_POST['siteweb'];


//connexion à la base de données
include('connexion_mysql.php');

$sqlServiceId = " SELECT id 
					FROM services
                    WHERE service = '" . $service . "'";

$resultServiceId = mysqli_query($db, $sqlServiceId);

if ($row = mysqli_fetch_assoc($resultServiceId)) {
    $serviceId = $row['id'];
} else {
    // Traitement en cas de résultat vide ou d'erreur
    $serviceId = null;
}

// Requête d'insertion des données dans la table entreprises
$sqlInsertEntreprise = "INSERT INTO entreprises 
    (nom, adresse, ville, codePostal, telephone, mail, service, siteWeb) 
    VALUES ('$nom', '$adresse', '$ville', '$codePostal', '$telephone', '$email', $serviceId, '$siteweb')";

// Affichage de la requête
echo "Requête exécutée : " . $sqlInsertEntreprise . "<br>";


// Exécution de la requête
if (mysqli_query($db, $sqlInsertEntreprise)) {
	// Redirection vers page_saisi.php avec un message de succès
    //header("Location: page_saisi.php?message=success");
    //exit();
	echo "La requête d'insertion a été exécutée avec succès." . mysqli_error($db);
} else {
	// Redirection vers page_saisi.php avec un message d'erreur
    //header("Location: page_saisi.php?message=error");
    //exit();
	// Erreur lors de l'exécution de la requête
    echo "Opps! : " . mysqli_error($db);
}

?>