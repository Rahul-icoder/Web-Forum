 

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>IDISCUSS</title>
</head>

<body>
    <?php include "partial/_header.php"; ?>


    <!-- Modal -->
    <?php include "partial/_loginmodal.php"; ?>
    <?php include "partial/_signupmodal.php"; ?>
    <?php include "partial/_dbconnect.php"; ?>
    <?php
        $ids = $_GET['idth'];
        $showquery = "SELECT * FROM `view_thread` WHERE `thread_id` = $ids";
	    $showdata = mysqli_query($conn,$showquery);
	    $row = mysqli_fetch_array($showdata);
    ?>

    <!-- Answer for backend -->
 <?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        include "partial/_dbconnect.php";
        $comment = $_POST['Comment'];
        $comment = str_replace("<","&lt",$comment);
        $comment = str_replace(">","&gt",$comment);
        $user_sno = $_POST['sno'];
        
        $sql = "INSERT INTO `thread_comment` (`content`, `thread_id`, `time`, `comment_by`) VALUES ('$comment', '$ids', current_timestamp(), '$user_sno')";
        $result = mysqli_query($conn,$sql);
    }

 ?>

    <?php
        $id = $_GET['idth'];
        $sql = "SELECT * FROM `view_thread` WHERE `thread_id` = $id";
        $result = mysqli_query($conn,$sql);
        while($thread_row = mysqli_fetch_assoc($result))
        {
            $user = $thread_row['thread_user_id'];
            $sql2 = "SELECT `First Name` FROM `users` WHERE `s.no` = '$user'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
        echo '<div class="container jumbotron my-4">
        <h2>'.$row['thread_title'].'</h2>
        <p class="lead">'.$row['thread_desc'].'</p>
        <hr class="my-4">
        <p>Posted by <b>'.$row2['First Name'].'</b></p>
    </div>';
        }
    ?>

    <!-- comment submission -->

    <div class="container">
    <h1 class="py-2">Answer the Query</h1>
       <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
            {
                echo ' <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                        <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                        <div class="form-group">
                            <label for="comment">Comment Your Answer</label>
                            <textarea class="form-control" id="comment" name="Comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                     </form>';
            }
            else{
                echo '
                      <p class="lead">You are not logged in, please login to start a disscussion </p>
                      ';
            }
        ?>
    </div>
    <div class="container my-5">
        <h1>Discussion</h1>
        <?php
            $id = $_GET['idth'];
            $limit=2;
            if(isset($_GET['page']))
            {
                $page = $_GET['page'];
            }
            else{
                $page = 1;
            }
            $offset = ($page-1)*$limit;
            $sql = "SELECT * FROM `thread_comment` WHERE `thread_id` = $id LIMIT {$offset},{$limit}";
            $result = mysqli_query($conn,$sql);
            $ques = true;
            while($thread_row = mysqli_fetch_assoc($result))
            {
                $ques = false;
                $content = $thread_row['content'];
                $date = $thread_row['time'];
                $comment_by = $thread_row['comment_by'];
                $sql2 = "SELECT `First Name` FROM `users` WHERE `s.no` = '$comment_by'";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo ' <div class="media my-3">
                        <img src="img/user.jpg" class="mr-3" alt="user" height="50" width="50">
                        <div class="media-body">
                        <p class="font-weight-bold my-0">'.$row2['First Name'].' at '.$date. '</p>
                            '.$content.'
                        </div>
                    </div>';
            }
            $sql3 = "select * from thread_comment where thread_id = $id";
            $result3 = mysqli_query($conn,$sql3);
            if(mysqli_num_rows($result3))
            {
                $id = $_GET['idth'];
                $Total_record = mysqli_num_rows($result3);
                $total_pages = ceil($Total_record/$limit);
                echo '<nav aria-label="Page navigation example"><ul class="pagination">';
                        if($page>1)
                        {
                            echo '<li classs="page-item"><a class="page-link" href="view_thread.php?page='.($page-1).'&idth='.$id.'">Prev<li>';
                        }
                        for($i=1;$i<=$total_pages;$i++)
                        {
                            echo '<li class="page-item"><a class="page-link" href="view_thread.php?page='.$i.'&idth='.$id.'">'.$i.'</li>';
                        }
                        if($page<$total_pages)
                        {
                            echo '<li class="page-item"><a class="page-link" href="view_thread.php?page='.($page+1).'&idth='.$id.'">Next</li>';
                        }
                        echo '<ul></nav>';
        
            }
            if($ques)
            {
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No result found</h1>
                  <p class="lead">Be the first to comment answer related to thread.</p>
                </div>
              </div>';
            }
        ?>

        
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