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
$sql = "SELECT DISTINCT category FROM game_category";
$result = mysqli_query($conn, $sql);
$game_cat = array();
$cat = array();
while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
    $category = $row["category"];
    $game_cat[$category] = array();
    array_push($cat, $category);
}
console_log($game_cat);


$sql = "SELECT * FROM game_category";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    // output data of each row
    $game_id = $row["game_id"];
    $category = $row["category"];

    array_push($game_cat[$category], $game_id);
}
console_log($game_cat);


////////////////////////////////////////////////////////////////

// foreach($cat as $i)
// {
//     echo "<h2> $i </h2> ";

//     foreach($game_cat[$i] as $j)
//     echo "$j ";

// }

foreach ($game_cat as $category => $game_list) {
    echo "<h2>$category</h2><br>";
    foreach ($game_list as $game_id) {
        $sql = "SELECT * FROM games where game_id = $game_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($res);
        $out = "<a href='../game/index.php?game_id=$row[0]'>$row[1]</a><br>";
        echo $out;
    }
}

?>



<!doctype html>
<html lang="en">

<head>
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