<?php
    include "connect.php" ;
    session_start();
    if(empty($_SESSION['cart'])){
        $_SESSION['cart'] = array();
      }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='sty/index.css' rel='stylesheet'></link>
    <title>Document</title>
</head>
<body>

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
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------------>



    <ul>
        <div class="name_bar">
            <ul>
                <li class="furniture"><a href=""><h3><?php echo "Admin ". $row['firstname'] . ' ' ?></h3></a>
                <ul>
                    <li> <a style="color:red;" href="admin/admin.php">Admin Tools</a> </li>
                    <li> <a style="color:red;" href="logout.php">Logout</a> </li>
                </ul>
            </li>
            <li><h3 style="Color:red;"><?php
             if(isset($_SESSION['error'])){
                 echo $_SESSION['error'];
                 unset($_SESSION['error']);
                }
             ?></h3>
            </ul>
        </div>
    </ul>

    <!-- ----------------------------------------------------------------------------------------------------------------------------------------------\ -->
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
                <li class="furniture"><a href=""><h5><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></a>
                    <ul>
                        <li> <a style="color:red;" href="History.php">History</a> </li>
                        <li> <a style="color:red;" href="Distributioncenter.php">Distribution</a> </li>
                        <li> <a style="color:red;" href="logout.php">Logout</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
        <li> <a  href="cart.php?action=Check" class="a_tool">
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

<div class="top_bar">
    <ul>
        <li class="furniture"><a href="">Category</a>
            <ul>
                <li> <a href='category.php?keyword=เตียง'>เตียง</a> </li>
                <li> <a href='category.php?keyword=โต๊ะ'>โต๊ะ</a> </li>
                <li> <a href='category.php?keyword=เก้าอี้'>เก้าอี้</a> </li>
                <li> <a href='category.php?keyword=ของประดับ'>ของประดับ</a> </li>
            </ul>
        </li>
        <li class="furniture"><a href="">Style</a>
            <ul>
                <li> <a href="search_page.php?search=modern">modern</a> </li>
                <li> <a href="search_page.php?search=classic">classic</a> </li>
                <li> <a href="search_page.php?search=minimal">minimal</a> </li>
                <li> <a href="search_page.php?search=vintage">vintage</a> </li>
            </ul>
        </li>
    </ul>
</div>

<div class="promotion">
    <img src="img/promotion.png" alt="" width="100%">
</div>

<?php
    $num_CK = [0, 0, 0, 0];
    if(empty($_COOKIE["โต๊ะ"])) {
        setcookie("โต๊ะ", 0, time() + 3600 * 24 * 7);
    }else{
        $num_CK[0]=$_COOKIE["โต๊ะ"];
    }
    if(empty($_COOKIE["เตียง"])) {
        setcookie("เตียง", 0, time() + 3600 * 24 * 7);
    }else{
        $num_CK[1]=$_COOKIE["เตียง"];
    }
    if(empty($_COOKIE["ของประดับ"])) {
        setcookie("ของประดับ", 0, time() + 3600 * 24 * 7);
    }else{
        $num_CK[2]=$_COOKIE["ของประดับ"];
    }
    if(empty($_COOKIE["เก้าอี้"])) {
        setcookie("เก้าอี้", 0, time() + 3600 * 24 * 7);
    }else{
        $num_CK[3]=$_COOKIE["เก้าอี้"];
    }
    
    $Max_items = Max($num_CK);
    $Max_items_name = "โต๊ะ";
    if($num_CK[0]==$Max_items){
        $Max_items_name = "โต๊ะ";
    }else if($num_CK[1]==$Max_items){
        $Max_items_name = "เตียง";
    }else if($num_CK[2]==$Max_items){
        $Max_items_name = "ของประดับ";
    }else{
        $Max_items_name = "เก้าอี้";
    }
?>

<?php
    $stmt = $pdo->prepare("SELECT * from product where product_type like '%$Max_items_name%'"); 
    $stmt->execute();
    $num_produce=0;
    while ($row = $stmt->fetch()){
        $num_produce++;
    }
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page=1;
    }
    $record_show = 8;
    $offset = ($page - 1) * $record_show;
    $page_total = ceil($num_produce/$record_show);
?>
<div class="produce">
    <ul>
        <?php
        $stmt = $pdo->prepare("SELECT * from product where product_type like '%$Max_items_name%' limit $offset,$record_show"); 
        $stmt->execute();
        while ($row = $stmt->fetch()) :
        ?>
        <li>
            <div class="a_produce">
                <img src='img/<?=$row["Product_ID"]?>.jpg' width="250" height = "250"><br>
                <div class="name">
                    <?=$row ["Product_name"]?>
                </div>
                <div class="price">
                    <?=$row ["Product_price"]?> ฿
                </div>
                <div class="info">
                    <a href="detail-product.php?Product_ID=<?=$row["Product_ID"]?>">
                        ดูรายละเอียดสินค้า
                    </a>
                </div>
            </div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item <?=$page >1 ? '' : 'disabled' ?>">
        <a class="page-link" href="?page=<?=$page-1?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php for($i=1; $i <= $page_total; $i++):?>
            <li class="page-item <?=$page != $i ? '' : 'disabled'  ?>"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
        <?php endfor?>
        <li class="page-item <?=$page < $page_total ? '' : 'disabled' ?>" >
        <a class="page-link" href="?page=<?=$page+1?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
</nav>

</body>
</html>