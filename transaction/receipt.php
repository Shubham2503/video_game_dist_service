<?php
$userid = $_POST["userid"];
$game_id = $_POST["game_id"];
// $email = $_POST["email"];
$email = $_POST["email"];
$card_no = $_POST["card_no"];
$error = "";

//debug////////
// echo $userid.$game_id.$email.$card_no;
////

//delete later////////
require "../include/connect_db.php";
///////////////////////

//debug database
$sql = "SELECT * FROM user_games WHERE userid = '$userid' and game_id = '$game_id'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    $error = "user already owns game";
    die("something went wrong");
    echo $error;
}

if (empty($error)) {

    $result;
    $sql = "INSERT INTO user_games (userid, game_id, card_no) VALUES ('$userid', '$game_id', '$card_no')";
    if (mysqli_query($conn, $sql)) {
        $result =  "transaction successfull <br> Enjoy your game, have a wonderful journy.";
    } else {
        $result =  "transaction error <br> Deducted money will be refunded within 2-4 working buisness days.";
    }
    require '../phpMailer/PHPMailerAutoload.php';
    require '../phpMailer/credentials.php';
    // use PHPMailer\PHPMailer\PHPMailer;
    $mail = new PHPMailer();
    // $mail->SMTPDebug = 4;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = EMAIL;
    $mail->Password = PASS;
    $mail->setFrom(EMAIL, "game store"); ///change acc
    $mail->addReplyTo(EMAIL, "game store");
    $mail->addAddress($email, ' ');

    $mail->Subject = "GAME PURCHASE HAS BEEN DONE .. "; //add game name here
    $mail->isHTML(true);
    $mailContent = "testmail";
    $mail->Body = $mailContent;
    if ($mail->send()) {
        //echo 'Message has been sent';
    } else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Receipt</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">
    
    <link href="receipt.css" rel="stylesheet">
    <style>
        
        body {
            background: radial-gradient(#000, #000) rgba(34, 34, 40, 0.94);
            color: white;
            font-family: 'Ubuntu',sans-serif;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="result-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Receipt</h1>
            <p class="lead"><?php echo $result; ?></p>
            <form action="../store/index.php"><button class="btn btn-outline-warning btn-lg btn-block" type="submit">Return To Store</button></form>
        </div>
    </div>
</body>

</html>