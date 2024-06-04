<?php
function deconnecter() {
	include('connexion.php');
	session_start();
    // Fermer la connexion et détruire la session
    $connexion = null;
    session_destroy();
    header("location: ../index.php");
    exit();
}

// Appel de la fonction
deconnecter();
?>