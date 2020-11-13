<?php  
    $userid = $_POST["userid"];
    $game_id = $_POST["game_id"];
    // $email = $_POST["email"];
    $email = 'ismailparsola@gmail.com';
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

    require 'PHPMailerAutoload.php';
    require 'credentials.php';
    // use PHPMailer\PHPMailer\PHPMailer;
    $mail = new PHPMailer();
    $mail->SMTPDebug = 4;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->Username = EMAIL; 
	$mail->Password = PASS;
	$mail->setFrom(EMAIL, "game store");///change acc
	$mail->addReplyTo(EMAIL, "game store");
	$mail->addAddress($email, ' '); 

	$mail->Subject = "GAME PURCHASE HAS BEEN DONE .. ";//add game name here
	$mail->isHTML(true);
	$mailContent = "testmail";
	$mail->Body = $mailContent;
	if($mail->send()){
		echo 'Message has been sent';
	}else{
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
?>