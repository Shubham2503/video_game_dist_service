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
$sql[] = "CREATE TABLE `gamedb`.`games` ( `game_id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(200) NOT NULL , `price` INT NOT NULL , `year` YEAR NOT NULL , `developer` VARCHAR(200) NOT NULL ,`vid_id` VARCHAR(200) NOT NULL , `descrip` VARCHAR(500) NOT NULL, `descrip2` VARCHAR(500) NOT NULL, `descrip3` VARCHAR(500) NOT NULL , PRIMARY KEY (`game_id`)) ENGINE = InnoDB;";
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

$sql1[] = "INSERT INTO `games` (`game_id`, `name`, `price`, `year`, `developer`,`vid_id`, `descrip`, `descrip2`, `descrip3`) VALUES ('1', 'Minecraft', '26', '2010', ' Mojang Studios', 'MmB9b5njVbA',
'Be resourceful : Get crafty and use the surrounding environment to gather building materials—see how breaking down trees can help you create something new.'
,'Survive the night : It’s always best to avoid the unpredictable by distancing yourself from wandering mobs—you never know what’ll happen if they get too close!'
,'Build something amazing : Discover all the versatile ways dust from the Redstone ore can be used to enhance your creations, bring them to life, or give them some bang.');";
$sql1[] = "INSERT INTO `games` VALUES ('2', 'Watch Dogs: Legion', '87', '2020', 'Ubisoft Toronto', 'KbokXaPTk38',
'Build a resistance from virtually anyone you see as you hack, infiltrate, and fight to take back a near-future London that is facing its downfall. Welcome to the Resistance.'
,'Recruit and play as anyone in the city. Everyone you see has a unique backstory, personality, and skill set. Hack armed drones, deploy spider-bots, and take down enemies using an Augmented Reality Cloak.'
,'Take your recruits online and team up with your friends as you complete missions and challenging endgame content.');";
$sql1[] = "INSERT INTO `games` VALUES ('3', 'Fortnite', '50', '2017', 'Epic Games', '3KgmY5NrEzU',
'Fortnite is the free, always evolving, multiplayer game where you and your friends battle to be the last one standing or collaborate to create your dream Fortnite world. Play both Battle Royale and Fortnite Creative for FREE. Download now and jump into the action. This download also gives you a path to purchase the Save the World co-op PvE campaign.'
,'Fortnite Battle Royale is a player-versus-player game for up to 100 players, allowing one to play alone, in a duo, or in a squad usually consisting of three or four players.'
,'Weaponless players airdrop from a Battle Bus that crosses the games map. The last player, duo, or squad remaining is the winner.');";
$sql1[] = "INSERT INTO `games` VALUES ('4', 'HITMAN 3', '20', '2021', 'IO Interactive A/S', 'R_Ob-fupzKg',
'Agent 47 returns as a ruthless professional in HITMAN 3 for the most important contracts of his entire career. Embark on an intimate journey of darkness and hope in the dramatic conclusion to the World of Assassination trilogy. Death awaits.'
,'Experience a globetrotting adventure and visit exotic locations that are meticulously detailed and packed full of creative opportunities. IOI’s award-winning Glacier technology powers HITMAN 3’s tactile and immersive game world to offer unparalleled player choice and replayability.'
,'HITMAN 3 is the best place to play every game in the World of Assassination trilogy. All locations from HITMAN 1 and HITMAN 2 can be imported and played within HITMAN 3 at no additional cost for existing owners – plus progression from HITMAN 2 is directly carried over into HITMAN 3 at launch.');";
$sql1[] = "INSERT INTO `games` VALUES ('5', 'Rocket League', '10', '2021', 'Psyonix LLC', 'OmMF9EDbmQQ',
'This is Rocket League! Welcome to the high-powered hybrid of arcade-style soccer and vehicular mayhem! Customize your car, hit the field, and compete in one of the most critically acclaimed sports games of all time!'
,'From Haunted Hallows to Frosty Fest, enjoy limited time events that feature festive in-game items that can be unlocked by playing online! Keep on the lookout for limited time modes and arenas.'
,'Make your car your own with nearly endless customization possibilities! Get in-game items for completing challenges, browse the item shop, or build blueprints for premium content for your car.');";
$sql1[] = "INSERT INTO `games` VALUES ('6', 'Rogue Company', '32', '2020', 'Hi-Rez Studios', 'cwLbCWDntVc',
'The world needs saving and only the best of the best can do it. Suit up as one of the elite agents of Rogue Company and go to war in a variety of different game modes.'
,'Rogue Company is a free-to-play multiplayer, tactical, third-person shooter video game developed by First Watch Games and published by Hi-Rez Studios.'
,'Rogue Company features a range of playable characters, referred to as Rogues. The game features objective-based game modes and various maps.');";
$sql1[] = "INSERT INTO `games` VALUES ('7', 'GTA V', '50', '2015', 'Rockstar Games', 'cwLbCWDntVc',
'When a young street hustler, a retired bank robber and a terrifying psychopath land themselves in trouble, they must pull off a series of dangerous heists to survive in a city in which they can trust nobody, least of all each other.'
,'Discover an ever-evolving world of choices and ways to play as you climb the criminal ranks of Los Santos and Blaine County in the ultimate shared Online experience.'
,'Launch business ventures from your Maze Bank West Executive Office, research powerful weapons technology from your underground Gunrunning Bunker and use your Counterfeit Cash Factory to start a lucrative counterfeiting operation.');";

// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Top Seller')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Co-Op')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'New Releases')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'Co-Op')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'shooter')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Top Seller')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Co-Op')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Shooter')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Shooter')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Top Seller')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Action')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Top Seller')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Co-Op')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Co-Op')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Shooter')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'New Releases')";
// $sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Action')";

$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'Top Seller')";

$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'Co-Op')";

$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Shooter')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'Shooter')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Shooter')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Shooter')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Shooter')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Shooter')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'Shooter')";

$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'New Releases')";

$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'Action')";

foreach ($sql1 as $query) {
    if (mysqli_query($conn, $query)) {
        echo "records added in table<br>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
