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
    

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/slider1.jpg" class="d-block w-100" alt="coding" height="600">
            </div>
            <div class="carousel-item">
                <img src="img/slider2.jpg" class="d-block w-100" alt="coding" height="600">
            </div>
            <div class="carousel-item">
                <img src="img/slider3.jpg" class="d-block w-100" alt="coding" height="600">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class=" mx-5 my-3">
        <h2 class="text-center my-3">iDiscuss - Browse Catergories</h2>
        <div class="row my-3">
                <?php
                $sql = "SELECT * FROM `forum_tb`";
                $result = mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result))
                {
                    $cat = $row['category_list'];
                    $desc = $row['category_desc'];
                    $id = $row['category_id'];

                    echo '<div class="card mx-3 my-3" style="width: 18rem;">
                        <img src="https://source.unsplash.com/400x300/?'. $cat .',coding" class="card-img-top" alt="'.$cat.'">
                        <div class="card-body">
                            <h5 class="card-title"><a href="view_thread.php?id='.$id.'">'. $cat .'</a></h5>
                            <p class="card-text">'.substr($desc,0,90).'...</p>
                            <a href="view_thread.php?id='.$id.'" class="btn btn-primary">View Threads</a>
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