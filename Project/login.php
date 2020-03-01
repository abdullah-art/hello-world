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
    <title>LOGIN PAGE</title>
   
</head>

<body>

<?php
$error="";
if(isset($_REQUEST["loginbtn"]) && !empty($_REQUEST["loginbtn"]))
{
    $login=$_REQUEST["lid"];
    $password=$_REQUEST["pswd"];
    $query="SELECT * FROM user where login='$login' and password='$password'";
    $result=mysqli_query($conn,$query);
    $recordFounded=mysqli_num_rows($result);
    
        if($recordFounded==1)
        {
            $row=mysqli_fetch_assoc($result);
            $_SESSION["userId"]=$login;
            $_SESSION["uid"]=$row["id"];
            header('Location:home.php');
        }
        else{
            $error="Invalid Login or Password";
        }
    }
?>

<script>
 setTimeout(() => {
        const elem = document.getElementById("pid");
        elem.parentNode.removeChild(elem);
    }, 2000);

 
   
</script>

 
<div class="container">
        <div class="img">
            <img src="2.svg">
        </div>
        <div class="login-container">
            <form action="login.php" method="POST">
                <img src="1.svg" class="avatar">
                <h2>Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <h5>Login ID</h5>
                        <input class="input" type="text" name="lid" required>
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <h5>Password</h5>
                        <input class="input" type="password" name="pswd" required>
                    </div>
                </div>
                <input type="submit" class="btn" value="Login" name="loginbtn">
                <br>
                <span style="">Don’t have an account?<spna><br><br>
                <a href="signup.php">SIGN UP</a>
                <p style="color:red;" id="pid"><?php echo $error ?></p>
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