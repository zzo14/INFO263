<?php
session_start();
require_once("../config/config.php");

$submit=isset($_POST['submit']);
$register = isset($_POST['register']);

if($submit){
    $username=str_replace(" ","",$_POST['username']);
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $sql="call user_login('$username')";//stored procedures
    $query=mysqli_query($mysqli,$sql);
    $us=is_array($row=mysqli_fetch_array($query));

    $passworda=md5($_POST['password']);
    $ps=$us ? ($passworda)==$row['password']:FALSE;

    if($ps){
        $_SESSION['userid']=$row['id'];
        $_SESSION['username']=$row['username'];
        echo "<script>window.location.href='../index.php';</script>";
    }else{
        echo "<script>alert('Username or Password is wrong');window.location.href='login.php';</script>";
    }
} elseif ($register) {
    echo "<script>window.location.href='registration.php';</script>";
} else{
    ?>
    <!DOCTYPE html>
    <head>
        <title>login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/login.css" rel="stylesheet">
    </head>
    <body>
    <div class="context">
        <div class="container">
            <h1>Welcome to TServer Web</h1>
            <form name="login" action="" method="post">
                <input type="text"  name="username" placeholder="Username"/>
                <input type="password"  name="password" placeholder="Password"/>
                <div align="left" style="float:left;width:15%; margin-left:175px; margin-top:20px;" >
                    <input type="submit" name="register" value="Register" style="width: 100px"></input>
                </div>
                <div align="right" style="float:right;width:15%; margin-right:187px; margin-top: 20px;">
                    <input type="submit" name="submit" value="Log In" style="width: 100px"></input>
                </div>
            </form>
    </div>
    </div>
    </body>
    </html>
    <?php
}
?>