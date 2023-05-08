<?php
$servername = "localhost";
$username = "u440868973_submituser";
$password = "yH2JHFsAycn2R6i";

try {
  $conn = new PDO("mysql:host=$servername;dbname=u440868973_submitdb", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>