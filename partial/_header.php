<?php

    session_start();
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">IDISCUSS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        
      </ul>';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
      {
        echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get" >
                <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        <button type="button" class="btn btn-info mx-1 ">'.$_SESSION['useremail'].'</button>
        <a href="partial/logout.php" class="btn btn-success mx-1 ">Logout</a>';
      }
      else{
        echo '<form class="form-inline my-2 my-lg-0" action="search.php" method="get" >
                <input class="form-control mr-sm-2" name="query" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
            <button type="button" class="btn btn-primary mx-2 " data-toggle="modal" data-target="#exampleModal">Login</button>
            <button type="button" class="btn btn-success mx-1 " data-toggle="modal" data-target="#exampleModal1">Signup</button>';
      }
    echo '</div>
  </nav>';
?>
