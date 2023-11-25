<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Accordion - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>
</head><?php

include "db_connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
$keywordfromform = $_GET['keyword'];
echo $keywordfromform;




echo "<h2>Show all jokes with the word " . $keywordfromform . "</h2>";
$keywordfromform = "%" . $keywordfromform . "%";

$sql = "SELECT JokeID, Joke_question, Joke_answer, Jokes_table.user_id, user_name FROM Jokes_table JOIN users ON users.user_id = Jokes_table.user_id WHERE Joke_question LIKE '$keywordfromform'";

echo "SQL Statement: " . $sql . "<br>";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
  echo "<div id='accordion'>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $safe_joke_question = htmlspecialchars($row['Joke_question']);
    $safe_joke_answer = htmlspecialchars($row['Joke_answer']);

    echo "<h3>" . $safe_joke_question . "</h3>";
        
    echo "<div><p>" . $safe_joke_answer  . " -- Submitted by user " . $username ."</p></div>";
  }
  echo "</div>";
} else {
  echo "0 results";
}

?>
