<?php 
    //   CREATING A DATABASE
    $servername = "localhost";
    $username = "root";
    $password = "";
   
    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
   // Create database
  $sql = "CREATE DATABASE gamedb";
  if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . mysqli_error($conn);
  }


    // CONNECTING DATABASE
    $dbname = "gamedb";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    // Creating Users Table


  $sql = "CREATE TABLE users (
    userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    age INT NOT NULL
    )";
    
    if (mysqli_query($conn, $sql)) {
      echo "Table users created successfully";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
    
    
    
    // Inserting users in table
    $sql = "INSERT INTO `users` ( `username`, `password`, `email`, `age`) VALUES ('admin', '12345678', 'temp@temp.temp', '20')";

    if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table users";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //table games
    $sql = "CREATE TABLE `gamedb`.`games` ( `game_id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(200) NOT NULL , `price` INT NOT NULL , `year` YEAR NOT NULL , `developer` VARCHAR(200) NOT NULL , `descrip` VARCHAR(500) NOT NULL , PRIMARY KEY (`game_id`)) ENGINE = InnoDB;";

    if (mysqli_query($conn, $sql)) {
      echo "table: games created";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //table game_category
    $sql = "CREATE TABLE `gamedb`.`game_category` ( `game_id` INT NOT NULL , `category` VARCHAR(100) NOT NULL, PRIMARY KEY( `game_id`) ) ENGINE = InnoDB;";
    if (mysqli_query($conn, $sql)) {
      echo "table: game_category created";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //dummy games
    $sql = "INSERT INTO `games` (`game_id`, `name`, `price`, `year`, `developer`, `descrip`) VALUES ('1', 'tempo', '12', '2010', 'hell', 'bba babjalgdjlasjdg');";
    if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'cat 1')";
     if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game_category";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);


?>