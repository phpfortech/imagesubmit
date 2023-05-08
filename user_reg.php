<?php
session_start();

if (isset($_SESSION['id'])) {
    // Redirect to profile page if user is already logged in
    header('Location: https://phpfortech.in/user/');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
		}
		form {
			background-color: #fff;
			border-radius: 5px;
			padding: 20px;
			width: 400px;
			margin: 50px auto;
		}
		input[type=text], input[type=password] {
			width: 100%;
			padding: 10px;
			margin: 5px 0;
			border: none;
			border-radius: 3px;
			box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
		}
		button {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
		}
		button:hover {
			background-color: #3e8e41;
		}
		.login {
			text-align: center;
			margin-top: 20px;
		}
		.login a {
			color: #4CAF50;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<form action="insert_data.php" method="POST" enctype="multipart/form-data" >
		<h2>Registration Form</h2>
		<label for="username"><b>Name</b></label>
		<input type="text" placeholder="Enter Full name" name="name" >
		
		<label for="username"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="uname" >

		<label for="email"><b>Email</b></label>
		<input type="text" placeholder="Enter Email" name="email" >
		<label for="username"><b>Mobile</b></label>
		<input type="text" placeholder="Enter Mobile Number" name="mobile" >
			<label for="password"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="pass" >
		
		<label for="user_image"><b>Profile Image</b></label>
       <input type="file" name="user_image" accept="image/*"  >


		<button type="submit">Register</button>

		<div class="login">
			Already have an account? <a href="#">Login</a>
		</div>
	</form>
</body>
</html>
