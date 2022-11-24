<?php
include("connect.php");
session_start();

if (isset($_SESSION['admin_login'])) {
  $_SESSION['error'] = 'Admin ไม่สามารถซื้อได้ !';
  header('location: index.php');
  
}else if(!isset($_SESSION['user_login'])){
  $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ';
  header('location: signin.php');
}

if($_GET["action"] == "add" ){
  $pid = $_GET['Product_ID'];

  $cart_item = array(
    'Product_ID' => $pid,
    'Product_name'=> $_GET['Product_name'],
    'Product_price' => $_GET['Product_price'],
    'Product_num' => $_GET['Product_num'],
    'qty' => $_POST['qty']
  );


  if(empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }

  if(array_key_exists($pid, $_SESSION['cart'])){
    $_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
  }else{
    $_SESSION['cart'][$pid] = $cart_item;

  }

} else if($_GET["action"] =="update"){
  $pid = $_GET["Product_ID"];
  $qty = $_GET["qty"];
  $_SESSION['cart'][$pid]['qty'] = $qty;

} else if($_GET["action"]=="delete"){
  $pid = $_GET['Product_ID'];
  unset($_SESSION['cart'][$pid]);
} else if($_GET["action"]=="Check"){
  
}else if ($_GET["action"]=="Submit"){
  if(empty($_SESSION['cart'])){
    $_SESSION['cart'] = array();
  }
}
?>

<html>
  <head>
    <link rel="stylesheet" href="sty/cart.css">
    <script>
      function update(pid){
        var qty = document.getElementById(pid).value;
        document.location = "cart.php?action=update&Product_ID="+ pid + "&qty=" + qty;
      }
    </script>
    <style>
      .showcart{
        margin:20px;
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="sty/cart.css">
  </head>
  <body>

  <div class="content">
<div class="top">
    <div class="logo"><a href="index.php"><img src="img/logo.png" alt="logo" width="306" height="108" ></a></div>
    <form action="search_page.php?search=" method ="get">
        <div class="s-box">
            <img src ="img/search.png" class="s-icon">
            <input type="text" name="search" id="search" placeholder="Search">
            <input type="submit" hidden>
        </div>
    </form>
    <?php 
    if (isset($_SESSION['admin_login'])) {
        $admin_id = $_SESSION['admin_login'];
        $stmt = $pdo->query("SELECT * FROM users WHERE id = $admin_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <ul>
        <li> <h4><?php echo "Admin ". $row['firstname'] . ' ' ?></h4> </li>
        <li> <a href="admin/admin.php">Admin Tools</a> </li>
        <li> <a style="color:red;" href="logout.php">Logout</a> </li>
    </ul>
    <?php
    } else if (isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $pdo->query("SELECT * FROM users WHERE id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <ul>
        <div class="name_bar">
            <ul>
                <li class="furniture"><a href=""><h3><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></a>
                    <ul>
                        <li> <a style="color:red;" href="History.php">History</a> </li>
                        <li> <a style="color:red;" href="Distributioncenter.php">Distribution</a> </li>
                        <li> <a style="color:red;" href="logout.php">Logout</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
    </ul>
    <?php
    } else{
    ?>
        <ul>
            <li> <a href="signin.php">Log in</a></li>
            <li> / </li>
            <li> <a href="register.php">Register</a> </li>
        </ul>
    <?php } ?>
</div>
          <header >
                  <div class="top_bar">
                    <ul>
                      <li class="furniture"><a href="">Category</a>
                      <ul>
                        <li><a href='category.php?keyword=เตียง'>เตียง</a></li>
                        <li><a href='category.php?keyword=โต๊ะ'>โต๊ะ</li>
                        <li><a href='category.php?keyword=เก้าอี้'>เก้าอี้</a></li>
                        <li><a href='category.php?keyword=ของประดับ'>ของประดับ</a>
</li>
                      </ul>
                    </li>
                    
                    <li class="furniture"><a href="">Style</a>
                    <ul>
                      <li><a href="search_page.php?search=modern">modern</a></li>
                      <li> <a href="search_page.php?search=classic">classic</a> </li>
                      <li><a href="search_page.php?search=minimal">minimal</a></li>
                      <li><a href="search_page.php?search=vintage">vintage</a></li>
                    </ul>
                  </li>
            </ul>
          </div>
        </header>

        <div class="ccart">
          <?php
    date_default_timezone_set('asia/bangkok');
    $date = date('Y-m-d h:i:s');
    $sum = 0;
    foreach($_SESSION['cart'] as $item){
      $sum += $item['Product_price'] * $item["qty"];
      ?>
      
      <div class="incart" style="margin:20px; margin-left:100px; display:flex;">  <!-- image -->
        <img src="img/<?=$item["Product_ID"]?>.jpg"width="250" height="250"><br>
        <div class="cart_info" style="margin:20px;margin-left:40px; font-size:20px;"> <!-- info -->
          
            <div>ชื่อ: <?=$item["Product_name"]?></div><br>
            <div>ราคา: <?=$item["Product_price"]?></div><br>
          
          
          
          <form action="order.php" method="post">
          <input type="number" class="number" name=qty id="<?=$item["Product_ID"]?>" value="<?=$item["qty"]?>" onchange='update(<?=$item["Product_ID"]?>)'>
                <input type="datetime-local" name="Time" value="<?=$date?>" hidden>
                <input type="text" name="Status" value ="wait" hidden>
                <input type="text" name="Product_ID" value=<?=$item["Product_ID"]?> hidden>
                <input type="text" name="id_customer" value=<?=$user_id?> hidden>
                <br><br>
                <a href="?action=delete&Product_ID=<?=$item["Product_ID"]?>"><button type ="button" class="slide"style="text-decoration:none;">&nbsp</button></a>
              </div>
            </div>
            <br>
            <hr>
            <?php } ?>
            <input type="number" name=sum value=<?=$sum?> hidden> 
          </div>
          <div class="summ" style ="text-align: center; font-size:20px;">
            Total = <?=$sum?> บาท  <br>
            <a href="search_page.php?search="><button type = "button" class="slide1" style="text-decoration:none;">&nbsp</button></a>
            <button type="submit" style="border-radius: 5px; " class="order" name="submit" class="btn btn-outline-dark">&nbsp</button>
            </div>
        </form>
        
      
      
<?php

if(isset($_POST['submit'])){
  $stmt1 = $pdo->prepare("INSERT INTO order_list VALUES('',?,?)");
  $stmt1->bindParam(1,$_POST["Time"]);
  $stmt1->bindParam(2,$_POST["sum"]);
  $stmt1->execute();
}
?>

  </body>
</html>