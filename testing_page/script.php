



 <!-- <?php
session_start();
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "phpdev";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
 if(isset($_POST["email"]))  { 
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$password = mysqli_real_escape_string($conn,$_POST['password']);

	if(!empty($email) && !empty($password)) {

	$query=mysqli_query($conn,"SELECT * FROM user_login_stu WHERE email='$email' AND password='$password'");
	   if(mysqli_num_rows($query)>0){
	      $row=mysqli_fetch_assoc($query);
	      $_SESSION = $row;    
	      header("location:../show/master/index.php");
	   }else{
	      header("location:../show/master/index.php?status=wrong password or user email id");
	   }
	} else {
	   header("location:../show/master/index.php?status=success");
	}
}
?>  -->






<!-- <script type="text/javascript">
    $(document).ready(function(){  
        $('#submit').click(function(){
            var email = $('#email').val();  
            var password = $('#password').val();  
               if(email == '' || password == '')  
               {  
                    $('#error_message').html("All Fields are required");  
               }else{
                console.log(email);
                $('#error_message').html('');  
                $.ajax({  
                     url:"../controller/sign_incontroller.php",  
                     method:"POST",  
                     data:{email:email, password:password},  
                     success:function(data){  
                        

                          // $("form").trigger("reset");  
                          $('#success_message').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#success_message').fadeOut("Slow");  
                          }, 2000);  
                     }  
                });  
               }
        });
    });
</script> -->