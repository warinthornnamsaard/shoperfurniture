<?php
include("connect.php");
$keyword = $_GET["search"];


$stmt = $pdo->prepare("SELECT * FROM product where CONCAT(Product_type, Product_style, Product_info, Product_name) LIKE '%$keyword%'");
$stmt->execute();
?>

<body>
  <?php while($row = $stmt->fetch()): ?>
    <?php echo $row["Product_name"]?>
  <?php endwhile;?>
</body>

