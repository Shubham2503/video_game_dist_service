<?php 
    require '../include/connect_db.php';
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $sql = "SELECT name,price, year,descrip FROM games WHERE game_id = $_POST['game_id']";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
              echo "id: " . $row["price"]. " - Name: " . $row["descrip"]. " " .$row['year']. "<br>";
              $descrip = $row["descrip"];
              $name = $row["name"];
              $price = $row['price'];
              $year = $row['year'];
            
          } else
           {
            echo "Something went wrong!!!";
          }
    }


    mysqli_close($conn);

?>