<?php include 'config.php';?>
<?php
include("connection.php");
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: adminlogin.php");
  exit;
}

        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $election_id = $_GET['election_id'];
    $fullname = $_POST['fullname'];
    $citizenship = $_POST['citizenship'];
    $contact = $_POST['phone'];
    $age = $_POST['age'];
    $father = $_POST['father'];
    $address = $_POST['address'];
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_ext = explode('.', $file_name);
    $file_tmp = $file['tmp_name'];
    $file_ext = strtolower(end($file_ext));
    $file_destination = 'candidateimage/' . $fullname . '.' . $file_ext;
    move_uploaded_file($file_tmp, $file_destination);

    if ($age < 21) {
        echo "Age doesn't meet the required criteria.";
    } else {
        $sql = "INSERT INTO candidates_info (full_name, citizenship, contact, Candidate_id, Age, Father, address, symbol, election_id) VALUES ('$fullname', '$citizenship', '$contact', 'null', '$age', '$father', '$address', '$file_destination', '$election_id')";

        if (mysqli_query($conn, $sql)) {
            echo "Candidate added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>
    <link rel="stylesheet" href="addcandidate.css?v=<?=$version?>">
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
          <li><a href="adminresults1.php">Results</a></li>
        </ul>
      </div>
    </nav>
    <div class="mainbody">
    <div class="box">
        <div class="form">
            <form method="post" enctype="multipart/form-data">
            <h2>Candidate Form</h2>
                <div class="inputbox">
                <input type="text" id="fullName" name="fullname" placeholder="Full Name" required="required" value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="number" id="citizenship" name="citizenship" placeholder="Citizenship number" value="<?php echo isset($_POST['citizenship']) ? htmlspecialchars($_POST['citizenship']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                    <input type="number" id="age" name="age" placeholder="Age" value="<?php echo isset($_POST['age']) ? htmlspecialchars($_POST['age']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="text" id="father" name="father" placeholder="Father's Name" value="<?php echo isset($_POST['father']) ? htmlspecialchars($_POST['father']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="text" id="address" name="address" placeholder="Permanent Address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
                    <i></i>
                </div><br>
                <label for="file">Image:</label><br><br>
                <input type="file" name="file" id="file"><br>
                <input type="submit" value="ADD">
            </form>  
        </div>            
    </div>
    </div>
   
</body>

</html>