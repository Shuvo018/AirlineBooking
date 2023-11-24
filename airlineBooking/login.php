<?php
include("header.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $sql = "SELECT * FROM user_profile WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                if(password_verify($password, $user["password"])){
                    $_SESSION["user"] = true;
                    $_SESSION["user_id"] = $user['id'];
                    // echo $_SESSION["user_id"];
                    header("Location: index.php");
                    // die();
                }else{
                echo"<div class='alert alert-danger'>Password does not match {$user['password']} </div>";
                }
            }else{
                echo"<div class='alert alert-danger'>Email does not match </div>";
            }
        }
        ?>
        
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter password:" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="login" class="btn btn-primary">
            </div>
        </form>
        <div><p>Not registered yet <a href="registration.php">Registration here</a></p></div>
    </div>
</body>
</html>