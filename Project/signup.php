<!DOCTYPE html>
<html lang="en">

<?php
require('connection.php');
session_start();
?>

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="icon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap.min.js"></script>
    <script src="jquery.js"></script>
    <link href="bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="index.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <title>SIGNUP PAGE</title>
</head>

<body>

<?php

$msg="";
$error="";
if(isset($_REQUEST["signbtn"]) && !empty($_REQUEST["signbtn"]))
{
    $username=$_REQUEST["uname"];
    $login=$_REQUEST["lid"];
    $password=$_REQUEST["pswd"];
    $confirm=$_REQUEST["cp"];
    $_SESSION["name"]=$username;
    $query="INSERT INTO user (name,login,password) VALUES ('$username','$login','$password')";
    if($confirm!=$password)
    {
        $error="PASSWORD NOT MATCHED!";
    }
    else if(mysqli_query($conn,$query)==true)
    {
        $lastid=mysqli_insert_id($conn);
        $msg="SUCCESSFULLY SIGNED UP!";
    }
    else{
        $error="USER ALREADY EXISTS!";
    }
}




?>

    <div class="container">
        <div class="img">
            <img src="2.svg">
        </div>
        <div class="login-container">
            <form action="signup.php" method="POST">
                <img src="1.svg" class="avatar">
                <h2>Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-venus"></i>
                    </div>
                    <div>
                        <h5>Username</h5>
                        <input class="input" type="text" required name="uname">
                    </div>
                </div>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <h5>Login ID</h5>
                        <input class="input" type="text" required name="lid">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input class="input" type="password" required name="pswd">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Confirm Password</h5>
                        <input class="input" type="password" required name="cp">
                    </div>
                </div>
                <input type="submit" class="btn" value="Sign Up" name="signbtn">
                <a href="login.php">LOGIN</a>
               <div id="divv">
               <p style="color:green;" ><?php echo $msg ?></p>
                <p style="color:red;" id="p"><?php echo $error ?></p>
                </div>
            </form>
        </div>

    </div>

    <script>
        const inputs = document.querySelectorAll('.input');

        function focusfunc() {
            let parent = this.parentNode.parentNode;
            parent.classList.add('focus');
        }

        function blurfunc() {
            let parent = this.parentNode.parentNode;
            if (this.value == "") {
                parent.classList.remove('focus');
            }
        }
        inputs.forEach(input => {
            input.addEventListener('focus', focusfunc);
            input.addEventListener('blur', blurfunc);

        })
    </script>

</body>

</html>