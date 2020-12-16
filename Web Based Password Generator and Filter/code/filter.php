<?php include('session.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Filter Data</title>
    
    <link rel="stylesheet" href="css/table-style.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>
    <span class="button" id="toggle-login"><a href="logout.php">Logout</a></span>
    <div id="login">
        <div id="triangle"></div>
        <h1>Master Filter Data</h1>
        <form action="#" method="POST">
            <input type="text" id="find" name="find" placeholder="Find Record" required/>
            Title <input type="checkbox" id="title" name="title"/>
            Name <input type="checkbox" id="name" name="name"/>
            URL <input type="checkbox" id="url" name="url"/>

            <button class="btn_passgen">Filter</button>
        </form>
    </div>

    <br>

    <table id="customers">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Name</th>
            <th scope="col">Password md5 hash</th>
            <th scope="col">URL</th>
            </tr>
        </thead>

        <tbody>

    <?php
        require_once "config.php";

        if(isset($_POST['find'])){
        $find = $_POST['find'];
        $query = "";

        if(isset($_POST['title'])){
            $query = "SELECT * FROM `storage` WHERE title LIKE '%$find%'";
        }
        else if(isset($_POST['name'])){
            $query = "SELECT * FROM `storage` WHERE f_name LIKE '%$find%'";
        }
        else if(isset($_POST['url'])){
            $query = "SELECT * FROM `storage` WHERE f_url LIKE '%$find%'";
        }
        else if(isset($_POST['title']) && isset($_POST['name'])){
            $query = "SELECT * FROM `storage` WHERE title LIKE '%$find%' and f_name LIKE '%$find%'";
        }
        else if(isset($_POST['title']) && isset($_POST['url'])){
            $query = "SELECT * FROM `storage` WHERE title LIKE '%$find%' and f_url LIKE '%$find%'";
        }
        else if(isset($_POST['name']) && isset($_POST['url'])){
            $query = "SELECT * FROM `storage` WHERE f_name LIKE '%$find%' and f_url LIKE '%$find%'";
        }
        else if(isset($_POST['title']) && isset($_POST['name']) && isset($_POST['url'])){
            $query = "SELECT * FROM `storage` WHERE title LIKE '%$find%' and f_name LIKE '%$find%' and f_url LIKE '%$find%'";
        }
        else{
            $query = "SELECT * FROM `storage` WHERE title LIKE '%$find%' or f_name LIKE '%$find%' or f_url LIKE '%$find%'";
        }

        $result = mysqli_query($link,$query);
        $row = mysqli_num_rows($result);
        if($row >=1 ){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".$row['id']."</td><td>".$row['title']."</td><td>".$row['f_name']."</td><td>".md5($row['password'])."</td><td>".$row['f_url']."</td></tr>";
        }
        }
        }
        else{
            echo "<script>alert('Enter Details to Search')<script>";
        }
    ?>

        </tbody>
    </table>

</body>

</html>