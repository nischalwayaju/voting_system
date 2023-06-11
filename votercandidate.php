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

    $citizenship = mysqli_real_escape_string($conn, $_SESSION["citizenship"]);
    
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve the candidate ID and election ID from the POST request
      $candidate_id = mysqli_real_escape_string($conn, $_POST["candidate_id"]);
      $election_id = mysqli_real_escape_string($conn, $_POST["election_id"]);
    
      // Call the castVote function to cast the vote and return the result
      $query1="SELECT *from registration where citizenship='$citizenship'";
      $result1=mysqli_query($conn, $query1);
      $voter_details = mysqli_fetch_assoc($result1);
      $date_of_birth=$voter_details['dob'];
      $today = new DateTime();
      $diff = $today->diff(new DateTime($date_of_birth));
      $age = $diff->y;
      if ($age>=18) {
        castVote($citizenship, $candidate_id, $election_id,$conn);
      }
      else{echo("You are not elegible to vote.");}
        
    
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
    <link rel="stylesheet" href="votercandidate.css?v=<?=$version?>">
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
   while ($candidate_data = mysqli_fetch_assoc($result)) {
       echo "<div class='entry'>";
       echo "<div class='info'>";
       echo "<p class='candidate-name'>" . 'Candidate Name: ' . $candidate_data["full_name"] . "</p>";
       echo "<p class='candidate-id'>" . 'Candidate ID: ' . $candidate_data["Candidate_id"] . "</p>";
       echo "<p class='candidate-address'>" . 'Address: ' . $candidate_data["address"] . "</p>";
       echo "<form method='POST'>";
        echo "<input type='hidden' name='election_id' value='$election_id'>";
        echo "<input type='hidden' name='candidate_id' value='" . $candidate_data["Candidate_id"] . "'>";
        echo "<button type='submit' class='votebutton' id='vote-" . $candidate_data["Candidate_id"] . "'>Vote</button>";
        echo "</form>";
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