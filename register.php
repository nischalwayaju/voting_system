
<?php include 'config.php';

    session_start();
    include('functions.php');
    include('connection.php');
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $dob = $_POST["dob"];
            $phone = $_POST["phone"];
            $citizenship = $_POST["citizenship"];
            $father_name = $_POST["father"];
            $address = $_POST["address"];
            $confirmpassword=$_POST["confirmpassword"];
            $password_error='';
            $data_error='';
            
            if ($password!=$confirmpassword) {
                $password_error = "Password did not match.";
              
            } else {
                $query = "select * from user_info where citizenship = '$citizenship' limit 1";
                $result=mysqli_query($conn,$query);
                if ($result) {
                    if($result && mysqli_num_rows($result) > 0)
                    {
        
                        $user_data = mysqli_fetch_assoc($result);
                            
                        if($user_data['fullname'] != $fullname || $user_data['phone'!=$phone || $user_data['dob']!=$dob ])
                        {
                            $data_error="Citizenship and the data entered didn't match.";
                        }
                        else{
                              // Hash the password
                $hashed_password = hash("sha256", $password);

                // Insert data into database
               $sql = "INSERT INTO registration (fullname, email, password, dob, phone, citizenship,father_name, address, profilepic) VALUES ('$fullname', '$email', '$hashed_password', '$dob', '$phone', '$citizenship','$father_name','$address',null)";

               if (mysqli_query($conn, $sql)) {
                   header("Location:voterlogin.php");
               } 
               else {
                   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
               }
                        }
                    }
                }   
                
            }
            
            
        }
    // Close connection
    mysqli_close($conn);
?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css?v=<?=$version?>">
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
          <li><a href="voterlogin.php">Login</a></li>
        </ul>
      </div>
    </nav>
    <div class="mainbody">
        <div class="box">
          <div class="form">
            <form method="POST">
                <h2>Registration Form</h2>
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
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="text" id="father" name="father" placeholder="Father's Name" value="<?php echo isset($_POST['father']) ? htmlspecialchars($_POST['father']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="text" id="address" name="address" placeholder="Permanent Address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="text" id="dob" name="dob" placeholder="Date of Birth" onfocus="(this.type='date')" value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="password" id="password" name="password" placeholder="Password" required>
                    <i></i>
                </div>
                <div class="inputbox">
                <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Re-enter Password" required>
                    <i></i>
                </div>
                <div id="password_error" style="color: red;"><?php if(isset($password_error) && !empty($password_error)){
                                                                        echo "$password_error";
                                                                    }?>
                </div><br>
                <div id="password_error" style="color: red;"><?php if(isset($data_error) && !empty($data_error)){
                                                                        echo "$data_error";
                                                                    }?>
                </div><br>
                    <input type="submit" value="Register" >
              </form>
          </div>
        </div>
    </div>
   
</body>

</html>