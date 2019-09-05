<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";
// echo "<pre>";
// Create connection
$id = $_GET['id'];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "DELETE FROM classdpt WHERE id=$id";
// $sql = "DELETE FROM student_data WHERE id=$id";

// echo $sql = "DELETE FROM detail WHERE 'sno=$sno'";

if (mysqli_query($conn, $sql)){
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

header('location:../views/master/department/view_course.php');
// header('location:../views/master/student/view_bio_data.php')
?>
