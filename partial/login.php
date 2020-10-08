<?php
    $showError = "Please check Username and Password";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include "_dbconnect.php";
        $user = $_POST['username'];
        $password = $_POST['pass'];

        $sql = "select * from `users` where `email` =  '$user'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num == 1)
        {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password,$row['password']))
            {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $user;
                $_SESSION['sno'] = $row['s.no'];
                header("Location: /forum/index.php");
                exit();
            }
            else
            {
                $showError = "Incorrect Password";
            }
        }
        header("Location: /forum/index.php?loginsuccess=false&error=$showError");
    }
?>