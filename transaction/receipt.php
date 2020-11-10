<?php  
    $userid = $_POST["userid"];
    $game_id = $_POST["game_id"];
    $email = $_POST["email"];
    $card_no = $_POST["card_no"];
    $error = "";

    //debug////////
    // echo $userid.$game_id.$email.$card_no;
    ////

    //delete later////////
    $severname = "localhost";
    $username = "root";
    $pwd = "";
    $dbname = "gamedb";
    $conn = new mysqli($severname, $username, $pwd, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }
    ///////////////////////

    //debug database
    $sql = "SELECT * FROM user_games WHERE userid = '$userid' and game_id = '$game_id'";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0)
    {
        $error = "user already owns game";
        echo "something went wrong";
        echo $error;
    }

    if(empty($error))
    {
        
        $sql = "INSERT INTO user_games (userid, game_id, card_no) VALUES ('$userid', '$game_id', '$card_no')";
        if(mysqli_query($conn, $sql))
        {
            echo "transaction successfull";
        }
        else
            echo "transaction err";
    }
?>