<?php


$db = mysqli_connect('localhost','root','','project_shop');

if(isset($_POST['username_check'])){
  $username = $_POST['username'];
  $sql = "SELECT * FROM users WHERE username = '$username' ";
  $result = mysqli_query($db, $sql);

  
  if(mysqli_num_rows($result) > 0){
    echo 'taken';
  } else{
    echo 'not_taken';
  }
  exit();
 
}
?>