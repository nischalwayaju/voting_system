
<?php include 'config.php';

    session_start();
    include('functions.php');
    include('connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST["fullname"];
        $dob = $_POST["dob"];
        $phone = $_POST["phone"];
        $citizenship = $_POST["citizenship"];
    
        // Insert data into database
        $sql = "INSERT INTO user_info (fullname, dob, phone, citizenship, `user-id`) VALUES ('$fullname', '$dob', '$phone', '$citizenship', null)";
    
        if (mysqli_query($conn, $sql)) {
            echo "User added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="adduser.css?v=<?=$version?>">
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
        </ul>
      </div>
    </nav>
    <div class="mainbody">
        <div class="box">
          <div class="form">
            <form method="POST">
                <h2>Add User</h2><br>
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
                <input type="text" id="dob" name="dob" placeholder="Date of Birth" onfocus="(this.type='date')" value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>" required>
                    <i></i>
                </div><br>
                    <input type="submit" value="Register" >
              </form>
          </div>
        </div>
    </div>
   
</body>

</html>