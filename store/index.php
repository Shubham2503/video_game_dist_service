<?php
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}


require '../include/connect_db.php';
$sql = "SELECT DISTINCT category FROM game_category WHERE category not in ('New Releases') ORDER BY RAND() LIMIT 3";
$result = mysqli_query($conn, $sql);
$game_cat = array();
$cat = array();
$game_cat['New Releases'] = array();
array_push($cat, 'New Releases');
while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
    $category = $row["category"];
    $game_cat[$category] = array();
    array_push($cat, $category);
}
console_log($game_cat);


$sql = "SELECT * FROM game_category ORDER BY RAND()";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
    $game_id = $row["game_id"];
    $category = $row["category"];
    if (in_array($category, $cat)) {
        $game_cat[$category][] = $game_id;
    }
}
console_log($game_cat);


////////////////////////////////////////////////////////////////

// foreach($cat as $i)
// {
//     echo "<h2> $i </h2> ";

//     foreach($game_cat[$i] as $j)
//     echo "$j ";

// }

// HTML CONTENT FOR CATEGORY NUMBER 1 
$content = array();
foreach ($game_cat as $category => $game_list) {

    $content[$category] = "<h2>$category</h2>
  <div class='content'>";
    $count = 0;
    foreach ($game_list as $game_id) {
        if ($count == 3)
            break;
        $sql = "SELECT * FROM games where game_id = $game_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        //$out = "<a href='../game/index.php?game_id=$row[0]'>$row[1]</a><br>";
        $id = $row['game_id'];
        $name = $row['name'];
        $descrip = $row['descrip'];
        $year = $row['year'];
        $price = $row['price'];
        $dev = $row['developer'];
        $count++;
        $content[$category] .= "
    <div class='card' style='height:auto'>
    <a href='../game/index.php?game_id=$id'>
  <img class='card-img-top img-fluid' src='../image/$id/1.jpg' alt='Card image cap'>
  </a>
  <div class='card-body' style= 'padding: 9px;'>
    <h5 class='card-title' style = 'margin-bottom:0; font-size: 1rem'>$name</h5>
    <footer class='blockquote-footer'>by <cite title='Source Title'>$dev</cite></footer>
    <p class='card-text' style = 'margin-bottom:0; margin-top:10px '>$ $price</p>
    
  </div>
</div>
           ";
    }
    $content[$category] .= '</div>';
}


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Store</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="card.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">
    
    <style>
        main {
            margin-top: 74px;
        }

        .bg-dark {
            background-color: #14213D !important;
        }

        .card {
            width: 18rem;
            border: 1px solid black;
            background-color: black;
            color: white;
        }

        .card-text {
            color: #e9c46a;
        }

        body {
            background-color: black;
           
            font-family: 'Ubuntu', sans-serif;
        
        }

        .h2,
        h2 {
            font-size: 2rem;
            color: #e5e5e5;
        }

        .btn-outline-success {
            color: #FCA311;
            border-color: #FCA311;
        }

        .btn-outline-success:hover {
            background-color: #FCA311 !important;
            color: black;
            border-color: #FCA311;
        }

        input {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .form-control,
        .input-group-text {
            color: #E5E5E5;
            background-color: #1f3460;
            background-clip: padding-box;
            border: 1px solid #1f3460;
        }

        .jumbotron {
            color: white;

            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            background-size: cover;
            min-height: 450px;
        }

        .featurette-divider {
            margin: 2rem 0;
            /* Space out the Bootstrap <hr> more */
        }
    </style>
</head>


<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="../store/index.php">
            <img src="../image/logo.png" width="40" height="40" alt="home" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../store/index.php">Store <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../account/index.php">Account <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="key">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <main role="main">
        <div class="container">
            <!-- new rel -->
            <?php
            echo $content[$cat[0]];
            ?>
            <hr class="featurette-divider">
            <!-- jumbotron -->
            <a href="../game/index.php?game_id=8">
                <div class="jumbotron jumbotron-fluid" style="background-image: url('../image/8/1.jpg');">

                </div>
            </a>

            <hr class="featurette-divider">
            <?php
            echo $content[$cat[1]];
            ?>

            <hr class="featurette-divider">
            <?php
            echo $content[$cat[2]];
            ?>

            <hr class="featurette-divider">

            <a href="../game/index.php?game_id=9">
                <div class="jumbotron jumbotron-fluid" style="background-image: url('../image/9/1.jpg');">
                </div>
            </a>
            <div style="color: white;">Spider-Man: Miles Morales</div>

            <hr class="featurette-divider">
            <?php
            echo $content[$cat[3]];
            ?>

        </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>