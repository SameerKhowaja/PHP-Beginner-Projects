<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>

<body>
    <span href="#" class="button" id="toggle-login">Login Form</span>
    <div id="login">
        <div id="triangle"></div>
        <h1>Master Login Here</h1>
        <form action="#" method="POST">
            <input type="password" name="password" placeholder="Password" required/>
            <input type="submit" value="Log in" />
        </form>
    </div>

    <?php
        require_once "config.php";

        if(isset($_POST['password'])){
            session_start();
            $pass = $_POST['password'];
            $query = "SELECT * FROM `master` WHERE password='$pass' Limit 1";
            $result = mysqli_query($link, $query);
            $row = mysqli_num_rows($result);
            if($row >= 1){
                $_SESSION['id']="1";
                header("location: welcome.php");
            }
            else{
                echo "<h3 align='center'>Invalid Password</h3>";
            }
        }
    ?>

</body>

</html>