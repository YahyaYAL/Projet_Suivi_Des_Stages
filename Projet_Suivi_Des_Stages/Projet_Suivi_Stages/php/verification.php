<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    // include('connexion_mysql.php');
$db_username = 'root';
$db_password = 'Kirikou202209!';
$db_name = 'Suivi_Des_Stages';
$db_host = 'localhost';
$db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
or die('could not connect to database');
    
// on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
// pour éliminer toute attaque de type injection SQL et XSS
$username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
$password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) 
                        FROM login 
                        where identifiant = '".$username."' and mdp = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];

        // si nom d'utilisateur et mot de passe correctes
        if($count!=0) 
        {
            $_SESSION['username'] = $username;
            header('Location: page_saisi.php');
        }
        else
        {
            // utilisateur ou mot de passe incorrect
            header('Location: ../index.php?erreur=1'); 
        }
        }
        else
        {   
            // utilisateur ou mot de passe vide
            header('Location: ../index.php?erreur=2'); 
        }
}
else
{
    header('Location: ../index.php');
}
// fermer la connexion
mysqli_close($db); 
?>