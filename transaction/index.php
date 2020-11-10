<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../home/signin.php");
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
    // echo $fname.$lname.$username.$email.$game_name.$game_price;
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
    </style>
    <link href="form-validation.css" rel="stylesheet">
</head>


<body class="bg-light">
    <div class="container">

        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="../image/logo.png" alt="" width="72" height="72">
            <h2>Checkout</h2>
            <p class="lead"><?php echo $game_name ?></p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your order</span>
                    <!-- <span class="badge badge-secondary badge-pill">3</span> -->
                </h4>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $game_name ?></h6>
                            <small class="text-muted">Taxes excluded</small>
                        </div>
                        <span class="text-muted"><?php echo "$".$game_price ?></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Tax</h6>
                            <small class="text-muted"></small>
                        </div>
                        <span class="text-muted">$2</span>
                    </li>

                    <!-- <li class="list-group-item d-flex justify-content-between bg-light">
          <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
          </div>
          <span class="text-success">-$5</span>
        </li> -->

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong><?php echo "$".($game_price+2) ?></strong>
                    </li>
                </ul>

                <!-- <form class="card p-2">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Promo code">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary">Redeem</button>
          </div>
        </div>
      </form> -->

            </div>


            <div class="col-md-8 order-md-1">

                <h4 class="mb-3">Billing</h4>

                <form class="needs-validation" novalidate method="post" action="receipt.php">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $fname ?>" required readonly>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $lname ?>" required readonly>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $username ?>" required readonly>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $email ?>" readonly required>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
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

                    <h4 class="mb-3">Payment</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" name="card_no" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <input name="userid" value="<?php echo $userid?>" hidden>
                    <input name="email" value="<?php echo $email?>" hidden>
                    <input name="game_id" value="<?php echo $game_id?>" hidden>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017-2020 Company Name</p>
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