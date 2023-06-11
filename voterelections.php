<?php include 'config.php';?>
<?php
session_start();

if (!isset($_SESSION['citizenship'])) {
    header("Location: voterlogin.php");
    exit;
}
include("functions.php");
include("connection.php");
$query="SELECT * from elections";

$result=mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="voterelection.css?v=<?=$version?>">
    <link href="https://fonts.cdnfonts.com/css/medula-one" rel="stylesheet">
    <title>Elections</title>
</head>
<body>
    <nav>
      <div class="menu">
        <div class="logo">
          <a href="#">Vote</a>
        </div>
        <ul>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="voterelections.php">Elections</a></li>
          <li><a href="voterresults1.php">Results</a></li>
        </ul>
      </div>
    </nav>
    <?php
    echo "<div class='container1'>";
    while ($election_data = mysqli_fetch_assoc($result)) {
        echo "<div class='entry'>";
        echo"<button type='submit' class='votebutton' onclick='window.location.href=\"votercandidate.php?election_id=" . $election_data["election_id"] . "\"'>Vote</button>";
        echo "<h2>". 'Election Name :  ' . $election_data["Election_name"] . "</h2>";
        echo "<p class='insidediv'>".'Election ID : ' . $election_data["election_id"] . "</p>";
        echo "<p class='insidediv'>".'Election POST : ' . $election_data["Post_name"] . "</p>";
        echo "</div>";
        
    }
    echo "</div>";  
    // Close the database connection
    mysqli_close($conn);
    ?>
<form action="voterlogout.php" method="POST" id="logout-form">
  <button type="submit" class="logout">Logout</button>
</form>
    
</body>
</html>