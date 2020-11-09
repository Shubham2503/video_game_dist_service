<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: home.php");
  exit;
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $password = $email =  "";
  $username_err = $password_err = $email_err = $age_err = "";
  $fname = $lname = "";

  $username = trim($_POST["username"]);
  $sql = "SELECT userid FROM users WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) > 0) {
    //change this/////////
    $username_err = "This username already taken.<br>";
    echo $username_err;
  } else {
    $username = trim($_POST["username"]);
  }

  if (strlen(trim($_POST["password"])) < 8) {
    ///////////change this
    $password_err = "Password must have atleast 8 characters.<br>";
    echo $password_err;
  } else {
    $password = trim($_POST["password"]);
    if (trim($_POST["cpassword"]) != $password) {
      //change this/////////////
      $password_err = "passwords does not match.";
      echo $password_err;
    }
  }

  $email = $_POST["email"];
  $sql = "SELECT userid FROM users WHERE email = '$email' ";
  $res = mysqli_query($conn, $sql);
  if (mysqli_num_rows($res) > 0) {
    //change this/////////
    $email_err = "email already in database.<br>";
    echo $email_err;
  }

  $age = date_diff(date_create($_POST["date"]), date_create('today'))->y;
  if ($age < 16) {
    //change this
    $age_err = "you must be at least 16 years old to make register";
    echo $age_err;
  }

  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $sql = "INSERT into users (username, password, email, age, fname, lname) values('$username', '$password', '$email', '$age', '$fname', '$lname')";
  if (empty($username_err) && empty($password_err) && empty($email_err) && empty($age_err) && mysqli_query($conn, $sql)) {
    header("location: signin.php");
    exit;
  } else {
    echo "something went wrong";
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
  <style>
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
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>

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
    <a href="signin.php" class="btn btn-lg btn-outline-secondary btn-block" type="button">Sign in</a>
  </form>

</body>

</html>


<?php
// Home page
?>