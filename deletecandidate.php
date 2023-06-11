<?php
include("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $election_id = $_POST['election_id'];

    $sql1 = "DELETE FROM candidates_info WHERE election_id = $election_id";
    if ( mysqli_query($conn,$sql1)) {
        header("Location: adminhome.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>







