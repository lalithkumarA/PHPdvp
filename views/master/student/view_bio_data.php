<?php
   session_start();
   if(empty($_SESSION)){
      header("location: ../../Login.php");
   }
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";

// echo "<pre>";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$results = mysqli_query($conn, "SELECT * FROM student_data"); 

?>

<html lang="en">
   <head>
     <title>Student Details</title>
     <link rel="stylesheet" type="text/css" href="../../../design/style.css">
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   </head>
   <body>
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="../index.php">Greefi Technologies</a>
          </div>
          <ul class="nav navbar-nav">
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="">Department <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="../department/add_course.php">Add Department</a></li>
                      <li><a href="../department/view_course.php">View Department</a></li>
                  </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="">Student <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="bio_data.php">Add Student</a></li>
                      <li><a href="view_bio_data.php">View Student</a></li>
                  </ul>
              </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="../../../controller/logoutcontroller.php"><button class="btn btn-danger navbar-btn">Logout</button></a>
            </li>
          </ul>
        </div>
      </nav>
      <table class="table table-striped">
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Gender</th>
               <th>Address</th>
               <th>Blood Group</th>
               <th>Data OF Birth</th>
               <th>Food</th>
               <th>Department</th>
               <th colspan="10">Action</th>
            </tr>
         </thead>
         <?php while ($row = mysqli_fetch_array($results)) { ?>
         <tr class="success">
            <?php $Food = unserialize($row['food']); ?>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['blood']; ?></td>
            <td><?php echo $row['bday']; ?></td>
            <td><?php echo implode(',', $Food); ?></td>
            <td><?php echo $row['department']; ?></td>
            

            <td>
               <a href="edit_bio_data.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-primary btn-md">Edit</button></a>
            </td>
            <td>
               <a href="../../../controller/delete_stu_controller.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
            </td>
         </tr>
         <?php } ?>
      </table>
   </body>
</html>
