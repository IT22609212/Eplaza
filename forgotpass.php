<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $newPassword = mysqli_real_escape_string($conn, $_POST['password']);
   $confirmNewPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);

   // Check if the new password and confirm new password match
   if($newPassword !== $confirmNewPassword) {
      $message[] = 'Passwords do not match!';
   } else {
      // Retrieve the user from the database based on the provided email
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('Query failed');

      if(mysqli_num_rows($select) > 0) {
         $row = mysqli_fetch_assoc($select);
         $userId = $row['id'];

         // Update the user's password with the new password
         mysqli_query($conn, "UPDATE `user_form` SET password = '".md5($newPassword)."' WHERE id = '$userId'") or die('Query failed');

         $message[] = 'Password reset successfully!';
      } else {
         $message[] = 'User not found!';
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
   <title>Reset Password</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<div class="form-container">

   <form action="" method="post">
      <h3>Reset Password</h3>
      <input type="email" name="email" required placeholder="Enter email" class="box">
      <input type="password" name="password" required placeholder="Enter new password" class="box">
      <input type="password" name="confirm_password" required placeholder="Confirm new password" class="box">
      <input type="submit" name="submit" class="btn" value="Reset Password">
      <p>Remembered your password? <a href="user_login.php">Login</a></p>
   </form>

</div>

</body>
</html>
