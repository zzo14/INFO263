<?php
include('../config/config.php');

$goback=isset($_POST['goback']);
$register = isset($_POST['register']);

if($register) {
    if (trim($_POST[username]) != "" and trim($_POST[password]) != "") {
        // Username and Password sent from Form
        $username = mysqli_real_escape_string($mysqli, $_POST['username']);
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $password = md5($password); //Password Encrypted

        $search = "call user_search('$username')";//stored procedures
        $res = mysqli_query($mysqli, $search);
        if (mysqli_num_rows($res) > 0) {
            echo "<script>alert('username already exists!');location.href='registration.php';</script>";
        } else {
            clearStoredResults($mysqli);
            $sign = "call user_signin('$username', '$password')";//stored procedures
            $result = mysqli_query($mysqli, $sign);
            if ($result) {
                echo "<script>alert('Registered successfully!');location.href='login.php';</script>";
            } else {
                echo "<script>alert('Please re-enter your username and password。');location.href='registration.php';</script>";
            }
        }
    } else {
        echo "<script>alert('Please re-enter your username and password。');location.href='registration.php';</script>";
    }
}
 elseif ($goback){
    echo "<script>location.href='login.php';</script>";
} else{
?>
<!DOCTYPE html>
<head>
    <title>signin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/login.css" rel="stylesheet">
</head>
<body>
<div class="context">
    <div class="container">
        <h1>Registration</h1>
        <form name="signin" action="" method="post">
            <input type="text"  name="username" placeholder="Username"/>
            <input type="password"  name="password" placeholder="Password"/>
            <div align="left" style="float:left;width:15%; margin-left:175px; margin-top:20px;" >
                <input type="submit" name="goback" value="Go Back" style="width: 100px"></input>
            </div>
            <div align="right" style="float:right;width:15%; margin-right:187px; margin-top: 20px;">
                <input type="submit" name="register" value="Register" style="width: 100px"></input>
            </div>
        </form>
    </div>
</div>
</body>
</html>
    <?php
}
function clearStoredResults($mysqli){
    do {
        if ($res = $mysqli->store_result()) {
            $res->free();
        }
    } while ($mysqli->more_results() && $mysqli->next_result());
}
?>