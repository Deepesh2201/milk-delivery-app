<?php

$servername = "localhost";
$username = "thenexteck";
$password = "TheNexteck1!";
$dbname = "milkdelivery";
// $conn = mysqli_connect($servername, $username, $password);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  $sql = "SELECT * FROM onloadings";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      echo "id: " . $row["id"]. " - Sales Man Id: " . $row["salesman_id"]. " - Is Approved ? " . $row["is_approved"]. "<br>";
    }
  } else {
    echo "0 results";
  }
  
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>