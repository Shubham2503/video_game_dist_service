<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: signin.php");
        exit;
    }

    $userid = $_COOKIE["userid"];
    $game_id = $_POST["game_id"];

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


    $fname = $lname = $username = $email = $game_name = $game_price = "";

    $sql = "SELECT * FROM users WHERE userid = '$userid'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    $fname = $row["fname"];
    $lname = $row["lname"];
    $username = $row["username"];
    $email = $row["email"];

    $sql = "SELECT * FROM games WHERE game_id = '$game_id'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);

    $game_name = $row["name"];
    $game_price = $row["price"];

    //debug
    echo $fname.$lname.$username.$email.$game_name.$game_price;
?>