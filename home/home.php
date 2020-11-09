<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: signin.php");
    exit;
}
?>
hello 
<html>
<body>
    <a href="logout.php">logout</a>
</body>
</html>