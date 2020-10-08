<?php
    $showError = "false";

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include "_dbconnect.php";
        $user_email = $_POST['username'];
        $password = $_POST['pass'];
        $cpassword = $_POST['cpass'];
        $fname = $_POST['fname'];

        $sql_user = "SELECT * FROM `users` WHERE `email` = '$user_email'";
        $result_user = mysqli_query($conn,$sql_user);
        $num = mysqli_num_rows($result_user);
        if($num>0)
        {
            $showError = "Email already in use";
        }
        else
        {
            if($password == $cpassword)
            {
                $hash = password_hash($password,PASSWORD_DEFAULT);
                
                $sql = "INSERT INTO `users` (`First Name`, `email`, `password`, `time`) VALUES ('$fname', '$user_email', '$hash', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                echo $result;
                if($result)
                {
                    echo $result;
                    $showAlert = true;
                    header("Location: /forum/index.php?singupsuccess=true");
                    exit();
                }

            }
            else{
                $showError = "Password do not match";
                
            }
        }

        header("Location: /forum/index.php?singupsuccess=false&error=$showError");
    }

?>