<html>
<head>

</head>
 <?php
 session_start();
 error_reporting(E_ALL);
 ini_set('display_errors', 1);
 
include "db_connect.php";

$username = $_POST['username'];
$password = $_POST['password'];

echo "<h2>You attempted to login with " . $username . " and " . $password . "</h2>";

$stmt = $mysqli->prepare("SELECT user_id, user_name, password FROM users WHERE user_name = ?");
$stmt->bind_param("s", $username);

$stmt->execute();
$stmt->store_result();

$stmt->bind_result($userid, $user, $pass);

echo $userid . "<br>";

if ($stmt->num_rows == 1) {
    $stmt->fetch();

    if(password_verify($password, $pass)) {
        echo "login successful <br>";
        $_SESSION['username'] = $user;
        $_SESSION['userid'] = $userid;
    }
    else{
        echo("invalid password <br>");
    }

} else {
    echo "0 results";
}

echo "Session variable = ";
print_r($_SESSION);

echo "<br>";

echo "<a href='index.php'>Return to main page</a>";
?>

</html>
