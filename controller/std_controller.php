<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$Name = $_POST['name'];
$Gender = $_POST['gender'];
$Address = $_POST['address'];
$Blood = $_POST['blood'];
$Bday = $_POST['bday'];
$Food = serialize($_POST['food']);
$Department = $_POST['department'];

  $sql="INSERT INTO student_data(name, gender, address, blood, bday, food, department) VALUES ('$Name','$Gender','$Address','$Blood','$Bday','$Food','$Department')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header('location:../views/master/student/view_bio_data.php');
?>