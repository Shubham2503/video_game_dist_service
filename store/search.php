<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../home/signin.php");
    exit;
}

require '../include/connect_db.php';
$key = $_GET["key"];
if (!empty($key)) {
    $key = '%' . strtolower($key) . '%';
    $sql = "SELECT DISTINCT game_id, name,descrip,year,price,developer FROM games NATURAL JOIN game_category WHERE lower(name) LIKE '$key' OR lower(year) LIKE '$key' OR lower(developer) LIKE '$key' OR lower(descrip) LIKE '$key' OR lower(category) LIKE '$key' ";
    $res = mysqli_query($conn, $sql);
    $content = "<h2>$category</h2>
  <div class='content'>";
    $count = 0;
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {

            if ($count == 3) {
                $content .= "</div><div class='content'>";
                $count = 0;
            }
            //$out = "<a href='../game/index.php?game_id=$row[0]'>$row[1]</a><br>";
            // echo $out;
            $id = $row['game_id'];
            $name = $row['name'];
            $descrip = $row['descrip'];
            $year = $row['year'];
            $price = $row['price'];
            $dev = $row['developer'];

            $content .= "
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
            $count++;
        }
    } else {
        echo "no results<br>";
    }
    $content .= '</div>';

    mysqli_close($conn);
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>search</title>
    <!-- <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .bg-dark {
            background-color: #14213D !important;
        }

        body {
            background-color: black;
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

        
        .card{
            width: 18rem;
            border: 1px solid black;
            background-color: black;
            color: white;
        }

        .card-text {
            color: #e9c46a;
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
        <?php echo $content ?>
    </main>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>