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

$results = mysqli_query($conn, "SELECT * FROM student_data WHERE id=$id");
$dept =mysqli_query($conn, "SELECT  department FROM classdpt");
$row = mysqli_fetch_array($results);
// $row1 = mysqli_fetch_array($dept);
?>

<html lang="en">
   	<head>
	    <title>Student Edit</title>
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
		<div class="container">
			<div class="head1">Edit Form</div>
			<form  action="../../../controller/update_std_controller.php?id=<?php echo $row['id']; ?>" method="post">
				<?php $Food = unserialize($row['food']); ?>
				<div class="form-group">
			      <label for="name">Name:</label>
			      <input type="name" class="form-control" name="name" value="<?php echo $row['name']; ?>">
			    </div>
			    <div class="form-group">
		            <label for="gender">Gender:</label>
		               <input type="radio" name="gender" value="male" <?php echo ($row['gender']=='male')?'checked':'' ?>> Male
		               <input type="radio" name="gender" value="female" <?php echo ($row['gender']=='female')?'checked':'' ?>> Female
	            </div>
			    <div class="form-group">
			      <label for="address">Address:</label>
			      <input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php echo $row['address']; ?>">
			    </div>
			    <div class="form-group">
	               	<label for="blood">Blood Group:</label>
	               	<select class="form-control" name="blood">
	                  <option value="O+"<?php echo ($row['blood']=='O+')?'selected':'' ?>>O+</option>
	                  <option value="O-"<?php echo ($row['blood']=='O-')?'selected':'' ?>>O-</option>
	                  <option value="A+"<?php echo ($row['blood']=='A+')?'selected':'' ?>>A+</option>
	                  <option value="A-"<?php echo ($row['blood']=='A-')?'selected':'' ?>>A-</option>
	                  <option value="B+"<?php echo ($row['blood']=='B+')?'selected':'' ?>>B+</option>
	                  <option value="B-"<?php echo ($row['blood']=='B-')?'selected':'' ?>>B-</option> 
	                  <option value="AB+"<?php echo ($row['blood']=='AB+')?'selected':'' ?>>AB+</option>
	                  <option value="AB-"<?php echo ($row['blood']=='AB-')?'selected':'' ?>>AB-</option> 
	               	</select>
	            </div>
			    <div class="form-group">
	               <label for="bday">Data OF Birth:</label><br>
	               <input type="date" name="bday" value="<?php echo $row['bday']; ?>">
	            </div>
				<div>
	               <label for="Food">Food:</label><br>
	               <input type="checkbox" name="food[]" value="Egg_sandwich" <?php if(in_array("Egg_sandwich", $Food)){ echo " checked"; } ?> />Egg sandwich<br>
	               <input type="checkbox" name="food[]" value="soup" <?php if(in_array("soup", $Food)){ echo " checked"; } ?> />soup<br>
	               <input type="checkbox" name="food[]" value="Sweet_Chocolate" <?php if(in_array("Sweet_Chocolate", $Food)){ echo " checked"; } ?> />SweetChocolate<br>
	               <input type="checkbox" name="food[]" value="Milk" <?php if(in_array("Milk", $Food)){ echo " checked"; } ?> />>Milk<br>
	            </div>
				<div class="form-group">
		            <label for="department">Department:</label><br>
		                <select class="form-control" name="department">
		                       	<?php
								    while ($row1 = mysqli_fetch_assoc($dept)) {
								  ?>
								<option value="<?php echo $row1['department']; ?>" <?php if ($row['department'] == $row1['department']) { echo 'selected'; } ?> ><?php echo $row1['department']; ?></option>
								<?php } ?> 
		                </select>
		            </div>

					<td>
						<a href="../../../controller/update_std_controller.php?id=<?php echo $row['id']; ?>"></a>
					</td>

				<div class="input-group">
					<button class="btn" type="submit" >Update</button>
				</div>
			</form>
		</div>
</body>
</html>
