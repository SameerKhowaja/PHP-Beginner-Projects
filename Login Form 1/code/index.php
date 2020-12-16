<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login Form</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto');
        body {
            background-color: #718fbf;
        }
        
        .signup-form {
            font-family: "Roboto", sans-serif;
            width: 650px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
        }
        /*---------------------------------------*/
        /* Form Header */
        /*---------------------------------------*/
        
        .form-header {
            background-color: #EFF0F1;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        
        .form-header h1 {
            font-size: 30px;
            text-align: center;
            color: #666;
            padding: 20px 0;
            border-bottom: 1px solid #cccccc;
        }
        /*---------------------------------------*/
        /* Form Body */
        /*---------------------------------------*/
        
        .form-body {
            padding: 10px 40px;
            color: #666;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-body .label-title {
            color: #1BBA93;
            font-size: 17px;
            font-weight: bold;
        }
        
        .form-body .form-input {
            font-size: 17px;
            box-sizing: border-box;
            width: 100%;
            height: 34px;
            padding-left: 10px;
            padding-right: 10px;
            color: #333333;
            text-align: left;
            border: 1px solid #d6d6d6;
            border-radius: 4px;
            background: white;
            outline: none;
        }
        
        .horizontal-group .left {
            float: left;
            width: 49%;
        }
        
        .horizontal-group .right {
            float: right;
            width: 49%;
        }
        
        input[type="file"] {
            outline: none;
            cursor: pointer;
            font-size: 17px;
        }
        
        #range-label {
            width: 15%;
            padding: 5px;
            background-color: #1BBA93;
            color: white;
            border-radius: 5px;
            font-size: 17px;
            position: relative;
            top: -8px;
        }
        /*---------------------------------------*/
        /* Form Footer */
        /*---------------------------------------*/
        
        .signup-form .form-footer {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 10px 40px;
            text-align: right;
            border-top: 1px solid #cccccc;
            clear: both;
        }
        
        .form-footer span {
            float: left;
            margin-top: 10px;
            color: #999;
            font-style: italic;
            font-weight: thin;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1BBA93;
            font-size: 17px;
            border: none;
            border-radius: 5px;
            color: #bcf5e7;
            cursor: pointer;
        }
        
        .btn:hover {
            color: white;
        }
    </style>
</head>

<body>
    <form class="signup-form" action="#" method="GET">

        <!-- form header -->
        <div class="form-header">
            <h1>Login Form</h1>
        </div>

        <!-- form body -->
        <div class="form-body">

            <!-- Firstname and Lastname -->
            <div class="horizontal-group">
                <div class="form-group left">
                    <label for="username" class="label-title">Username</label>
                    <input type="text" id="username" name="username" class="form-input" placeholder="Your username" required />
                </div>
                <div class="form-group right">
                    <label for="password" class="label-title">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Your password" required />
                </div>
            </div>

            <!-- form-footer -->
            <div class="form-footer">
                <button name="submit" type="submit" class="btn">Login</button>
            </div>

    </form>

<?php
    include('dbcon.php');

    if (isset($_GET['submit'])){
        $username = $_GET['username'];
        $password = $_GET['password'];

        $query = "SELECT * FROM `login_table` WHERE `username`='$username' AND `password`='$password'";
        $result = mysqli_query($conn,$query)or die(mysqli_error());
        $num_row = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        if( $num_row > 0 ){
            ?>
            <div class="alert alert-success">Access OK</div>
            <br>
            <div class="form-header">
                <h1>Table Data</h1>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query2 = "SELECT `id`, `username`, `password` FROM `login_table`";
                $result2 = mysqli_query($conn, $query2);

                if(mysqli_num_rows($result2) > 0){
                    while($row = mysqli_fetch_assoc($result2)) {
                        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["password"]. "</td></tr>";
                    }
                }

                ?>
                </tbody>
            </table>
            
            <form action="logout.php" method="POST">
                <div class="form-footer">
                    <button name="logout" type="submit" class="btn btn-danger">Logout</button>
                </div>
            </form>

            <?php
        }
        else{
            ?>
            <div class="alert alert-danger">Access Denied</div>
            <?php
        }
    }
    
?>

</body>

</html>