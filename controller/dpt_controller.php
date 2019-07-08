<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sarathi343";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$Department = $_POST['department'];

  $sql="INSERT INTO classdpt(department) VALUES ('$Department')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header('location:../views/master/department/view_course.php');
?>
