<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sarathi343";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$name = $_POST['name'];
$email = $_POST['email'];
$password1 = $_POST['password'];
$contact = $_POST['contact'];

if(isset($name) && !empty($name) && isset($email) && !empty($email)){
	$sql="INSERT INTO user_login_stu(name,email,password,contact) VALUES ('$name','$email','$password1','$contact')";
	// exit;
}

if(mysqli_query($conn, $sql)){
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header('location:../views/Login.php');

?>