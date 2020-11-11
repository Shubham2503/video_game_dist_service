<?php 
    require '../include/connect_db.php';



    //              SETTING VARIABLES.............
    if(isset($_COOKIE))
    {
      // $userid = $_COOKIE['userid'];
    }

    $userid = 1;
     
    // if($_SERVER["REQUEST_METHOD"] == "POST")
    if(1)
    {
        // $game_id = $_POST['game_id'];
        $game_id = 1;
        $sql = "SELECT name,price, year,descrip FROM games WHERE game_id = 1";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
              $descrip = $row["descrip"];
              $name = $row["name"];
              $price = $row['price'];
              $year = $row['year'];
            
          } 
          else
          {
            echo "Something went wrong!!!";
          }
    }
    $image = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/1.jpg' ";
    $image2 = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/2.jpg' ";
    $image3 = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/3.jpg' ";
    $gif1 = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/g1.gif' ";



    //                         BUTTON FEATURES ......................
    $btn_setter = "";
    $sql = "SELECT userid FROM user_games WHERE game_id = $game_id and userid = $userid";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) >= 1) 
     $btn_setter = "disabled";

    mysqli_close($conn);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Game</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <link href="carousel.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

      <a class="navbar-brand" href="#">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </header>


  <main role="main">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner">
      <div class="carousel-item active">
            <?php 
              echo "$image";
            ?><svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
        </div>
      </div>

      <div class="carousel-item">
        <?php 
            echo "$image2";
        ?><svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
        </div>
      </div>
      <div class="carousel-item">
        <?php 
            echo "$image3";
        ?>
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>



  <div class="container marketing">
    <!-- game name -->
    <div class="row justify-content-md-center">
      <div class="col-lg-4">
        <h2><?php echo "$name"; ?></h2>
        <!-- <p><?php //echo "$descrip"; ?></p>
        <p>Price : <?php //echo "$price"; ?></p>
        <p>Release : <?php //echo "$year"; ?></p> -->
      </div>
    </div><!-- /.row -->

        <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5">
        <?php 
            echo "$gif1";
        ?>
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em"></text></svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5 order-md-1">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text></svg>
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->
    <!-- /////////////////button here//// -->
    <form method="POST" action="../transaction/index.php">
      <button <?php echo $btn_setter  ?> class="btn btn-lg btn-primary" name="game_id" value="<?php echo $game_id; ?>">
            
      <?php
        if($btn_setter == "disabled")
        echo "Already Owned";
        else
        echo "BUY NOW";
      ?>
      </button>
    </form>
  <div>
    <!-- FOOTER -->
    <footer class="container">
      <p class="float-right"><a href="#">Back to top</a></p>
      <p>&copy; 2017-2020 Company, Inc.</p>
    </footer>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

</html>
