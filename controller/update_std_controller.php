<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sarathi343";
$id = $_GET['id'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$Name = $_POST['name'];
$Gender = $_POST['gender'];
$Address = $_POST['address'];
$Blood = $_POST['blood'];
$Bday = $_POST['bday'];
$Food = serialize($_POST['food']);
$Department = $_POST['department'];

$sql="UPDATE student_data SET name='$Name', gender='$Gender', address='$Address', blood='$Blood', bday='$Bday', food='$Food', department='$Department' WHERE id=$id";

if (mysqli_query($conn, $sql)){
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

header('location:../views/master/student/view_bio_data.php')

?>
