<?php
include("../connect.php"); 
include("checkadmin.php");
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"></link>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    body{
      margin: 15px;
      text-align:center;
    }

  </style>
  <title>เพิ่มรายการสินค้า</title>
</head>
<body>
      <h1>ADD Product</h1><br>
      <form action="add.php" method = "post" enctype="multipart/form-data">
      <div class="form-group">
        <div id="check">
        <input type="text" name = "Product_ID" hidden>
        Product_type : <input type="text" name = "Product_type" required> <br><br> 
        Product_style : <input type="text" name = "Product_style" required> <br><br> 
        Product_info : <input type="text" name = "Product_info" required> <br><br> 
        Product_num : <input type="text" name = "Product_num" required> <br><br> 
        Product_name : <input type="text" name = "Product_name" required> <br><br> 
        Product_price : <input type="text" name = "Product_price" required> <br><br>
        <input type="text" name = "name_jng" hidden>
        <input type="file" name="image"><br/>
        <br>
        <button type="submit" class="btn btn-outline-secondary" id="sent">ADD</button>
        </div>
      </form>
      <br>
      <br>
      <br>
      <form action="admin.php">
<button type="submit" class="btn btn-outline-dark">Main Page</button>
</form>
    </div>
  </div>
  

  <?php
      $stmt = $pdo->prepare("SELECT * FROM product where Product_name LIKE ? ");

      if(!empty($_GET))
      $value = '%' .$_GET["search"] . '%';

      $stmt->bindParam(1,$value);
      $stmt->execute();

      while($row = $stmt->fetch()){
        ?>

        ชื่อสินค้า : <?=$row["Product_name"]?><br>
        <hr>

      <?php } ?>
</body>
</html>