<?php
session_start();

if (isset($_SESSION['id'])) {
    // Redirect to profile page if user is already logged in
    header('Location: https://phpfortech.in/user/');
    exit();
}
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
$uname = $pass = "";
$uname_err = $pass_err = "";

// Process form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["uname"]))){
        $uname_err = "Please enter username.";
    } else{
        $uname = trim($_POST["uname"]);
    }

    // Validate password
    if(empty(trim($_POST["pass"]))){
        $pass_err = "Please enter your password.";
    } else{
        $pass = trim($_POST["pass"]);
    }

    // Validate credentials
    if(empty($uname_err) && empty($pass_err)){
        // Prepare a select statement
        $sql = "SELECT id, uname, pass FROM login WHERE uname = :uname";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":uname", $param_uname, PDO::PARAM_STR);

            // Set parameters
            $param_uname = $uname;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $db_id = $row["id"];
                        $db_pass = $row["pass"];
                        // Verify password
                        if ($pass === $db_pass){
                            // Password is correct, so start a session and store user ID
                            session_start();
                            $_SESSION["id"] = $db_id;
                            // Redirect to welcome page
                            header("location: https://phpfortech.in/user");
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
	<title>Login Form</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		form {
			background-color: #fff;
			max-width: 400px;
			margin: 50px auto;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.3);
		}

		h2 {
			text-align: center;
		}

		input[type=text], input[type=password] {
			display: block;
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: none;
			border-radius: 5px;
			box-shadow: 0 0 5px rgba(0,0,0,0.1);
			font-size: 16px;
			color: #333;
			-webkit-transition: box-shadow 0.2s ease-in-out;
			transition: box-shadow 0.2s ease-in-out;
		}

		input[type=text]:focus, input[type=password]:focus {
			box-shadow: 0 0 10px rgba(0,0,0,0.3);
		}

		input[type=submit] {
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
			-webkit-transition: background-color 0.2s ease-in-out;
				transition: background-color 0.2s ease-in-out;
		}

		input[type=submit]:hover {
			background-color: #3e8e41;
		}

	</style>
</head>
<body>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<h2>Login</h2>
		<label for="username">Username:</label>
		<input type="text" id="username" name="uname" value="<?php echo $uname; ?>" placeholder="Enter username" >
		<span><?php echo $uname_err; ?></span>
		<label for="password">Password:</label>
		<input type="password" id="password" name="pass" value="<?php echo $pass; ?>" placeholder="Enter password" >
		<span><?php echo $pass_err; ?></span>
		<input type="submit" class="btn btn-primary" value="Login"><br>&nbsp;
		<div class="registration">
			Create New Account &nbsp;<a href="https://phpfortech.in/user_reg.php">Registration</a>
		</div>
	</form>

</body>
</html>
