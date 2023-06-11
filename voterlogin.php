<?php include 'config.php';

session_start();
if (isset($_SESSION['citizenship'])) {
  header("Location: profile.php");
  exit;
}
    include("functions.php");
	  include("connection.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		  $citizenship = $_POST['citizenship'];
		  $password = $_POST['password'];
      $retrived_hashed_password= hash("sha256", $password);
      $query = "select * from registration where citizenship = '$citizenship' limit 1";
      $result=mysqli_query($conn,$query);

		if($result)
		{
			if($result && mysqli_num_rows($result) > 0)
			{

				$user_data = mysqli_fetch_assoc($result);
					
				if($user_data['password'] == $retrived_hashed_password)
				{

					$_SESSION['citizenship'] = $user_data['citizenship'];
					header("Location: profile.php");
					exit;
				}
			}
		}
			
			$password_error="<br>Username or Password is incorrect";
		}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="voterlogin.css?v=<?=$version?>">
    <link href="https://fonts.cdnfonts.com/css/medula-one" rel="stylesheet">
</head>
<body> 
    <nav>
      <div class="menu">
        <div class="logo">
          <a href="index.html">Vote</a>
        </div>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="register.php">Register</a></li>
        </ul>
      </div>
    </nav>
    <div class="mainbody">
      <div class="box"> 
        <form method="POST">
          <div class="form">
          
          <h2>Voter's Log in </h2>
          <div class="inputbox">
            <input type="text" id="citizenship" name="citizenship" required="required" >
            <span>Citizenship </span>
            <i></i>
          </div>

          <div class="inputbox">
              <input type="password" name="password" id="password" required="required" >
              <span>Password</span><br>
              <i></i>
            </div>
            <div id="password_error" style="color: red;"><?php if(isset($password_error) && !empty($password_error)){echo "$password_error";}?></div>
            <div class="links">
            <p>You are a Admin.</p>
            <a href="adminlogin.php">Click Here</a>
            </div>
            <input type="submit" value="Login">
          </div>
      </form>
    </div>
  </div>
  </body>
</html>