<!-- instraction on php create new database name and field insert in create table name + column name and type -->

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
	
$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
	// print_r($email);
	// die;
	
	if(!empty($email) && !empty($password)) {
		$query=mysqli_query($conn,"SELECT * FROM user_login_stu WHERE email='$email' AND password='$password'");
		// print_r($query);
		// exit;
	}
	if(mysqli_num_rows($query)>0){
		$_SESSION["a"]= " Suuccessfully Login";
	  	$row=mysqli_fetch_assoc($query);   
	  	header("location:../views/master/index.php");
	}else{
		$_SESSION["a"]= " Invalid Username And Password";	
	  	header("location:../views/Login.php");
	}
?> 
