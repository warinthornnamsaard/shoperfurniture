<?php include "connect.php" ;

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href='sty/search.css' rel='stylesheet'></link>
    <link href='sty/index.css' rel='stylesheet'></link>
    <title>Search</title>

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
<style>
          *{
            text-align:center;
          }

          div.history{
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 36px;
            color: gray;
            font-weight: bold; 
          }
          p{
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 22px;
            color: gray;
            font-weight: bold; 
          } 
          table {
            margin:auto;
            border-color: #000; 
            border: 1px;
            border-collapse: collapse;
            font-size: large; 
            line-height: 24px; 
            font-family: Verdana, Arial, Helvetica, sans-serif; 
          }
          th { 
            border-top: 1px solid #777; 
            border-bottom: 1px solid #777; 
            background-color: black; 
            color: white;  
            text-align: left;  
          } 
          td { 
            border-bottom: 1px solid #BBB; 
            background-color: #EEE; 
            color: #000; 
          } 
          td, th { 
            padding: 0.2em 0.5em 0.2em 0.5em; 
          } 
          td+td, th+th { 
            border-left: 1px solid #BBB; 
          }
</style>
        <body>
        <div class="history">Distribution Center</div>
        <p>จุดรับสินค้า</p>
          <table>
            <tr>
            <th>Name</th>
            <th>address</th>
            <th>time</th>
            <th>map</th>
            </tr>
        <?php
            $json_data = file_get_contents("Distribution.json");
            $distribution = json_decode($json_data, true);
            if(count($distribution) != 0){
                foreach($distribution as $distribution){
                    ?>
                    <tr>
                        <td><?php echo $distribution['namedis'] ?></td>
                        <td><?php echo $distribution['address'] ?></td>
                        <td><?php echo $distribution['time'] ?></td>
                        <td><iframe src="<?php echo $distribution['position'] ?>"></iframe></td>
                    </tr>
                    <?php
                }
            }
        ?>

        </table>
