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