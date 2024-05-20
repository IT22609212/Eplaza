<?php

include 'config.php';
session_start();
$seller_id = $_SESSION['seller_id'];

if(!isset($seller_id)){
   header('location:seller_login.php');
};

if(isset($_GET['logout'])){
   unset($seller_id);
   session_destroy();
   header('location:seller_login.php');
};



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

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

<div class="container">

<div class="user-profile">

   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `seller_form` WHERE id = '$seller_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <p> username : <span><?php echo $fetch_user['name']; ?></span> </p>
   <p> email : <span><?php echo $fetch_user['email']; ?></span> </p>
   <div class="flex">
      <a href="seller_login.php" class="btn">login</a>
      <a href="seller_register.php" class="option-btn">register</a>
      <a href="seller_page.php?logout=<?php echo $seller_id; ?>" onclick="return confirm('are your sure you want to logout?');" class="delete-btn">logout</a>
   </div>

</div>


</body>
</html>