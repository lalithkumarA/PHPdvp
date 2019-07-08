<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
                    <h2>Register</h2>
                    <p>Please fill this form to create an account.</p>
                    <form action="../controller/Registercontroller.php"  method="post">
                        <div class="form-group">
                            <label><strong>Name</strong></label>
                            <input type="name" name="name" class="form-control name">
                        </div>
                        <div class="form-group">
                            <label><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control email">
                        </div>    
                        <div class="form-group">
                            <label><strong>Password</strong></label>
                            <input type="password" name="password" class="form-control password">
                        </div>
                        <div class="form-group">
                            <label><strong>Contact Number</strong></label>
                            <input type="number" name="contact" class="form-control contact">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary Submit" value="Submit" >
                            <!-- onClick="myFunction()" -->
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>
                        <p>Already have an account? <a href="Login.php" class="btn btn-primary">Login IN Here</a>.</p>
                    </form>
                </div>
            </div>
        </div>    
    </div>
</div>
</body>
</html>

<script type="text/javascript">

    $(document).ready(function(){
        $('.Submit').click(function(){
           var name = $('.name').val();
           var email = $('.email').val();
           var password = $('.password').val();
           if(name!= ''){
                if(email!= ''){
                    if(password!= ''){
                        alert('successfully');  
                    }else{
                        alert('Fill Password');
                    }
                }else{
                    alert('Fill Email');
                }
           }else{
                alert('Fill Name');
            }
            
            
        });
       
    });


        function myFunction() {
          confirm("Register Successfully!");
        }

</script>