<?php 

require_once("config.php");

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM login WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
    
        if(password_verify($password, $user["password"])){
          
            session_start();
            $_SESSION["user"] = $user;
           
            header("Location: admin.php");
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Login </title>
            <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>
<body>
    <div class = "loginbox">
    <img src = "img/default.jpg" class = "avatar">
    <div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
        <p>&larr; <a href="index.php">Home</a>
        <h4>Login</h4>
       
        <form action="" method="POST">

            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Username atau email" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>

            <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk" />

        </form>
            
        </div>

        <div class="col-md-6">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>

    </div>
</div>
    
    </div>
</body>
</html>