<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>IDISCUSS</title>
</head>
<style>
    .search_result{
        height: 80vh;
    }
    h1{
        text-align:center;
    }
    .footer{
        position: absolute;
        bottom: 0px;
    }
</style>
<body>
<?php include "partial/_header.php"; ?>


<!-- Modal -->
<?php include "partial/_loginmodal.php"; ?>
<?php include "partial/_signupmodal.php"; ?>
<?php include "partial/_dbconnect.php"; ?>
<div class="search_result container my-4">
    <h1>Seach results for "<?php echo $_GET["query"]?>"</h1>
    <?php 
        $search_alert = true;
        $search = $_GET["query"];
        $query = "SELECT * FROM `view_thread` WHERE MATCH (`thread_title`,`thread_desc`) against ('$search')";
        $result = mysqli_query($conn,$query);
        while($thread_row = mysqli_fetch_assoc($result))
        {
            $search_alert = false;
            $title = $thread_row['thread_title'];
            $description = $thread_row['thread_desc'];
            $id = $thread_row['thread_id'];
            $user_id = $thread_row['thread_user_id'];
            $sql2 = "SELECT `First Name` FROM `users` WHERE `s.no` = '$user_id'";
            $result2 = mysqli_query($conn,$sql2);
            $time = $thread_row['time'];
            $row2 = mysqli_fetch_assoc($result2);
            echo ' <div class="media my-3">
                    <img src="img/user.jpg" class="mr-3" alt="user" height="50" width="50">
                    <div class="media-body">
                        <h5 class="mt-0"><a href="thread.php?idth='.$id.'">'.$title.'</a></h5>
                        '.$description.'
                    </div><p class="font-weight-bold my-0">'.$row2['First Name'].'</p><p class="mx-2">'.$time. '</p>
                </div>';
        }
        if($search_alert)
            {
                echo '<div class="jumbotron jumbotron-fluid my-3">
                <div class="container">
                  <h1 class="display-4">Search result not found</h1>
                </div>
              </div>';
            }
    ?>
    </div>
</div>


<?php
        include "partial/footer.php";

    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>
</html>