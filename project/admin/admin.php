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
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php 

            if (isset($_SESSION['admin_login'])) {
                $admin_id = $_SESSION['admin_login'];
                $stmt = $pdo->query("SELECT * FROM users WHERE id = $admin_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>
        <h3 class="mt-4">Welcome Admin, <?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h3>
        <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../index.php">Home Page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="add_form.php">Add product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="delete_form.php">Remove / Edit Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="log.php">Check log Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="log_order.php">Check log Order</a>
        </li>
        </ul>
        <br>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>