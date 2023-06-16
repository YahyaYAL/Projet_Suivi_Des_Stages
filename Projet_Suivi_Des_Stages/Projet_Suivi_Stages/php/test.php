
<?php  
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", 1);
include('connexion_mysql.php');
?>


<form action="test.php" method="post">
                
	<input type="text" placeholder="Identifiant..." name="username" required>
	<span class="error">* <?php echo $nameErr;?></span>
               
    <input type="submit" id='submit' value='LOGIN' >
				
</form><br><br>

<?php 
	$login = $_POST['username'];
	echo "test1: " . $_POST['username'] . "<br><br>";
	echo "test2: " . mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])) . "<br><br>"; 
	echo "test3: " . mysqli_real_escape_string($db,$_POST['username'])."<br><br>";
	$user = mysqli_real_escape_string($db,$_POST['username']);
$requete = "SELECT count(*) 
                        FROM login 
                        where identifiant = '".$user."' ";
echo $requete;
?>