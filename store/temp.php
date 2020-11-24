<?php
function console_log($output, $with_script_tags = true)
{
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
  if ($with_script_tags) {
    $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}


require '../include/connect_db.php';
$sql = "SELECT DISTINCT category FROM game_category";
$result = mysqli_query($conn, $sql);
$game_cat = array();
$cat = array();
while ($row = mysqli_fetch_assoc($result)) {
  // output data of each row
  $category = $row["category"];
  $game_cat[$category] = array();
  array_push($cat, $category);
}
console_log($game_cat);


$sql = "SELECT * FROM game_category";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  // output data of each row
  $game_id = $row["game_id"];
  $category = $row["category"];

  $game_cat[$category][] = $game_id;
}
console_log($game_cat);


////////////////////////////////////////////////////////////////

// foreach($cat as $i)
// {
//     echo "<h2> $i </h2> ";

//     foreach($game_cat[$i] as $j)
//     echo "$j ";

// }


// HTML CONTENT FOR CATEGORY NUMBER 1 
$content = array();
foreach ($game_cat as $category => $game_list) {

  $content[$category] = "<h2>$category</h2>
  <div class='content'>";
  $count = 0;
  foreach ($game_list as $game_id) {
    if ($count == 3)
      break;
    $sql = "SELECT * FROM games where game_id = $game_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    //$out = "<a href='../game/index.php?game_id=$row[0]'>$row[1]</a><br>";
    $id = $row['game_id'];
    $name = $row['name'];
    $descrip = $row['descrip'];
    $year = $row['year'];
    $price = $row['price'];
    $dev = $row['developer'];
    $count++;
    $content[$category] .= "
    <div class='card' style='height:auto'>
    <a href='../game/index.php?game_id=$id'>
  <img class='card-img-top img-fluid' src='../image/$id/1.jpg' alt='Card image cap'>
  </a>
  <div class='card-body' style= 'padding: 9px;'>
    <h5 class='card-title' style = 'margin-bottom:0; font-size: 1rem'>$name</h5>
    <footer class='blockquote-footer'>by <cite title='Source Title'>$dev</cite></footer>
    <p class='card-text' style = 'margin-bottom:0; margin-top:10px '>$ $price</p>
    
  </div>
</div>
           ";
  }
  $content[$category] .= '</div>';
}

// <div class='card'>
// <div class='frontWeb' style='background-image: url(../image/$id/1.jpg);'>
//     <p>$name</p>
// </div>

// <div class='back'>
//     <div>
//         <div class='release_date'>$year <span></span></div>
//         <div class='movie_gens'>$category</div>

//         <p class='overview'>$descrip</p>
//         <a target='_blank' href='../game/index.php?game_id=$id' class='button'>BUY</a>
//     </div>
// </div>

// </div>
console_log($content['Co-Op']);








?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="card.css">
</head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
  .card {
    width: 18rem;
  }
</style>

<body>
  <button id="btnFlipHover">flip or hover</button>

  <div class="container">
    <h1 class="heading">Games</h1>
    <p class="description">Excusive Games availabel....

    </p>
    <!--  
  <a class="card" href="#!">
    <div class="front" style="background-image: url(//source.unsplash.com/300x401);">
      <p>Lorem ipsum dolor sit amet consectetur adipisi.</p>
    </div>
    <div class="back">
      <div class="release_date">1985</div>
      <div>
        <p>Consectetur adipisicing elit. Possimus, praesentium?</p>
        <p>Provident consectetur natus voluptatem quis tenetur sed beatae eius sint.</p>
        <button class="button">Click Here</button>
      </div>
    </div>
  </a> -->


    <!-- <a class="card" href="#!">
    <div class="front" style="background-image: url(//source.unsplash.com/300x402);">
      <p>Lorem ipsum dolor sit amet consectetur adipisi.</p>
    </div>
    <div class="back">
      <div>
        <p>Consectetur adipisicing elit. Possimus, praesentium?</p>
        <p>Provident consectetur natus voluptatem quis tenetur sed beatae eius sint.</p>
        <button class="button">Click Here</button>
      </div>
    </div>
  </a> -->


    <?php
    foreach ($cat as $c) {
      echo $content[$c];
    }
    ?>



  </div>
  </div>

  <!-- <script src="card.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>