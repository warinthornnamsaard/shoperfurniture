<?php
  include("connect.php"); 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="sty/style_detail.css">
    <link href='sty/index.css' rel='stylesheet'></link>
    <title>Document</title>
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
                        <li> <a style="color:red;" href="logout.php">Logout</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
        <li> <a  href="" class="a_tool">
                <?php 
                if(sizeof($_SESSION['cart'])==NULL){
                  echo 0;
                } else {
                  echo sizeof($_SESSION['cart']);
                }
                ?>
            <i class="fa-solid fa-cart-plus"></i></a> </li>
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
<?php     $keyword = $_GET["Product_ID"];
    $stmt = $pdo->prepare("SELECT * from product where Product_ID = $keyword");
    $stmt->execute();
    ?>
    <?php while($row = $stmt->fetch()){
        ?>
        
        <div class="show">
            <div class="grop">
            <a>
                <img src="img/<?=$row["Product_ID"]?>.jpg" alt="" width="250" height="250"><br>
                <br>
            </a>
            </div>
            <div class="info">
                <br>
                <?=$row["Product_name"]?><br>
                <?=$row["Product_info"]?>
                <p><?=$row["Product_style"]?></p>
            </div>
            <form action="cart.php?action=add&Product_ID=<?=$row["Product_ID"]?>&Product_name=<?=$row["Product_name"]?>&Product_info=<?=$row["Product_info"]?>&Product_style=<?=$row["Product_style"]?>&Product_num=<?=$row["Product_num"]?>&Product_price=<?=$row["Product_price"]?>" method="post">
            <input type="text" name="qty" value="1">
            <input type="submit" value="เพิ่ม">
          </form>
        </div>
        <hr>
    </div>
<?php }?>

</body>
</html>