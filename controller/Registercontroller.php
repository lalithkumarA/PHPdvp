<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
//echo ("connection");
//if (isset($_POST['login'])) {
	//$email = $_POST['email'];
	//$password1 = $_POST['password'];
	//$query = "SELECT * FROM `user_login_stu` WHERE email='".$email."' and password='".$password1."'";
	//$result = mysqli_query($conn, $query);
	//if ($result) {
		//while ($row=mysqli_fetch_array($result)) {
		//	echo '<script type="text/javascript">alert("you are login successfully and you are logined as ' .$row['email'].'")</sript>';
		//}
		//if ($email=="email") {
			
			<!-- <script type="text/javascript"></script> -->
		// } -->
	//<!-- } -->
//<!-- } -->





$name = $_POST['name'];
$email = $_POST['email'];
$password1 = $_POST['password'];
$contact = $_POST['contact'];

if(isset($name) && !empty($name) && isset($email) && !empty($email)){
	$sql="INSERT INTO user_login_stu (name,email,password,contact) VALUES ('$name','$email','$password1','$contact')";
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