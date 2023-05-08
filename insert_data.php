<?php 
session_start();

if (isset($_SESSION['id'])) {
    // Redirect to profile page if user is already logged in
    header('Location: https://phpfortech.in/user/');
    exit();
}
require_once 'con.php';


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $uname = $_POST['uname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    // Check if user uploaded an image
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == UPLOAD_ERR_OK) {
        // Get image data
        $image_name = $_FILES['user_image']['name'];
        $image_tmp = $_FILES['user_image']['tmp_name'];
        $image_size = $_FILES['user_image']['size'];
        
        // Check if file is an image
        $image_info = getimagesize($image_tmp);
        if (!$image_info || ($image_info[2] != IMAGETYPE_JPEG && $image_info[2] != IMAGETYPE_PNG)) {
            die('Error: File is not a valid image');
        }
        
        // Generate a unique filename for the image
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_filename = uniqid() . '.' . $image_ext;
        
        // Save the image to the user_profile folder
        $image_path = 'user_profile/' . $image_filename;
        move_uploaded_file($image_tmp, $image_path);
    } else {
        // User did not upload an image
        $image_path = null;
    }
    
    try {
        // Prepare and execute the SQL statement
        $stmt = $conn->prepare("INSERT INTO login (name, uname, mobile, email, pass, user_image, reg_date) VALUES (:name, :uname, :mobile, :email, :pass, :user_image, NOW())");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':uname', $uname);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':user_image', $image_path);
        $stmt->execute();
        
        // Redirect to a success page
        header("Location: user_login.php");
        exit();
    } catch(PDOException $e) {
        // Display an error message
        echo "Error submitting data: " . $e->getMessage();
    }
}

 
?>