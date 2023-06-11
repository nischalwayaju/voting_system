<?php include 'config.php';
include("connection.php");
include("functions.php");

session_start();

if (!isset($_SESSION['citizenship'])) {
    header("Location: voterlogin.php");
    exit;
}
$user_data = check_login($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css?v=<?=$version?>">
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
    
    <div class="mainbody">
            <div class="box"> 
                <h2>Profile</h2>
                <p>Name: <?php echo $user_data['fullname']?></p>
            <p>Citizenship no: <?php echo $user_data['citizenship']?></p>
            <p>Contact no: <?php echo $user_data['phone']?></p>
            <p>Email: <?php echo $user_data['email']?></p>
            <p>Father's name: <?php echo $user_data['father_name']?></p>
            <p>Address: <?php echo $user_data['address']?></p>
            <p>Age: 
                <?php 
                $date_of_birth=$user_data['dob'];
                $today = new DateTime();
                $diff = $today->diff(new DateTime($date_of_birth));
                $age = $diff->y;
                echo $age?></p>
            <p>Status: <?php if ($age>=18) {
                echo "Verified";
            } else {
                echo "Unverified";
            }
            ?></p>
            <div class="profilepic">
            <?php
            $source1=$user_data['profilepic'];
            ?>
            <img src="<?php echo $source1?>" class="image1">
            </div> 
        
        <form method="post" enctype="multipart/form-data">
            <label for="file">Choose File</label><br>
            <input type="file" name="file" id="file">
            <button type="submit" name="submit">Upload</button>
            <?php
              imageupload($conn);   
            ?>
        </form>

        </div>
        
    </div>  
    
</form>
<form action="voterlogout.php" method="POST" id="logout-form">
  <button type="submit" class="logout">Logout</button>
</form>
</body>
</html>