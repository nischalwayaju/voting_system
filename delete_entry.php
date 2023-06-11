<?php
include("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $election_id = $_POST['election_id'];
    // Use the $election_id variable to delete the corresponding record from the database
    $sql = "DELETE FROM elections WHERE election_id = $election_id";
    $sql1 = "DELETE FROM candidates_info WHERE election_id = $election_id";
    if (mysqli_query($conn, $sql) && mysqli_query($conn,$sql1)) {
        // Redirect to the page where the form was displayed
        header("Location: adminhome.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    // Close connection
    mysqli_close($conn);
}
?>







