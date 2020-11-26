<?php 
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../store/index.php");
    exit;
}

//DBMS CONNECTION////////
require "../include/connect_db.php";
///////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 $username = $password = "";
 $username_err = $password_err = $match_err = "";

 $sql = "SELECT * FROM users WHERE username = '".trim($_POST["username"])."'";
 $res = mysqli_query($conn, $sql);

  if(mysqli_num_rows($res) > 0)
  {
    $username = trim($_POST["username"]);    
    if(strlen(trim($_POST["password"])) < 8)
    {
      $password_err = "Password must have atleast 8 characters.";
      echo "<script>alert('$password_err')</script>";
    } 
    else
    {
      $password = trim($_POST["password"]);
    }
  }
  else
  {
    $username_err = "No Such Username";
    echo "<script>alert('$username_err')</script>";
  }

  
  $row = mysqli_fetch_assoc($res);

  if(empty($password_err) && $row["password"] != $password)
  {
    $match_err = "incorrect Password";
    echo "<script>alert('$match_err')</script>";;
  }
   

  if(empty($username_err)&&empty($password_err)&&empty($match_err))
  {
    session_start();

    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;      
    setcookie("userid", $row["userid"], time() + (86400 * 30), "/");
    header("location: ../store/index.php");
  }
  else
  {
    ////change this
    echo "database errr<br>";
  }
  mysqli_close($conn); 
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Signin Template · Bootstrap</title>
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
 
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form">
      <img class="mb-4" src="../image/logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal" style="color: white;">Please sign in</h1>
      <label for="inputusername" class="sr-only">Email address</label>
      <input type="text" id="inputusername" name="username" class="form-control" placeholder="username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>


      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <a href="register.php" class="btn btn-lg btn-outline-warning btn-block" type="button">Register</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2020</p>
    </form>

  </body>
</html>
