<?php

if(isset($_POST['username']) && isset($_POST['password']))
{
    
    include('connexion.php');
	include('requetesSql.php');
    
    // Éviter les attaques par injection SQL
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    if($username !== "" && $password !== "")
    {
        
        $stmt = $connexion->prepare($requete);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $reponse = $stmt->fetch();
        $count = $reponse['count'];

        // Si nom d'utilisateur et mot de passe corrects
        if($count != 0) 
        {
            session_start();

		    $_SESSION['start'] = time(); 
			$_SESSION['username'] = $username;

			header('Location: accueil.php');
			exit();
        }
        else
        {
            // Utilisateur ou mot de passe incorrect
            header('Location: ../index.php?erreur=1'); 
        }
    }
}
else
{
    header('Location: ../index.php');
}
// Fermer la connexion
$connexion = null;
?>
