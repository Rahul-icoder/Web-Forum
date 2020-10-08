<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IDISCUSS</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <style>
            body{
                background-color: #acb7ae;
            }
            .wrapper{
                display: flex;
                justify-content:center;
                align-items: center;
                height: 80vh;
                font-family: 'Ubuntu', sans-serif;
            }
        </style>
</head>
<body>
<?php include "partial/_header.php"; ?>


<!-- Modal -->
<?php include "partial/_loginmodal.php"; ?>
<?php include "partial/_signupmodal.php"; ?>
<?php include "partial/_dbconnect.php"; ?>
    <div class="wrapper">
    <div class="container  jumbotron">
        <h1>About us </h1>
        <p class="my-4">This forum is developed by Rahul. In this forum ,Loggedin user can independently ask question related to python , javascript , php and linux and Those  users instrested to  answer the question which also must be loggedin. This forum help user to solve the queries. User who not loggedin also see question and answer but not permission to reply. Forum uses hashing to store password which provide extra level of security. For login first to signup the user with email address. We are uprade our forum time to time.</p>
        <p><b>Future Inprovement</b> : Adding pagination to our thread and discussion , adding like button to the forum.</p>
    </div>
    </div>
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