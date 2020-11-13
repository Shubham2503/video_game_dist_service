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

    // Deleting database if already exists
    $dbname = "gamedb";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if($conn)
    {
      $sql = "DROP DATABASE gamedb";
      if (mysqli_query($conn, $sql)) {
        echo "Database deleted successfully";
      } else {
        echo "Error deleting database: " . mysqli_error($conn);
      }

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
    age INT NOT NULL, 
    fname varchar(30) NOT NULL, 
    lname varchar(30) NOT NULL
    )";
    
    if (mysqli_query($conn, $sql)) {
      echo "Table users created successfully";
    } else {
      echo "Error creating table: " . mysqli_error($conn);
    }
    
    
    
    // Inserting users in table
    $sql = "INSERT INTO `users` ( `username`, `password`, `email`, `age`, `fname`, `lname`) VALUES ('admin', '12345678', 'temp@temp.temp', '20', 'admin', 'admin')";

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
    $sql = "CREATE TABLE `gamedb`.`game_category` ( `game_id` INT NOT NULL , `category` VARCHAR(100) NOT NULL ) ENGINE = InnoDB;";
    if (mysqli_query($conn, $sql)) {
      echo "table: game_category created";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //dummy games
    $sql = "INSERT INTO `games` (`game_id`, `name`, `price`, `year`, `developer`, `descrip`) VALUES ('1', 'Minecraft', '26', '2010', ' Mojang Studios', 'With new games, new updates, and new ways to play, join one of the biggest communities in gaming and start crafting today!');";
    if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $sql = "INSERT INTO `games` (`game_id`, `name`, `price`, `year`, `developer`, `descrip`) VALUES ('2', 'Watch Dogs: Legion', '87', '2020', 'Ubisoft Toronto', 'Build a resistance');";
    if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'cat1')";
     if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game_category";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $sql = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'cat2')";
     if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game_category";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $sql = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'cat1')";
     if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game_category";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    $sql = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'cat3')";
     if (mysqli_query($conn, $sql)) {
      echo "dummy records added in table game_category";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    //create user_games table
    $sql = "CREATE TABLE `gamedb`.`user_games` ( `userid` INT NOT NULL , `game_id` INT NOT NULL , `card_no` INT NOT NULL , `datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;";
    if (mysqli_query($conn, $sql)) {
      echo "table: user_games created";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    //add dummy val
    // $sql = "INSERT INTO `user_games` (`userid`, `game_id`) VALUES ('1', '1');";
    // if (mysqli_query($conn, $sql)) {
    //   echo "dummy records added in table user_games";
    // } else {
    //   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
    
    mysqli_close($conn);


?>