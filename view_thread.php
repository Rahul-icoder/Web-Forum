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
        $ids = $_GET['id'];
        $showquery = "SELECT * FROM `forum_tb` WHERE `category_id` = $ids";
	    $showdata = mysqli_query($conn,$showquery);
        $row = mysqli_fetch_array($showdata);
    ?>

    <!-- Question submission -->
    <?php
        if($_SERVER["REQUEST_METHOD"]=='POST')
        {
            $title = $_POST["Title"];
            $title = str_replace("<","&lt",$title);
            $title = str_replace(">","&lt",$title);
            $desc = $_POST["Desc"];
            $desc = str_replace("<","&lt",$desc);
            $desc = str_replace(">","&gt",$desc);
            $user_sno = $_POST['sno'];
            $post_sql = "INSERT INTO `view_thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ('$title', '$desc', '$ids', '$user_sno', current_timestamp())";
            $post_result = mysqli_query($conn,$post_sql);
        }
    ?>

    <?php
        
        echo '<div class="container jumbotron my-4">
        <h1 class="display-4">Welcome to '.$row['category_list'].'</h1>
        <p class="lead">'.$row['category_desc'].'</p>
        <hr class="my-4">
        <p>No Spam , Advertising , Self-promote in the forums , Do not post copyright-infringing material , Remain respectful of other members at all times.</p>
    </div>';
    ?>
    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
        {
            echo '<div class="container">
            <h1 class="py-2">Start a Discussion</h1>
            <form action="'. $_SERVER["REQUEST_URI"].'" method="post">
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
                <div class="form-group">
                    <label for="title">Question title</label>
                    <textarea class="form-control" id="title" name="Title" rows="1"></textarea>
                </div>
                <div class="form-group">
                    <label for="desc">Description</label>
                    <textarea class="form-control" id="desc" name="Desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
        }
        else{
            echo '<div class="container">
                <h1 class="py-2">Start a Discussion</h1>
                <p class="lead">You are not logged in, please login to start a disscussion </p>
            </div>';
        }

    ?>
    
    <div class="container my-5">
        <h1>Browse Questions</h1>
        <?php
            $id = $_GET['id'];
            $limit = 2;
            if(isset($_GET['page']))
            {
                $page = $_GET['page'];

            }
            else{
                $page = 1;
            }
            $offset = ($page-1)*$limit;
            
            $sql = "SELECT * FROM `view_thread` WHERE `thread_cat_id` = $id LIMIT {$offset},{$limit}";
            $result = mysqli_query($conn,$sql);
            $ques = true;
            while($thread_row = mysqli_fetch_assoc($result))
            {
                $ques = false;
                $title = $thread_row['thread_title'];
                $description = $thread_row['thread_desc'];
                $id = $thread_row['thread_id'];
                $time = $thread_row['time'];
                $thread_user_id = $thread_row['thread_user_id'];
                $sql2 = "SELECT `First Name` FROM `users` WHERE `s.no` = '$thread_user_id'";
                $result2 = mysqli_query($conn,$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo ' <div class="media my-3">
                        <img src="img/user.jpg" class="mr-3" alt="user" height="50" width="50">
                        <div class="media-body">
                            <h5 class="mt-0"><a href="thread.php?idth='.$id.'">'.$title.'</a></h5>
                            '.$description.'
                        </div><p class="font-weight-bold my-0">'.$row2['First Name'].'</p><p class="mx-2">'.$time. '</p>
                    </div>';
                                       
            }  
            $id = $_GET['id']; 
            $sql3 = "SELECT * FROM `view_thread` WHERE `thread_cat_id` = $id";
            $result3 = mysqli_query($conn,$sql3);
            if(mysqli_num_rows($result3))
                    {
                        $id = $_GET['id'];
                        $Total_record = mysqli_num_rows($result3);
                        $total_pages = ceil($Total_record/$limit);
                        echo '<nav aria-label="Page navigation example"><ul class="pagination">';
                        if($page>1)
                        {
                            echo '<li classs="page-item"><a class="page-link" href="view_thread.php?page='.($page-1).'&id='.$id.'">Prev<li>';
                        }
                        for($i=1;$i<=$total_pages;$i++)
                        {
                            echo '<li class="page-item"><a class="page-link" href="view_thread.php?page='.$i.'&id='.$id.'">'.$i.'</li>';
                        }
                        if($page<$total_pages)
                        {
                            echo '<li class="page-item"><a class="page-link" href="view_thread.php?page='.($page+1).'&id='.$id.'">Next</li>';
                        }
                        echo '<ul></nav>';
        
                    }
            if($ques)
            {
                echo '<div class="jumbotron jumbotron-fluid">
                <div class="container">
                  <h1 class="display-4">No result found</h1>
                  <p class="lead">Be the first to ask question related to thread.</p>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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