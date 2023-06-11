<?php include 'config.php';?>
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: adminlogin.php");
  exit;
}

include("functions.php");
include("connection.php");
$query="SELECT * from elections";

$result=mysqli_query($conn,$query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $election_name=$_POST['election_name'];
    $post=$_POST['post'];
    $sql1="INSERT INTO elections (Election_name,Post_name) VALUES ('$election_name','$post')";
    if (mysqli_query($conn, $sql1)) {
    } 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
// Close connection
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="adminhome.css?v=<?=$version?>">
    <link href="https://fonts.cdnfonts.com/css/medula-one" rel="stylesheet">
</head>
<body>

  <nav>
      <div class="menu">
        <div class="logo">
          <a href="#">Vote</a>
        </div>
        <ul>
          <li><a href="adminhome.php">Elections</a></li>
          <li><a href="adminresult1.php">Results</a></li>
          <li><a href="adduser.php">Add User</a></li>
          <li><button id="myButton">Add Election</button></li>
        </ul>
      </div>
    </nav>
    <?php
    echo "<div class='container1'>";
        // Loop over the rows of the result set
    while ($election_data = mysqli_fetch_assoc($result)) {
        // Display each row in a suitable layout
        echo "<div class='entry'>";
        echo "<form method='post' action='delete_entry.php' class='remove' >";
        echo "<input type='hidden' name='election_id' value='" . $election_data['election_id'] . "'>";
        echo"<button type='submit' class='button'>Remove Election</button>";
        echo"</form>";
        echo "<div class='addcandidate'><a href='addCandidate.php?election_id=" . $election_data['election_id'] . "'><button type='submit' class='addcandidate'>ADD Candidate</button></a></div>";
        echo "<div class='candidate'><a href='admincandidate.php?election_id=" . $election_data['election_id'] . "'><button type='submit' class='candidate'>Candidate</button></a></div>";    
        echo "<h2>". 'Election Name :  ' . $election_data["Election_name"] . "</h2>";
        echo "<p class='insidediv'>".'Election ID : ' . $election_data["election_id"] . "</p>";
        echo "<p class='insidediv'>".'Election POST : ' . $election_data["Post_name"] . "</p>";
        echo "</div>";
        
    }
    echo "</div>";  
    ?>
    <div class="overlay"></div>
  <div class="popup">
    <h2>Add Election</h2><br>
    <form method="post">
        <input type="text" id="election_name" name="election_name" placeholder="Election Name" class="input"><br><br>
        <input type="text" id="post" name="post" placeholder="POST" class="input"><br><br>
        <button type="submit" class="addbutton" >ADD</button>
    </form>
    <span class="close-btn">&times;</span>
  </div>
  
  <script>
    var overlay = document.querySelector('.overlay');
    var popup = document.querySelector('.popup');
    var closeBtn = document.querySelector('.close-btn');

    document.getElementById('myButton').addEventListener('click', function() {
      overlay.style.display = 'block';
      popup.style.display = 'block';
    });

    closeBtn.addEventListener('click', function() {
      overlay.style.display = 'none';
      popup.style.display = 'none';
    });
  </script>
<form action="adminlogout.php" method="POST" id="logout-form">
  <button type="submit" class="logout">Logout</button>
</form>
   
</body>
</html>