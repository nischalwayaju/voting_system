<?php include 'config.php';?>
<?php
session_start();

if (!isset($_SESSION['citizenship'])) {
    header("Location: voterlogin.php");
    exit;
}
include("functions.php");
include("connection.php");
$election_id = mysqli_real_escape_string($conn, $_GET["election_id"]);
$query="SELECT * from candidates_info where election_id='$election_id'";

$result=mysqli_query($conn,$query);


?>
<?php 
    $citizenship = mysqli_real_escape_string($conn, $_SESSION["citizenship"]);
    
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve the candidate ID and election ID from the POST request
      $candidate_id = mysqli_real_escape_string($conn, $_POST["candidate_id"]);
      $election_id = mysqli_real_escape_string($conn, $_POST["election_id"]);
    
    }
    
    // Retrieve the election ID from the GET request
    $election_id = mysqli_real_escape_string($conn, $_GET["election_id"]);
    
    // Retrieve the candidates for the given election ID
    $candidate_query = "SELECT * FROM candidate_info WHERE election_id = $election_id";
    $candidate_result = mysqli_query($conn, $candidate_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="voterresults2.css?v=<?=$version?>">
    <link href="https://fonts.cdnfonts.com/css/medula-one" rel="stylesheet">
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
   while ($candidate_data = mysqli_fetch_assoc($result)) {
       echo "<div class='entry'>";
       echo "<div class='info'>";
       echo "<p>" . 'Candidate Name: ' . $candidate_data["full_name"] . "</p>";
       echo "<p>" . 'Candidate ID: ' . $candidate_data["Candidate_id"] . "</p>";
       $candidate_id=$candidate_data["Candidate_id"];
       $query1="SELECT COUNT(*) FROM voter_votes WHERE candidate_id = '$candidate_id' AND election_id = '$election_id'";
       $result1=mysqli_query($conn,$query1);
       $count = mysqli_fetch_row($result1)[0];
       echo "<p>" . 'Total Votes : ' . $count . "</p>";
       echo "</div>";
       echo "<div class='imagediv'>";
       echo "<img src='" . $candidate_data['symbol'] . "' alt='candidate symbol' class='symbol'>";
       echo "</div>";
       echo "</div>";
   }
   echo "</div>";
    // Close the database connection
    mysqli_close($conn);
    ?>
    
</body>
</html>