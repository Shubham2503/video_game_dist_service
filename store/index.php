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
    while ( $row = mysqli_fetch_assoc($result)) {
        // output data of each row
        $category = $row["category"];
        $game_cat[$category] = array();
        array_push($cat,$category);
    }
    console_log($game_cat);


    $sql = "SELECT * FROM game_category";
    $result = mysqli_query($conn, $sql);

    while ( $row = mysqli_fetch_assoc($result)) {
        // output data of each row
        $game_id = $row["game_id"];
        $category = $row["category"];

        array_push($game_cat[$category],$game_id);
    }
    console_log($game_cat);


    ////////////////////////////////////////////////////////////////

    // foreach($cat as $i)
    // {
    //     echo "<h2> $i </h2> ";

    //     foreach($game_cat[$i] as $j)
    //     echo "$j ";

    // }

    foreach($game_cat as $category => $game_list)
    {
        echo "<h2>$category</h2><br>";
        foreach($game_list as $game_id)
        {
            $sql = "SELECT * FROM games where game_id = $game_id";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($res); 
            $out = "<a href='../game/index.php?game_id=$row[0]'>$row[1]</a><br>";
            echo $out;
        }
    }
?>