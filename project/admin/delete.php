<?php
include("../connect.php"); 
include("checkadmin.php");
?>
<?php
$stmt = $pdo->prepare("DELETE FROM product WHERE Product_ID=?");
$stmt->bindParam(1,$_GET["Product_ID"]);
if($stmt->execute()){
  header("location:delete_form.php");
}
?>