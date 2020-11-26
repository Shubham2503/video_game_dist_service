<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: home.php");
  exit;
}

//DBMS CONNECTION////////
 require "../include/connect_db.php";
///////////////////////

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $password = $email =  "";
  $username_err = $password_err = $email_err = $age_err = "";
  $fname = $lname = "";

  $username = trim($_POST["username"]);
  $sql = "SELECT userid FROM users WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) > 0) 
  {
    $username_err = "This username already taken";
    echo "<script>alert('$username_err')</script>";;
  } 
  else 
  {
    $username = trim($_POST["username"]);
  }

  if (empty($username_err) && strlen(trim($_POST["password"])) < 8) 
  {
    $password_err = "Password must have atleast 8 characters";
    echo "<script>alert('$password_err')</script>";
  } 
  else 
  {
    $password = trim($_POST["password"]);
    if (trim($_POST["cpassword"]) != $password) 
    {
      $password_err = "passwords does not match.";
      echo "<script>alert('$password_err')</script>";
    }
  }

  $email = $_POST["email"];
  $sql = "SELECT userid FROM users WHERE email = '$email' ";
  $res = mysqli_query($conn, $sql);
  if (empty($username_err) && empty($password_err) && mysqli_num_rows($res) > 0) 
  {
    $email_err = "email already in database";
    echo "<script>alert('$email_err')</script>";
  }

  $age = date_diff(date_create($_POST["date"]), date_create('today'))->y;
  if ($age < 16) {
    //change this
    $age_err = "you must be at least 16 years old to make register";
    echo "<script>alert('$age_err')</script>";
  }

  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $sql = "INSERT into users (username, password, email, age, fname, lname) values('$username', '$password', '$email', '$age', '$fname', '$lname')";
  if (empty($username_err) && empty($password_err) && empty($email_err) && empty($age_err) && mysqli_query($conn, $sql)) 
  {
    
    // SENDING REGISTRATION MAIL ....................
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
    $mail->setFrom(EMAIL, "game store");///change acc
    $mail->addReplyTo(EMAIL, "game store");
    $mail->addAddress($email, ' '); 

    $mail->Subject = "REGISTRATIO TO GAMES HAS BEEN DONE...";//add game name here
    $mail->isHTML(true);
    $mailContent = "testmail";
    $mail->Body = $mailContent;
    if($mail->send()){
      echo 'Message has been sent';
    }else{
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    //
    //
    header("location: signin.php");
    exit;
  } 

  mysqli_close($conn);



}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;500&display=swap" rel="stylesheet">
  <style>
    body{
        background:  radial-gradient(#40404b, #111118) rgba(34,34,40,0.94);
        font-family: 'Ubuntu',sans-serif;
      }
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

  <link href="register.css" rel="stylesheet">
</head>

<body class="text-center">

  <form class="form-register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <img class="mb-4" src="../image/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal" style="color:white;">Register</h1>

    <label for="inputfname" class="sr-only">First Name</label>
    <input type="text" id="inputfname" class="form-control" placeholder="First Name" required autofocus name="fname">

    <label for="inputlname" class="sr-only">Last Name</label>
    <input type="text" id="inputlname" class="form-control" placeholder="Last Name" required autofocus name="lname">

    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">

    <label for="inputusername" class="sr-only">Username</label>
    <input type="text" id="inputUname" class="form-control" placeholder="Username" required autofocus name="username">

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">

    <label for="inputPassword" class="sr-only">Confirm Password</label>
    <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required name="cpassword">

    <label for="inputEmail" class="sr-only">Date of Birth</label>
    <input type="date" id="inputDOB" class="form-control" placeholder="Date of Birth" required autofocus name="date">


    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <a href="signin.php" class="btn btn-lg btn-outline-warning btn-block" type="button">Sign in</a>
  </form>

</body>

</html>
