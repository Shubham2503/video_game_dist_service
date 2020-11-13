<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	    header("location: ../home/signin.php");
	    exit;
    }
    
    require '../include/connect_db.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $key = $_POST["key"];
        $key = '%'.strtolower($key).'%';
        $sql = "SELECT * FROM games NATURAL JOIN game_category WHERE lower(name) LIKE '$key' OR lower(year) LIKE '$key' OR lower(developer) LIKE '$key' OR lower(descrip) LIKE '$key' OR lower(category) LIKE '$key' ";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) > 0)
        {
            while ($row = mysqli_fetch_row($res)) 
            {
                echo $row[1]."<br>";
            }
        }
        else
        {
            echo "no results<br>";
        }

        mysqli_close($conn);
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>search</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label>Search game: </label>
    <input type="text" name="key"  required>

    <input type="submit" value="Submit">
</form>
</body>
</html>