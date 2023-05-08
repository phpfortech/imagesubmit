<?php
// Include the config file
require_once 'con.php';

// Initialize variables
$uname = $pass = '';
$uname_err = $pass_err = '';

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate username
  if (empty(trim($_POST["uname"]))) {
    $uname_err = "Please enter your username.";
  } else {
    $uname = trim($_POST["uname"]);
  }

  // Validate password
  if (empty(trim($_POST["pass"]))) {
    $pass_err = "Please enter your password.";
  } else {
    $pass = trim($_POST["pass"]);
  }

  // Check input errors before logging in
  if (empty($uname_err) && empty($pass_err)) {

    try {
      // Prepare and execute the SQL statement
      $stmt = $conn->prepare("SELECT id, uname, pass FROM login WHERE uname = :uname");
      $stmt->bindParam(':uname', $uname);
      $stmt->execute();

      // Check if username exists, and if so, verify the password
      if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        $hashed_pass = $row['pass'];
        if (password_verify($pass, $hashed_pass)) {
          // Password is correct, so start a new session
          session_start();

          // Store data in session variables
          $_SESSION["id"] = $row['id'];
          $_SESSION["uname"] = $row['uname'];

          // Redirect to the welcome page
          header("location: welcome.php");
          exit();
        } else {
          // Display error message if password is incorrect
          $pass_err = "The password you entered is not valid.";
        }
      } else {
        // Display error message if username doesn't exist
        $use_err = "No account found with that username.";
      }

    } catch(PDOException $e) {
      // Display error message
      echo "Error logging in: " . $e->getMessage();
    }
  }
}

?>