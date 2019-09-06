<?php 
   session_start();
   if(empty($_SESSION)){
      header("location: ../../Login.php");
   }
?>

<html lang="en">
   <head>
     <title>Student Course Details</title>
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
            <li><a href="../../../controller/logoutcontroller.php"><button class="btn btn-danger navbar-btn">Logout</button></a>
          </ul>
        </div>
      </nav>
      <div class="container">
         <div class="head1"><center>Department Section</center></div>
         <form action="../../../controller/dpt_controller.php" method="POST" onSubmit="return checkform()">
            <div class="form-group">
               <label for="department">Department:</label>
               <input type="text" class="form-control" name="department" placeholder="Enter Name">
            </div>
            <center><button type="submit" class="button" class="btn btn-default">Submit</center></button>
         </form>
      </div>
   </body>
</html>