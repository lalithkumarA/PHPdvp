<?php 
   session_start();
   if(empty($_SESSION)){
      header("location: ../../Login.php");
   }
?>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "sarathi343";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql = "SELECT  department FROM classdpt";
$result = mysqli_query($conn, $sql);
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
            <li><a href="../../../controller/logoutcontroller.php"><button class="btn btn-danger navbar-btn">Logout</button></a>
            </li>
          </ul>
        </div>
      </nav>
      <div class="container">
         <div class="head1"><center>Bio-Data</center></div>
         <form action="../../../controller/std_controller.php" method="POST">
            <div class="form-group">
               <label for="name">Name:</label>
               <input type="name" class="form-control" name="name" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
            <label for="gender">Gender:</label>
               <input type="radio" name="gender" value="male"> Male
               <input type="radio" name="gender" value="female"> Female
            </div>
            <div class="form-group">
               <label for="address">Address:</label>
               <input type="text" class="form-control" name="address" placeholder="Enter Address" required>
            </div>
            <div class="form-group">
               <label for="blood">Blood Group:</label>
               <select class="form-control" name="blood">
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>                                    
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option> 
               </select>
            </div>
            <div class="form-group">
               <label for="bday">Data OF Birth:</label><br>
               <input type="date" name="bday" min="1000-01-01" required>
            </div>
            <div>
               <label for="Food">Food:</label><br>
               <input type="checkbox" name="food[]" value="Egg_sandwich" checked>Egg sandwich<br>
               <input type="checkbox" name="food[]" value="soup" checked>soup<br>
               <input type="checkbox" name="food[]" value="Sweet_Chocolate" checked>SweetChocolate<br>
               <input type="checkbox" name="food[]" value="Milk" checked=>Milk<br>
            </div>
            <div class="form-group">
              <label for="department">Department:</label><br>
                <select class="form-control" name="department">
                     <?php
                      while($row = mysqli_fetch_assoc($result)) {
                        echo  "<option value='" . $row['department'] . "'>" . $row['department'] . "</option>";
                      }?>
                </select>
            </div>
            
            <center><button type="submit" class="button" class="btn btn-default">Submit</button></center>
         </form>
      </div>
   </body>
</html>


<!-- <select class="form-control" name="department">
     <?php
   while ($row = mysqli_fetch_assoc($result)) {
     ?>
   <option value="<?php echo $row['department']; ?>" ><?php echo $row['department']; ?></option>
   <?php } ?>
</select> -->