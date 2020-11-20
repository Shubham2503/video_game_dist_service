<?php
require '../include/connect_db.php';



//              SETTING VARIABLES.............
if (isset($_COOKIE)) {
    $userid = $_COOKIE['userid'];
}


// if($_SERVER["REQUEST_METHOD"] == "POST")
if (1) {
    if(!isset($_GET['game_id']))
    header('location: ../store/index.php');
    $game_id = $_GET['game_id'];

    $sql = "SELECT * FROM games WHERE game_id = $game_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
        $descrip = $row["descrip"];
        $descrip2 = $row["descrip2"];
        $descrip3 = $row["descrip3"];
        $name = $row["name"];
        $price = $row['price'];
        $year = $row['year'];
        $developer = $row['developer'];
    } else {
        echo "Something went wrong!!!";
    }
}
$image = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/1.jpg'>";
$image2 = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/2.jpg'> ";
$image3 = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/3.jpg'> ";
$image4 = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/4.jpg'> ";
$image5 = "<img class='bd-placeholder-img' width='100%' height='100%' src='../image/$game_id/5.jpg'> ";



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
    <link href="style1.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

            <a class="navbar-brand" href="../store/index.php">Home</a>
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
                    ?><svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#777" /></svg>

                    <div class="container">
                        <div class="carousel-caption text-left">
                            <h1><?php echo "$name"; ?></h1>
                            <p><?php echo "$descrip"; ?></p>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <?php
                    echo "$image2";
                    ?><svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#777" /></svg>
                    <div class="container">
                        <div class="carousel-caption">
                            <p><?php echo "$descrip2"; ?></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <?php
                    echo "$image3";
                    ?>
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#777" /></svg>
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <p><?php echo "$descrip3"; ?></p>
                        </div>
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

            <div class="row">

                <div class="col-lg-4">
                    <h2><?php echo "$name"; ?></h2>
                    <p>
                        <!-- /////////////////button here//// -->
                        <form method="POST" action="../transaction/index.php">
                            <button <?php echo $btn_setter  ?> class="btn btn-lg btn-primary" name="game_id" value="<?php echo $game_id; ?>">

                                <?php
                                if ($btn_setter == "disabled")
                                    echo "Already Owned";
                                else
                                    echo "BUY NOW";
                                ?>
                            </button>
                        </form>
                    </p>
                </div>

                <div class="col-lg-8">
                    <table style="width:100%" id='tab'>
                        <tr>
                            <th>Developer</th>
                            <th>Published</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td><?php echo "$developer"; ?></td>
                            <td><?php echo "$year"; ?></td>
                            <td><?php echo "$price"; ?></td>
                        </tr>
                    </table>
                    <hr>
                    <table style="width:100%;" id='tab'>
                        <tr>
                            <th>Description</th>
                        </tr>
                        <tr style="text-align: left;">
                            <td><?php echo "$descrip"; ?></td>
                        </tr>
                        <tr style="text-align: left;">
                            <td><?php echo "$descrip2"; ?></td>
                        </tr>
                        <tr style="text-align: left;">
                            <td><?php echo "$descrip3"; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12" style="position: relative;">
                    <div class="row" style="margin-bottom: -20px;">
                        <div class="col-md-6">
                            <?php echo $image; ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $image2; ?>
                        </div>
                    </div>
                    <p style="width:100%;padding:0px;" class="col-lg-12">
                        <button style="width:100%;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Show More &#11206;
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <div class="row">

                                <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="col">
                                        <?php echo $image3; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php echo $image4; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php echo $image5; ?>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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