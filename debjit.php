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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Define the SQL query
$sql = "SELECT * FROM login";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll();

// Output the results
foreach ($results as $result) {
    echo $result['id'] . ' ' . $result['name'] . ' ' . $result['email'] . $result['mobile'] . ' ' . $result['uname'] . ' ' .$result['pass'] . ' ' .'<br>';
}


$stmt = $conn->prepare("SELECT COUNT(*) AS total_users FROM login");

// execute the query
$stmt->execute();

// fetch the result as an associative array
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// output the total number of users
echo 'Total number of users: ' . $result['total_users'];

// Close the connection
$pdo = null;
?>
