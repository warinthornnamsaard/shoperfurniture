<?php
include("../connect.php"); 
include("checkadmin.php");
?>

<?php
$stmt = $pdo->prepare("UPDATE product SET Product_type=? , Product_style=? , Product_info=? , Product_num=? , Product_name=? , Product_price=? WHERE Product_ID=? ");

$stmt->bindParam(1,$_POST["Product_type"]);
$stmt->bindParam(2,$_POST["Product_style"]);
$stmt->bindParam(3,$_POST["Product_info"]);
$stmt->bindParam(4,$_POST["Product_num"]);
$stmt->bindParam(5,$_POST["Product_name"]);
$stmt->bindParam(6,$_POST["Product_price"]);
$stmt->bindParam(7,$_POST["Product_ID"]);

if($stmt->execute()){
  echo "แก้ไขข้อมูลสินค้าหมายเลข"." " .$_POST["Product_ID"]." สำเร็จ <br>" ; 
  echo "Type : " .$_POST["Product_type"]."<br>";
  echo "Style : " .$_POST["Product_style"]."<br>";
  echo "Info : " .$_POST["Product_info"]."<br>";
  echo "จำนวน : " .$_POST["Product_num"]."<br>";
  echo "Name : " .$_POST["Product_name"]."<br>";
  echo "Price : " .$_POST["Product_price"]." บาท" ."<br>";

}
?>
<?php
$stmt1 = $pdo->prepare("INSERT INTO edit VALUES('',?,?,?,?)");
$stmt1->bindParam(1,$_POST["id"]);
$stmt1->bindParam(2,$_POST["Product_ID"]);
$stmt1->bindParam(3,$_POST["Time"]);
$stmt1->bindParam(4,$_POST["Note"]);
$stmt1->execute();
$Rank= $pdo->lastInsertId();
?>

<html>
  <style>
    form{
      display:inline-block;
    }
  </style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <body style="margin: 15px;">
  <br>
    <form action="admin.php">
<button type="submit" class="btn btn-outline-dark">Main Page</button>
</form>

<form action="delete_form.php">
<button type="submit" class="btn btn-outline-primary">Edit More?</button>
</form>
  </body>
</html>