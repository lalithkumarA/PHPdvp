<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";
$id = $_GET['id'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$Department = $_POST['department'];

$sql="UPDATE classdpt SET department='$Department' WHERE id=$id";

if (mysqli_query($conn, $sql)){
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// mysqli_close($conn);

header('location:../views/master/department/view_course.php')

?>
