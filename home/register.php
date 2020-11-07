<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
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

    <form class="form-register">
      <img class="mb-4" src="/image/" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Register</h1>

      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputEmail" class="sr-only">Username</label>
      <input type="email" id="inputUname" class="form-control" placeholder="Username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <label for="inputPassword" class="sr-only">Confirm Password</label>
      <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required>
      <label for="inputEmail" class="sr-only">Date of Birth</label>
      <input type="date" id="inputDOB" class="form-control" placeholder="Date of Birth" required autofocus>


      <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    </form>

  </body>
</html>


<?php
    // Home page
?>