<?php
include("../connect.php"); 
include("checkadmin.php");
?>

<html>
<head><meta charset="UTF-8"></meta>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script>
  function confirmDelete(Product_ID){
    var ans = confirm("ต้องการลบสินค้า" + Product_ID);
    if(ans==true){
      document.location = "delete.php?Product_ID=" + Product_ID;
    }
  }
</script>

<style>
  form{
    display:inline-block;
  }
</style>
</head>
<body style="margin:15px;">

<?php
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();


while($row = $stmt->fetch()){
  ?>
  
  ชื่อสินค้า : <?=$row["Product_name"]?><br>
  ที่อยู่ : <?=$row["Product_type"]?><br>
  ราคารวม : <?=$row["Product_style"]?><br>
  <br>

  <button type="button" class="btn btn-outline-danger" onclick='confirmDelete("<?=$row["Product_ID"]?>")'>Delete</button>

  <form action="edit_form.php?Product_ID=<?=$row["Product_ID"]?>" method="post">
  <button type="Submit" class="btn btn-outline-primary">Edit</button>
  </form>
  <hr>
  <?php } ?>
<form action="admin.php">
<button type="submit" class="btn btn-outline-dark">Main Page</button>
</form>
</body>
</html>