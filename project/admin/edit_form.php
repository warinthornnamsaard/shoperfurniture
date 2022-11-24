<?php
include("../connect.php"); 
include("checkadmin.php");
date_default_timezone_set('asia/bangkok');
$date = date('Y-m-d h:i:s'); 
?>
<?php 
    if (isset($_SESSION['admin_login'])) {
        $admin_id = $_SESSION['admin_login'];
        $stmt1 = $pdo->query("SELECT * FROM users WHERE id = $admin_id");
        $stmt1->execute();
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    }
    ?>
<?php
$stmt = $pdo->prepare("SELECT * FROM product WHERE Product_ID = ?");
$stmt->bindParam(1,$_GET["Product_ID"]);
$stmt->execute();
$row = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Document</title>
  <style>
    form{
      display:inline;
    }
  </style>
</head>
<body style="margin: 15px;">
  <form action="edit.php" method="post">
    <input type="hidden" name="Product_ID" value="<?=$row["Product_ID"]?>"><br>
    Product Type : <input type="text" name="Product_type" value="<?=$row["Product_type"]?>"><br>
    Product Style : <input type="text" name="Product_style" value="<?=$row["Product_style"]?>"><br>
    Product Info : <input type="text" name="Product_info" value="<?=$row["Product_info"]?>"><br>
    Product Num : <input type="text" name="Product_num" value="<?=$row["Product_num"]?>"><br>
    Product Name : <input type="text" name="Product_name" value="<?=$row["Product_name"]?>"><br>
    Product Price : <input type="text" name="Product_price" value="<?=$row["Product_price"]?>"><br>
    <input type="text" name="id" value="<?=$admin_id?>" hidden><br>
    <input type="hidden" name="Product_ID" value="<?=$row["Product_ID"]?>"><br>
    <input type="datetime-local" name="Time" value="<?=$date?>" hidden>
    NOTE : <input type="text" name="Note"><br>
<br>
    <button type="Submit" class="btn btn-outline-dark">Update</button>
</form>

<form action="delete_form.php" >  
  <button type="submit"  class="btn btn-warning">Back</button>
</form>
</body>
</html>