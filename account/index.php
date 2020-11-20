<?php
require '../include/console_log.php';
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../home/signin.php");
    exit;
}

$userid = $_COOKIE["userid"];

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

$user_game = array();
$sql = "SELECT * FROM user_games WHERE userid = '$userid'";
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res))
    $user_game[] = array($row['game_id'],$row['datetime']);


$games = array();
$sql = "SELECT * FROM games";
$res = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $id = $row["game_id"];
    $games[$id] = $row;
}


console_log($user_game);


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Checkout</title>
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

        body {
            background: radial-gradient(#40404b, #111118) rgba(34, 34, 40, 0.94);
            color: white;
        }

        a {
            color: #17a2b8;
            text-decoration: none;
            background-color: transparent;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #17a2b8;
        }

        a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

    </style>
    <link href="form-validation.css" rel="stylesheet">
</head>


<body class="bg-light">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

                <div class="py-5 text-center">
                    <a href="../store/index.php"><img class="d-block mx-auto mb-4" src="../image/logo.png" alt="" width="72" height="72"></a>
                    <h2 style="color: white;">Account</h2>
                    <p class="lead"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-1">
        </div>
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Games</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Sign out</a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="container">
                        <div class="col-md-12 order-md-1">
                            <form class="needs-validation" novalidate method="post" action="receipt.php">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName">First name</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $fname ?>" required>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="lastName">Last name</label>
                                        <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $lname ?>" required>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">@</span>
                                            </div>
                                            <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $username ?>" required>
                                            <div class="invalid-feedback" style="width: 100%;">
                                                Your username is required.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $email ?>" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid email address for shipping updates.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="dob">DOB</label>
                                        <input type="date" class="form-control" id="dob" value="" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid DOB.
                                        </div>
                                    </div>
                                </div>
                                <h4><label for="dob">Password</label></h4>

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label for="pass">Password</label>
                                        <input type="password" class="form-control" id="pass" value="" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid password.
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="c_pass">Confirm Password</label>
                                        <input type="password" class="form-control" id="c_pass" value="" required>
                                        <div class="invalid-feedback">
                                            Please enter a valid password.
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="row">
                          <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required>
                              <option value="">Choose...</option>
                              <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                              Please select a valid country.
                            </div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" required>
                              <option value="">Choose...</option>
                              <option>California</option>
                            </select>
                            <div class="invalid-feedback">
                              Please provide a valid state.
                            </div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                              Zip code required.
                            </div>
                          </div>
                        </div> -->

                                <hr class="mb-4">
                                <button class="btn btn-outline-warning btn-lg btn-block" name="update" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="container">

                        <?php
                        if (sizeof($user_game) == 0)
                            echo "<h2>No Games yet !</h2>";
                        else {
                        ?>

                            <table style="width:100%" id='tab'>
                                <tr>
                                    <th style="color: #ffc107;">Game</th>
                                    <th style="color: #ffc107;">Published</th>
                                    <th style="color: #ffc107;">Developer studio</th>
                                    <th style="color: #ffc107;">Date - Time</th>
                                </tr>
                                <?php
                                console_log($games);
                                foreach ($user_game as $i) {
                                    echo "<tr>";
                                    echo "<td>" . $games[$i[0]]['name'] . "</td><td>" . $games[$i[0]]['year'] . "</td><td>" . $games[$i[0]]['developer'] . "</td><td>" . $i[1] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>

                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    ...Mesasage</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <div class="row">
                        <div class="col-md-5" >
                            <a href="../home/logout.php" class="btn btn-outline-warning btn-lg btn-block" id="signout">Sign out</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2020-2020</p>
        <!-- <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul> -->
    </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="form-validation.js"></script>
</body>

</html>