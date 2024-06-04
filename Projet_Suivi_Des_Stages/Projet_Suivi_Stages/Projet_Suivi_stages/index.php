<?php
	header("Cache-Control: no-cache, no-store, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<html>
<head>
    <meta charset="UTF-8"
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Page de connexion</title>
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
        <div class="login-container">
            <form action="php/verification.php" method="post" autocomplete="off">
                <div class="profilImg">
                    <img src="images/profil_img.png" alt="">
                </div>
                <input class="marg" type="text" placeholder="Identifiant..." name="username" required>
                <input class="pass-marg" type="password" placeholder="Mot de passe..." name="password" required>
				<input type="checkbox" id="voirmdp" onclick="voirMDP()"> Voir mot de passe
                <a href="php/inscription.php">Créer un compte</a>
                <input type="submit" id='submit' value='LOGIN' >
				<?php
					echo  $_SESSION['start'];
					echo $_SESSION['username'];
 					if(isset($_GET['erreur'])){
 							echo "<p style='color:#fd9956'>Identifiant ou mot de passe incorrect</p>";
 						}
 				?>
            </form>
        </div>
    </main>
   	<script src="js/script.js"></script>
</body>
</html>
