<?php

session_start();
require_once 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="mt-4">Login</h3>
        <hr>
        <form action="signin_db.php" method="post">
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>

            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" value="<?php if (isset($_COOKIE['username_login'])){echo $_COOKIE['username_login']; }?>" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" value="<?php if (isset($_COOKIE['password_login'])){echo $_COOKIE['password_login']; }?>" name="password">
            </div>
            <div class="mb-3 form=check">
                <input type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <button type="submit" name="signin" class="btn btn-primary">Sign Up</button>
        </form>
        <hr>
        <p>Don't have an account yet? <a href="register.php">Register</a></p>
    </div>

</body>

</html>