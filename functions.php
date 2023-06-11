<?php
//checks if there is already a login
   include("connection.php");
    function check_login($conn)
    {
        if(isset($_SESSION['citizenship']))
        {
            $citizenship = $_SESSION['citizenship'];
            $query = "select * from registration where citizenship = '$citizenship' limit 1";

            $result = mysqli_query($conn,$query);
            if($result && mysqli_num_rows($result) > 0)
            {

                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        //redirect to login
        header("Location: login.php");
        die;

    }
    //Image Upload function
    function imageupload($conn){
        $citizenship = $_SESSION['citizenship'];
        $query = "select * from registration where citizenship = '$citizenship' limit 1";
        $result = mysqli_query($conn,$query);
        $user_data = mysqli_fetch_assoc($result);
        if(isset($_POST['submit'])){
            $file = $_FILES['file'];
          
            // file properties
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
          
            // file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
          
            // allowed extensions
            $allowed = array('jpg', 'jpeg', 'png');
          
            // check if file is allowed
            if(in_array($file_ext, $allowed)){
              // check for errors
              if($file_error === 0){
                // check file size
                if($file_size <= 5000000){
                  // file destination
                  $file_destination = 'profileimages/' . $user_data['fullname'] .'.'. $file_ext;
          
                  // move uploaded file
                  if(move_uploaded_file($file_tmp, $file_destination)){
                    $citizenshipid=$user_data['citizenship'];
                    $sql="UPDATE registration SET profilepic = '$file_destination' WHERE citizenship =$citizenshipid";
                    mysqli_query($conn, $sql);  

                  }
                  else {
                    echo 'File could not be uploaded.';
                  }
                }
                else {
                  echo 'File size is too large.';
                }
              }
              else {
                echo 'There was an error uploading your file.';
              }
            }
            else {
              echo 'Invalid file type.';
            }
            return $file_destination;

          }
          
          
    }
//Date of bith to age
// Date of birth in YYYY-MM-DD format
function dob_to_age($conn){
  $citizenship = $_SESSION['citizenship'];
  $query = "select * from registration where citizenship = '$citizenship' limit 1";
  $result = mysqli_query($conn,$query);
  $user_data = mysqli_fetch_assoc($result);
  $date_of_birth=$user_data['dob'];

  // Calculate the age
  $today = new DateTime();
  $diff = $today->diff(new DateTime($date_of_birth));
  $age = $diff->y;
  return $age;
}

function castVote($citizenship, $candidate_id, $election_id,$conn) {

  $check_query = "SELECT * FROM voter_votes WHERE citizenship=? AND election_id=?";
  $insert_query = "INSERT INTO voter_votes (citizenship, candidate_id, election_id) VALUES (?, ?, ?)";

  $check_stmt = mysqli_prepare($conn, $check_query);
  mysqli_stmt_bind_param($check_stmt, 'ss', $citizenship, $election_id);
  mysqli_stmt_execute($check_stmt);
  mysqli_stmt_store_result($check_stmt);

  if (mysqli_stmt_num_rows($check_stmt) > 0) {
      echo "You have already cast your vote for this election.";
  } else {
      $insert_stmt = mysqli_prepare($conn, $insert_query);
      mysqli_stmt_bind_param($insert_stmt, 'iii', $citizenship, $candidate_id, $election_id);
      mysqli_stmt_execute($insert_stmt);
      echo "Your vote has been cast successfully!";
  }

  mysqli_stmt_close($check_stmt);

}





