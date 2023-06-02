<html>
<head>
    <meta charset="UTF-8">
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
            <form action="php/verification.php" method="post">
                <div>
                    <img src="images/profil_img.png" alt="">
                </div>
                <input type="text" placeholder="Identifiant..." name="username" required>
                <input type="password" placeholder="Mot de passe..." name="password" required>
                <a href="">Mot de passe oublié</a>
                <input type="submit" id='submit' value='LOGIN' >
				<?php
 					if(isset($_GET['erreur'])){
 						$err = $_GET['erreur'];
 						if($err==1 || $err==2)
 							echo "<p style='color:#fd9956'>Identifiant ou mot de passe incorrect</p>";
 						}
 				?>
            </form>
        </div>
    </main>
</body>
</html>
