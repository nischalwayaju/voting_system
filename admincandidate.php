<?php include 'config.php';?>
<?php
session_start();

include("functions.php");
include("connection.php");
$election_id = mysqli_real_escape_string($conn, $_GET["election_id"]);
$query = "SELECT * FROM candidates_info WHERE election_id = '$election_id'";

$result = mysqli_query($conn, $query);
$query1 = "SELECT * FROM candidates_info";
$result1 = mysqli_query($conn, $query1);

if (mysqli_num_rows($result1) > 0) {
    $candidate_data = mysqli_fetch_assoc($result1);
    $candidate_id = $candidate_data["Candidate_id"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql1 = "DELETE FROM candidates_info WHERE candidate_id = '$candidate_id'";
        if (mysqli_query($conn, $sql1)) {
            header("Location: adminhome.php");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
} else {
    echo "No candidate data found.";
}


    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admincandidate.css?v=<?=$version?>">
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
          <li><a href="adminhome.php">Elections</a></li>
          <li><a href="adminresult1.php">Results</a></li>

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
        echo "<button type='submit' class='votebutton' id='vote-" . $candidate_data["Candidate_id"] . "'>Remove Candidate</button>";
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