<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Sign UP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-sm-8 offset-sm-4 text-center">
            <div class="wrapper">
                <div class="row">
                    <div>
                        <?php
                          if(isset($_SESSION["a"])){
                            echo $_SESSION["a"];
                          }
                        ?>
                        <h2>Sign UP</h2>
                        <form action="../controller/Logincontroller.php" method="post">
                            <div class="form-group">
                                <label><strong>Email</strong></label>
                                <input type="email" name="email" class="form-control" value="">
                            </div>    
                            <div class="form-group">
                                <label><strong>Password</strong></label>
                                <input type="password" name="password" class="form-control" value="">
                            </div>                 
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                            <p>Don't Have an account? <a href="Register.php" class="btn btn-primary">Register Here</a>.</p>
                        </form>
                    </div>
                </div>    
            </div>
        </div>
    </div>            
</body>
</html>



<!-- 
<script type="text/javascript">
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
</script>
 -->
