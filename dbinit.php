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
if ($conn) {
    $sql = "DROP DATABASE gamedb";
    if (mysqli_query($conn, $sql)) {
        echo "Database deleted successfully<br>";
    } else {
        echo "Error deleting database: " . mysqli_error($conn);
    }
}

// Create database
$sql = "CREATE DATABASE gamedb";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully<br>";
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


$sql = array();
$sql[] = "CREATE TABLE users (
        userid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        password VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        age INT NOT NULL, 
        fname varchar(30) NOT NULL, 
        lname varchar(30) NOT NULL
    )";
$sql[] = "CREATE TABLE `gamedb`.`games` ( `game_id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(200) NOT NULL , `price` INT NOT NULL , `year` YEAR NOT NULL , `developer` VARCHAR(200) NOT NULL , `descrip` VARCHAR(500) NOT NULL , PRIMARY KEY (`game_id`)) ENGINE = InnoDB;";
$sql[] = "CREATE TABLE `gamedb`.`game_category` ( `game_id` INT NOT NULL , `category` VARCHAR(100) NOT NULL ) ENGINE = InnoDB;";
$sql[] = "CREATE TABLE `gamedb`.`user_games` ( `userid` INT NOT NULL , `game_id` INT NOT NULL , `card_no` INT NOT NULL , `datetime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;";

foreach ($sql as $query) {
    if (mysqli_query($conn, $query)) {
        echo "table created <br>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

$sql1 = array();

$sql1[] = "INSERT INTO `users` ( `username`, `password`, `email`, `age`, `fname`, `lname`) VALUES ('admin', '12345678', 'temp@temp.temp', '20', 'admin', 'admin')";

$sql1[] = "INSERT INTO `games` (`game_id`, `name`, `price`, `year`, `developer`, `descrip`) VALUES ('1', 'Minecraft', '26', '2010', ' Mojang Studios', 'With new games, new updates, and new ways to play, join one of the biggest communities in gaming and start crafting today!');";
$sql1[] = "INSERT INTO `games` (`game_id`, `name`, `price`, `year`, `developer`, `descrip`) VALUES ('2', 'Watch Dogs: Legion', '87', '2020', 'Ubisoft Toronto', 'Build a resistance');";
$sql1[] = "INSERT INTO `games` VALUES ('3', 'Fortnite', '50', '2017', 'Epic Games', 'Fortnite is the free, always evolving, multiplayer game where you and your friends battle to be the last one standing or collaborate to create your dream Fortnite world. Play both Battle Royale and Fortnite Creative for FREE. Download now and jump into the action. This download also gives you a path to purchase the Save the World co-op PvE campaign.');";
$sql1[] = "INSERT INTO `games` VALUES ('4', 'HITMAN 3', '20', '2021', 'IO Interactive A/S', 'Death Awaits. Agent 47 returns in HITMAN 3, the dramatic conclusion to the World of Assassination trilogy.');";
$sql1[] = "INSERT INTO `games` VALUES ('5', 'Rocket League', '10', '2021', 'Psyonix LLC', 'Hit the field by yourself or with friends in 1v1, 2v2, and 3v3 Online Modes, or enjoy Extra Modes like Rumble, Snow Day, or Hoops. Unlock items in Rocket Pass, climb the Competitive Ranks, compete in Competitive Tournaments, complete Challenges, enjoy cross-platform progression and more! The field is waiting. Take your shot! ');";

$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'cat1')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'cat2')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'cat1')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'cat3')";

foreach ($sql1 as $query) {
    if (mysqli_query($conn, $query)) {
        echo "records added in table<br>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
