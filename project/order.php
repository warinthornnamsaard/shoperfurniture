<?php 
include("connect.php");
session_start();
$stmt1 = $pdo->prepare("INSERT INTO order_list VALUES('',?,?)");
$stmt1->bindParam(1,$_POST["Time"]);
$stmt1->bindParam(2,$_POST["sum"]);
$stmt1->execute();



$stmt0 = $pdo->prepare("SELECT MAX(Order_ID)as ID_Order FROM order_list");
$stmt0->execute();
$row1= $stmt0->fetch();

$ID_ORDER = $row1["ID_Order"];

foreach($_SESSION['cart'] as $cart => $itex){
  $stmt2 = $pdo->prepare("SELECT * FROM product Where Product_ID = $itex[Product_ID] ");
  $stmt2->execute();
  $row2= $stmt2->fetch();
  
  $New_num = $row2["Product_num"]- $itex["qty"];

  $stmt3 = $pdo->prepare("UPDATE product set Product_num = ? Where Product_ID = ? ");
  $stmt3->bindParam(1,$New_num);
  $stmt3->bindParam(2,$itex["Product_ID"]);
  $stmt3->execute();

  $stmt = $pdo->prepare("INSERT INTO shoporder VALUES('',?,?,?,?,?)");
  $stmt->bindParam(1,$ID_ORDER);
  $stmt->bindParam(2,$_POST["Status"]);
  $stmt->bindParam(3,$itex["Product_ID"]);
  $stmt->bindParam(4,$itex["qty"]);
  $stmt->bindParam(5,$_POST["id_customer"]);
  $stmt->execute();
  $row=$stmt->fetch();
  
}
  unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Order Success</title>
</head>
<body>
  สั่งซื้อสินค้าสำเร็จ

  <form action="index.php">
<button type="submit" class="btn btn-outline-dark">Main Page</button>
</body>
</html>
