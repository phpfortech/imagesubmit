<?php
// Define database credentials
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'u440868973_submituser');
define('DB_PASSWORD', 'yH2JHFsAycn2R6i');
define('DB_NAME', 'u440868973_submitdb');

// Attempt to connect to database
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Define variables and initialize with empty values    
$username = $password = "";
$username_err = $password_err = "";

// Process form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $uname_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $pass = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($uname_err) && empty($pass_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM admin_user WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){  
                        $db_pass = $row["password"];
                        // Verify password
                        if ($pass === $db_pass){
                            // Password is correct, so redirect to welcome page
                            header("location: https://phpfortech.in/techadmin/admin_dashboard.php");
                            exit();
                        } else {
                            // Display an error message if password is incorrect
                            $pass_err = "The password you entered is incorrect.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $uname_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
<style>
.login-container {
    width: 400px;
    margin: 100px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 0px 10px #ccc;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form label {
    display: block;
    margin-bottom: 5px;
}

form input[type="text"],
form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form input[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #009688;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease-in-out;
}

form input[type="submit"]:hover {
    background-color: #008077;
}
</style>
</head>
<body>
	<div class="login-container">
		<h2>Admin Login</h2>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<label for="username">Username</label>
			<input type="text" name="username" id="username">
			<span><?php echo $username_err; ?></span>

			<label for="password">Password</label>
			<input type="text" name="password" id="password">
			<span><?php echo $password_err; ?></span>

			<input type="submit" value="Login">
		</form>
	</div>
</body>
</html>
