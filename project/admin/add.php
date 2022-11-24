<?php
include("../connect.php"); 
include("checkadmin.php");
?>
<?php
$stmt = $pdo->prepare("INSERT INTO product VALUES(?,?,?,?,?,?,?)");
$stmt->bindParam(1,$_POST["Product_ID"]);
$stmt->bindParam(2,$_POST["Product_type"]);
$stmt->bindParam(3,$_POST["Product_style"]);
$stmt->bindParam(4,$_POST["Product_info"]);
$stmt->bindParam(5,$_POST["Product_num"]);
$stmt->bindParam(6,$_POST["Product_name"]);
$stmt->bindParam(7,$_POST["Product_price"]);
$stmt->execute();
$Product_ID = $pdo->lastInsertId();
?>

<?php
    $imgid = $pdo->prepare("SELECT MAX(Product_ID) as New_Product From product");
    $imgid->execute();
    $row2 = $imgid->fetch();
    $New_imgid = $row2["New_Product"];

    $type = strrchr($_FILES['image']['tmp_name'],".");
    $newname = $New_imgid.'.jpg';
    
    isset( $_FILES['image']['tmp_name'] ) ? $image_tmp_name = $_FILES['image']['tmp_name'] : $image_tmp_name = "";
    isset( $_FILES['image']['name'] ) ? $image_name = $_FILES['image']['name'] : $image_name = "";
    if( !empty( $image_tmp_name ) && !empty( $image_name ) ) {
        if( move_uploaded_file($image_tmp_name, "../img/".$newname) ) echo "อัปโหลดรูปภาพสำเร็จ";
    }
?>

<html>
  <head><meta charset="UTF-8"></head>
<body>
  เพิ่มสินค้าสำเร็จ คือ <?=$_POST["Product_name"]?><br><br>
  <a href="add_form.php">Add more</a>
</body>
</html>