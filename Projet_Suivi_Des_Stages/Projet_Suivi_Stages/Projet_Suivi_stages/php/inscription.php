<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);

	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");

include('fonctions.php');

?>
<html>
<head>
    <meta charset="UTF-8"
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/connexion.css">
    <title>Page d inscription</title>
	<style>
    h1 {
      color: red;
    }
  </style>
	
</head>

<header>
    <!-- bar de navigation -->
    <nav>
        <div>
            <h1>Logo.</h1>
        </div>
    </nav>
</header>
<body>
    <main>
  		<div class="contain">
        <div class="login-container">
            <form class="formVerifier" action="verifierInscription.php" method="post" autocomplete="off">
                <div class="profilImg">
                    <img src="../images/profil_img.png" alt="">
                </div>
  				<input type="hidden" name="action" value="verifier"><br>
				<input type="text" placeholder="Votre nom..." name="lastname" required>
				<input type="text" placeholder="Votre prénom..." name="firstname" required>
                <input type="date" placeholder="Date de naissance..." name="dateNaissance" required>
  				<input type="email" placeholder="Votre mail..." name="email" required>
               
                <input type="submit" id='submit' >
				<?php
					if (isset($_GET['err'])) {
    					$erreur = $_GET['err'];
    					if ($erreur == 1) {
        					echo "<p style='color: #fd9956;'>L'étudiant n'existe pas.</p>";
    					} elseif ($erreur == 2) {
        					echo "<p style='color: #fd9956;'>L'étudiant est déjà inscrit.</p>";
    					}
					}
				?>
            </form>
        </div>        
             <?php
session_start();
if (isset($_SESSION['isExist']) && $_SESSION['isExist'] === true) {
?>

<div class="login-container">
    <form class="inscription" action="verifierInscription.php" method="post" autocomplete="off" onsubmit="return validateurANSSI();">
        <input type="hidden" name="action" value="inscription"><br>
        <input type="email" id="email" name="email2" value="<?php afficherValeurSession('mail'); ?>" placeholder="Email" required>
        <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" oninput="updateCheckboxes()" required>
        <div id="password-strength-criteria">
            <div class="password-criterion">8 caractères</div>
            <div class="password-criterion">une lettre majuscule</div>
            <div class="password-criterion">un caractère spécial</div>
            <div class="password-criterion">un chiffre</div>
        </div>
        <input type="password" id="mdp2" name="mdp2" placeholder="Confirmez le mot de passe" oninput="updateCheckboxes()" required>
		<input type="checkbox" id="voirmdp" onclick="voirMDP()"> Voir mot de passe
        <input class="submit" type="submit" value="S'inscrire">
    </form>
</div>



<?php
    
}
?>
        </div>
             
    </main>
	<script src="../js/script.js"></script>
</body>
</html>

