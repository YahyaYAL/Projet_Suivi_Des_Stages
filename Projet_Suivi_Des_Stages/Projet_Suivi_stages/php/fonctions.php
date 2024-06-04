<?php 

function resetStart() {
	session_start();
	$_SESSION['start'] = time();
}

function verifierSession() {
    session_start();
    // Vérifier si l'utilisateur de la session existe et n'est pas vide
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        // Vérifier si le temps de connexion n'a pas dépassé 30 minutes
        if (isset($_SESSION['start']) && time() - $_SESSION['start'] < (30 * 60)) {
            // L'utilisateur est valide et connecté depuis moins de 30 minutes
            echo "Utilisateur valide et connecté.";
            echo $_SESSION['start'];
        } else {
            // Le temps de connexion a dépassé 30 minutes, afficher le formulaire de choix
            $timerSeconds = 30; // Durée du timer en secondes

            echo <<<HTML
            <div style="background-color: #f8f8f8; border: 1px solid #ccc; padding: 10px; text-align: center;">
                <p>Votre session a expiré. Voulez-vous rester connecté ?</p>
                <p>Temps restant : <span id="timer">$timerSeconds</span> secondes</p>
                <form method="post">
                    <input type="hidden" name="stay_connected" value="1">
                    <button type="submit">Rester connecté</button>
                </form>
            </div>
HTML;

            // Vérifier si l'utilisateur a soumis le formulaire
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['stay_connected'])) {
                    // Supprimer le choix du poste
                    unset($_POST['stay_connected']);
                    // réinitialiser la variable de session 'start'
                    resetStart();
                }
            }else{
				
            // Ajouter un timer pour la déconnexion automatique
            echo <<<HTML
            <script>
                var timer = $timerSeconds;
                var timerElement = document.getElementById("timer");
                var countdown = setInterval(function() {
                    timer--;
                    timerElement.innerText = timer;

                    if (timer <= 0) {
                        clearInterval(countdown);
                        window.location.href = 'logout.php'; // Déconnecter l'utilisateur
                    }
                }, 1000);
            </script>
HTML;       }
        }
    } else {
        // L'utilisateur de la session n'existe pas ou est vide
        echo "Utilisateur non valide ou non connecté.";
        header('Location: ../index.php');
        exit();
    }
}



function dateConvert($data) {
    $data = date('d/m/Y', strtotime($data));
    return $data;
}



/*
function verifierReferer($pageReferer, $pageActuelle) {

	$pagesRefererAutorisees = array("page1.php", "page2.php");
	// Vérifier si le referer est présent et correspond à la page précise
	$url = 'http://' . $_SERVER['HTTP_HOST'] . '/Projet_Suivi_Stages/' . $pageReferer;

	if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] === $url) {
    
    	header('$pageActuelle');
   
	} else {
    	// Rediriger vers une autre page en cas d'accès direct ou referer non valide
    	header('Location: ../index.php');
    	exit();
	}
}
*/

function verifierReferer() {
    // tableau de pages
    $pagesRefererAutorisees = array("index.php", 
                                    "php/accueil.php", 
                                    "php/pageSaisiEtudiant.php", 
                                    "php/pageSaisiEntreprise.php", 
                                    "php/pageSaisiStage.php");
    // Vérifier si le referer est présent
    if (isset($_SERVER['HTTP_REFERER'])) {
        $referer = $_SERVER['HTTP_REFERER'];
        // Vérifier si le referer correspond à l'une des pages autorisées
        $i = 0;
    	$bool = false;
        while (($i < count($pagesRefererAutorisees))&&($bool != true)) {
            $pageReferer = $pagesRefererAutorisees[$i];
            $url = "http://" . $_SERVER['HTTP_HOST'] . "/Projet_Suivi_Stages/" . $pageReferer;

            if ($referer === $url) {
            	header('$pageActuelle');
            }
            $i++;
        }
    }else{
    	// Rediriger vers une autre page en cas d'accès direct ou referer non valide
    	header('Location: ../index.php');
    	exit();
    }
}


function deconnecter() {
	// fermer la connexion
    $connexion = null;
    // fermer la session
	session_destroy();
    header("location: ../index.php");
    exit();
}

// Fonction pour chiffrer les données 
function chiffrerDonnee($donnee) {
    $cle = 'MaCleDeChiffrementSecrete';
    // Génération d'un vecteur d'initialisation aléatoire
    $iv = random_bytes(16); // IV de 16 octets

    // Chiffrement des données
    $donneeChiffree = openssl_encrypt($donnee, 'AES-256-CBC', $cle, OPENSSL_RAW_DATA, $iv);

    // Encodage du vecteur d'initialisation et des données chiffrées en base64
    $donneeChiffree = base64_encode($iv . $donneeChiffree);

    return $donneeChiffree;
}

