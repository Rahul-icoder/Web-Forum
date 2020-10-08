<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "forum";
    
    $conn = mysqli_connect($servername,$username,$password,$database);
    if(!$conn)
    {
        die("connection not successful with error".mysqli_connect_error());
    }
?>