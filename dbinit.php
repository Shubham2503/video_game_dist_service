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

$sql1[] = "INSERT INTO `games` (`game_id`, `name`, `price`, `year`, `developer`,`vid_id`, `descrip`, `descrip2`, `descrip3`) VALUES ('1', 'Minecraft', '26', '2010', ' Mojang Studios', 'oQOSJkBYzrg',
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
$sql1[] = "INSERT INTO `games` VALUES ('7', 'GTA V', '50', '2015', 'Rockstar Games', 'VjZ5tgjPVfU',
'When a young street hustler, a retired bank robber and a terrifying psychopath land themselves in trouble, they must pull off a series of dangerous heists to survive in a city in which they can trust nobody, least of all each other.'
,'Discover an ever-evolving world of choices and ways to play as you climb the criminal ranks of Los Santos and Blaine County in the ultimate shared Online experience.'
,'Launch business ventures from your Maze Bank West Executive Office, research powerful weapons technology from your underground Gunrunning Bunker and use your Counterfeit Cash Factory to start a lucrative counterfeiting operation.');";
$sql1[] = "INSERT INTO `games` VALUES ('8', 'Cyberpunk 2077', '500', '2020', 'CD Projekt RED', 'VjZ5tgjPVfU',
'Cyberpunk 2077 is an upcoming action role-playing video game developed and published by CD Projekt. It is scheduled to be released for Microsoft Windows, PlayStation 4, PlayStation 5, Stadia, Xbox One, and Xbox Series X/S on 10 December 2020.'
,'Cyberpunk 2077 is an open-world, action-adventure story set in Night City, a megalopolis obsessed with power, glamour and body modification. You play as V, a mercenary outlaw going after a one-of-a-kind implant that is the key to immortality.'
,'Launch business ventures from your Maze Bank West Executive Office, research powerful weapons technology from your underground Gunrunning Bunker and use your Counterfeit Cash Factory to start a lucrative counterfeiting operation.');";
$sql1[] = "INSERT INTO `games` VALUES ('9', 'Spider-Man: Miles Morales', '20', '2020', 'Sony Interactive Entertainment', 'gHzuHo80U2M',
'In the latest adventure in the Marvel’s Spider-Man universe, teenager Miles Morales is adjusting to his new home while following in the footsteps of his mentor, Peter Parker, as a new Spider-Man.'
,'But when a fierce power struggle threatens to destroy his new home, the aspiring hero realizes that with great power, there must also come great responsibility. To save all of Marvel’s New York, Miles must take up the mantle of Spider-Man and own it.'
,'Miles Morales discovers explosive powers that set him apart from his mentor, Peter Parker. Master his unique, bio-electric venom blast attacks and covert camouflage power alongside spectacular web-slinging acrobatics, gadgets and skills.');";
$sql1[] = "INSERT INTO `games` VALUES ('10', 'Godfall', '10', '2020', 'Counterplay Games', 'P9p_t408_vA',
'Adventure across exotic vistas, from the above-ground reefs of the Water Realm to the subterranean crimson forests of the Earth Realm.'
,'Adventure across exotic vistas, from the above-ground reefs of the Water Realm to the subterranean crimson forests of the Earth Realm.'
,'Unlock 12 Valorplates: Divine, Zodiac-inspired suits of armor that empower you to shred every enemy between you and Macros.');";
$sql1[] = "INSERT INTO `games` VALUES ('11', 'HUMANKIND', '15', '2019', 'AMPLITUDE Studios', 'TfJZsyIaaKg',
'HUMANKIND™ is a historical strategy game, where you’ll be re-writing the entire narrative of human history and combining cultures to create a civilization that’s as unique as you are.'
,'Face historical events, take impactful moral decisions, and make scientific breakthroughs. Discover the natural wonders of the world or build the remarkable creations of humankind.'
,'Show off tactical skills by mastering terrain elevation with city-building and tactical battles. Call on reinforcements to transform an epic battle into a multi-terrain world war!');";
$sql1[] = "INSERT INTO `games` VALUES ('12', 'Trackmania', '33', '2021', 'Ubisoft Nadeo', 'TQQOwnbuvsc',
'Even solo, race against other players’ ghosts that are close to your level to help you improve progressively, at your own pace.'
,'You can either play by yourself and enjoy the drive, or collect medals and assess your skills with regional and international rankings.'
,'25 official tracks, updated every 3 months and playable solo, online and locally to practice your racing skills.');";
$sql1[] = "INSERT INTO `games` VALUES ('13', 'The Cycle', '11', '2019', 'YAGER', 'n6Jj-ymCtxs',
'On the path to glory you’ll have to overcome the odds - beat other players, take out vicious beasts, complete the most contracts and escape the deadly storm!'
,'No matter what you chose, whether you’re a lone wolf or a tactical team player, whether you play it safe or risk it all in your quest for fame, your fortune lies in your own hands! '
,'In The Cycle, you don’t need to rely on getting lucky loot - you make the decisions! Pick your weapons, weapon mods and special abilities ahead of time, and outsmart your opponents on your road to victory. ');";
$sql1[] = "INSERT INTO `games` VALUES ('14', 'Satisfactory', '20', '2019', 'Coffee Stain Studios', 'QvWaV4qshZQ',
'Satisfactory is a first-person open-world factory building game with a dash of exploration and combat. Play alone or with friends, explore an alien planet, create multi-story factories, and enter conveyor belt heaven!'
,'Early Access games are still under development and may change significantly over time. As a result, you may experience unforeseen issues or completely new gameplay elements while playing this game.'
,'You can play now to experience the game while its being built or wait until it offers a more complete experience.');";
$sql1[] = "INSERT INTO `games` VALUES ('15', 'Red Dead Redemption 2', '44', '2019', 'Rockstar Games', 'gmA6MrX81z4',
'Arthur Morgan and the Van der Linde gang are outlaws on the run. With federal agents and the best bounty hunters in the nation massing on their heels, the gang must rob, steal and fight their way across the rugged heartland of America in order to survive.'
,' As deepening internal divisions threaten to tear the gang apart, Arthur must make a choice between his own ideals and loyalty to the gang who raised him.'
,'With all new graphical and technical enhancements for deeper immersion, Red Dead Redemption 2 for PC takes full advantage of the power of the PC to bring every corner of this massive, rich and detailed world to life including increased draw distances.');";


$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('2', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('3', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('6', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('1', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('4', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('5', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('7', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('8', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('8', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('8', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('9', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('9', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('9', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('10', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('10', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('10', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('11', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('11', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('11', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('12', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('12', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('12', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('13', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('13', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('13', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('14', 'New Releases')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('14', 'Co-Op')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('14', 'Top Seller')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('15', 'Adventure')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('15', 'Action')";
$sql1[] = "INSERT INTO `game_category` (`game_id`, `category`) VALUES ('15', 'New Releases')";


foreach ($sql1 as $query) {
    if (mysqli_query($conn, $query)) {
        echo "records added in table<br>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);
