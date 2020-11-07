<?php 
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
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

if($_SERVER["REQUEST_METHOD"] == "POST")
{
 $username = $password = "";
 $username_err = $password_err = $match_err = "";

 $sql = "SELECT * FROM users WHERE username = '".trim($_POST["username"])."'";
 $res = mysqli_query($conn, $sql);

  if(mysqli_num_rows($res) > 0)
  {
    $username = trim($_POST["username"]);    
  }
  else
  {
    ///change this///////////////
    $username_err = "No Such Username<br>";
    echo $username_err;
  }

  if(strlen(trim($_POST["password"])) < 8)
  {
    //////////change this
    $password_err = "Password must have atleast 8 characters.<br>";
    echo $password_err;
  } 
  else
  {
    $password = trim($_POST["password"]);
  }
  $row = mysqli_fetch_assoc($res);

  if($row["password"] != $password)
  {
    ///////change this
    $match_err = "incorrect";
    echo "incorrect password<br>";
  }
   

  if(empty($username_err)&&empty($password_err)&&empty($match_err))
  {
    session_start();

    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $username;                            
    header("location: home.php");
  }
  else
  {
    ////change this
    echo "Something went wrong<br>";
  }
  mysqli_close($conn); 
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Signin Template · Bootstrap</title>
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

    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form">
      <img class="mb-4" src="/image/" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputusername" class="sr-only">Email address</label>
      <input type="text" id="inputusername" name="username" class="form-control" placeholder="user" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>


      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <a href="register.php" class="btn btn-lg btn-outline-secondary btn-block" type="button">Register</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2020</p>
    </form>

  </body>
</html>
