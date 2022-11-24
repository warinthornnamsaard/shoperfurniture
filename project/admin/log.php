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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Document</title>
</head>
<style>

  body{
    text-align:center;

  }
  table, tr ,td{
    border: 1px solid black;
    text-align:center;
    margin:auto;
    
  }
</style>
<body>
  <table >
  <tr>
      <td>ID_Admin</td>
      <td>Product_ID</td>
      <td>Time</td>
      <td>Note</td>
    </tr>
    <?php 

    $stmt = $pdo->prepare("SELECT * from edit ");
    $stmt->execute();
    while($row = $stmt->fetch()){
      $date = $row["Time"];
      $dateArr = explode('-',$date);
      $dateThai = ($dateArr['0']+543).'/'.$dateArr[1].'/'.$dateArr[2];
    ?>

    <tr>
      <td><?=$row["id"]?></td>
      <td><a href="../infoproduct.php?Product_ID=<?=$row["Product_ID"]?>"><?=$row["Product_ID"]?></a></td>
      <td><?=$dateThai?></td>
      <td><?=$row["Note"]?></td>
    </tr>
<?php } ?>
</table>
<br>
<form action="admin.php">
<button type="submit" class="btn btn-outline-dark">Main Page</button>
</form>
</body>
</html>