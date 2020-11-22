<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	    header("location: ../home/signin.php");
	    exit;
    }
    
    require '../include/connect_db.php';
    $key = $_GET["key"];
    if(!empty($key))
    {
        $key = '%'.strtolower($key).'%';
        $sql = "SELECT DISTINCT game_id, name FROM games NATURAL JOIN game_category WHERE lower(name) LIKE '$key' OR lower(year) LIKE '$key' OR lower(developer) LIKE '$key' OR lower(descrip) LIKE '$key' OR lower(category) LIKE '$key' ";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            while ($row = mysqli_fetch_row($res)) 
            {
                $out = "<a href='../game/index.php?game_id=$row[0]'>$row[1]</a><br>";
                echo $out;
            }
        }
        else
        {
            echo "no results<br>";
        }

        mysqli_close($conn);
    }



?>

<!DOCTYPE html>
<html>
<head>
    <title>search</title>
    <meta charset="utf-8">
    <title>Store</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
    </main>
</body>
</html>