// Fonction pour déchiffrer les données
function dechiffrerDonnee($donneeChiffree) {
    $cle = 'MaCleDeChiffrementSecrete';

    // Décodage de la chaîne base64
    $donneeChiffree = base64_decode($donneeChiffree);

    // Extraction du vecteur d'initialisation et des données chiffrées
    $ivLength = 16; // Longueur de l'IV en octets
    $iv = substr($donneeChiffree, 0, $ivLength);
    $donneeChiffree = substr($donneeChiffree, $ivLength);

    // Vérification de la longueur de l'IV
    $iv = str_pad($iv, $ivLength, "\0");

    // Déchiffrement des données
    $donneeDechiffree = openssl_decrypt($donneeChiffree, 'AES-256-CBC', $cle, OPENSSL_RAW_DATA, $iv);

    return $donneeDechiffree;
}



// Fonction pour éxecuter les requêtes sql
function executeRequete($requete) {

// Connexion à la base de données
include('connexion.php');

  $resultat = $connexion->query($requete);
  if ($resultat === false) {
    // Gérer l'erreur de requête
  }
  // fermer la connexion
  $connexion = null;

  return $resultat;
}


// Fonction pour générer des options d'une liste
function genererOptions($requete, $valeurColonne, $optionSelectionnee='') {
    // Exécution de la requête
    $resultat = executeRequete($requete);
	
    // Génération des options en utilisant fetch()
    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $option = $row[$valeurColonne];
        $selected = ($option == $optionSelectionnee) ? 'selected' : '';
        echo "<option value='$option' $selected>$option</option>";
    }
}

// Fonction pour dechiffrer et générer des options d'une liste
function genererOptions2($requete, $valeurColonne, $optionSelectionnee='') {
    // Exécution de la requête
    $resultat = executeRequete($requete);
    // Génération des options en utilisant fetch()
    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $option = dechiffrerDonnee($row[$valeurColonne]);
        $selected = ($option == $optionSelectionnee) ? 'selected' : '';
        echo "<option value='$option' $selected>$option</option>";
    }
}

function genererOptions3($requete, $valeurColonne ) {
    // Exécution de la requête
    $resultat = executeRequete($requete);
	
	// Option vide avec un message d'instruction
   echo "<option value=''>Sélectionner une classe</option>";
    // Génération des options en utilisant fetch()
    while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
        $option = $row[$valeurColonne];
        echo "<option value='$option'>$option</option>";
    }
}

function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = addslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


function verifierNom($nom) {
    if (preg_match("/^[^<,\"@/{}()*$%?=>:|;#]*$/i", $nom)) {
 		$err = '&errNom';
    }else{
		$err='';
    }
return $err;
}

function verifierDate($date) {
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
        
        $err = '&errDate';
    }else{
		$err='';
    }
return $err;
}

function verifierTelephone($telephone) {
    if (!preg_match("/^\d{10}$/", $telephone)) {
        // rediriger vers le fichier spécifié avec la variable d'erreur
       // header('Location: ' . $fichier . '?' . $erreur);
      $err = '&errTelephone';
    //$err='';
    }else{
		$err='';
    }
return $err;
}

function verifierEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // rediriger vers le fichier spécifié avec la variable d'erreur
        //header('Location: ' . $fichier . '?' . $erreur);
        $err = '&errEmail';
   
    }else{
		$err='';
    }
return $err;

}



function afficherErr($err) {
    include('messages.php');

    if ($err === 'errNom' && isset($_GET['errNom'])) {
        echo $errNom;
    }
    if ($err === 'errPrenom' && isset($_GET['errPrenom'])) {
        echo $errPrenom;
    }

    if ($err === 'errDate' && isset($_GET['errDate'])) {
        echo $errDate;
    }
    if ($err === 'errTelephone' && isset($_GET['errTelephone'])) {
        echo $errTelephone;
    }
    if ($err === 'errEmail' && isset($_GET['errEmail'])) {
        echo $errEmail;
    }
}

// Fonction pour stocker les valeurs du $_POST dans une sessiton
function stockerPostSession() {
    session_start();

    foreach ($_POST as $cle => $valeur) {
        $_SESSION[$cle] = $valeur;
    }
}

function supprimerPost() {
    foreach ($_POST as $cle => $valeur) {
    	unset($_SESSION[$cle]);
        unset($_POST[$cle]);
    }
}

// Fonction pour afficher une valeur spécifique de la session en utilisant un paramètre 
function afficherValeurSession($cle) {
 
	    if (isset($_SESSION[$cle])) {
        echo $_SESSION[$cle];
    }
}

?>