<?php include('session.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome Master</title>
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
</head>

<body>
    <span class="button" id="toggle-login"><a href="logout.php">Logout</a></span>
    <div id="login">
        <div id="triangle"></div>
        <h1>Web Based Password Generator</h1>
        <form action="#" method="POST">
            <input type="text" name="title" placeholder="Title" required/>
            <input type="text" name="f_name" placeholder="Name" required/>
            <input type="password" name="password1" id="password1" placeholder="Password" oninput="checkPass_Quality();" required/>
            <input type="password" name="password2" id="password2" placeholder="Re-Password" oninput="checkPass12();" required/>
            <input type="range" id="quality" value="0" max="10" name="quality" placeholder="Re-Password" required/>
            <p id="pass_quality">-</p>
            <div id="password_check"></div>
            <button id="gene_pass" class="btn_passgen" onclick="Generate_Pass()">Password Generator</button>
            <p id="generated_password">-</p>
            <input type="url" placeholder="URL" id="url" name="url" required/>
            <input type="submit" name="submit" value="Save Information" />
            <br><hr>
            <center><a href="filter.php">Filter Records</a></center>
        </form>
    </div>

    <script>
    function checkPass12(){
        var pass1 = document.getElementById("password1").value;
        var pass2 = document.getElementById("password2").value;

        if(pass1 == pass2){
        document.getElementById("password_check").innerHTML = "Password Matched";
        document.getElementById("myBtn").disabled = false;
        }
        else{
        document.getElementById("password_check").innerHTML = "Password 1 and Password 2 are Different";
        document.getElementById("myBtn").disabled = true;
        }
    }

    function checkPass_Quality(){
        var pass = document.getElementById("password1").value;
        var pass_len = pass.length;
        document.getElementById("quality").value = pass_len;

        if(pass_len >= 1 && pass_len <= 5){
        document.getElementById("pass_quality").innerHTML = "Poor";
        }
        else if(pass_len >= 6 && pass_len <= 8){
        document.getElementById("pass_quality").innerHTML = "Strong";
        }
        else if(pass_len >= 9){
        document.getElementById("pass_quality").innerHTML = "Very Strong";
        }
        else{
        document.getElementById("pass_quality").innerHTML = "-";
        }

        checkPass12();
    }

    function Generate_Pass(){
        var length = 10,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementById("generated_password").innerHTML = retVal;
        document.getElementById("password1").value = retVal;
        document.getElementById("password2").value = retVal;
        document.getElementById("quality").value = length;
        document.getElementById("pass_quality").innerHTML = "Very Strong";

        document.getElementById("password_check").innerHTML = "Password Generated & Set to Input";
    }
    </script>

    <?php
        require_once "config.php";

        if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $name = $_POST['f_name'];
        $pass = $_POST['password1'];
        $url = $_POST['url'];

        $query = "INSERT INTO `storage`(`title`, `f_name`, `password`, `f_url`) VALUES ('$title', '$name', '".md5($pass)."', '$url')";
        //$query = "INSERT INTO `storage`(`title`, `name`, `password`, `url`) VALUES ('abcd', 'szc', '".md5(sasd)."', 'sadasd')";
        $result = mysqli_query($link,$query);
        if($result){
            echo "<script>alert('Data Added Successfully')</script>";
        }
        else{
            echo "<script>alert('Data Failed to Store')</script>";
        }
        }
    ?>

</body>

</html>