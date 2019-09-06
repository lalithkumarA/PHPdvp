<?php
   session_start();
   if(empty($_SESSION)){
      header("location: ../../Login.php");
   }
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";
$id = $_GET['id'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$results = mysqli_query($conn, "SELECT * FROM classdpt WHERE id=$id");
$row = mysqli_fetch_array($results);
// print_r($row);

?>

<html lang="en">
   <head>
     <title>Student Course Details Edit</title>
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
                      <li><a href="add_course.php">Add Department</a></li>
                      <li><a href="view_course.php">View Department</a></li>
                  </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="">Student <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      <li><a href="../student/bio_data.php">Add Student</a></li>
                      <li><a href="../student/view_bio_data.php">View Student</a></li>
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
		<div class="container">
			<div class="head1">Edit Form</div>
			<form  action="../../../controller/update_dpt_controller.php?id=<?php echo $row['id']; ?>" method="post">
				<div class="form-group">
			      <label for="department">Department:</label>
			      <input type="name" class="form-control" name="department" value="<?php echo $row['department']; ?>">
			    </div>
			   
					<div class="input-group">
					<button class="btn" type="submit" >Update</button>
				</div>
			</form>
		</div>
	</body>
</html>
