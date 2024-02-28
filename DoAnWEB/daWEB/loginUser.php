
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .container {
  max-width: 400px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
}

.form-group {
  margin-bottom: 15px;
}

label {
  display: block;
  margin-bottom: 5px;
}

.form-control {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 3px;
}

button {
  background-color: #007bff;
  color: #fff;
  padding: 10px 15px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  margin-left: 110px;
}

button:hover {
  background-color: #0056b3;
}

a {
  display: inline;
  margin-top: 10px;
  margin-left: 20px;
  color: #007bff;
}

a:hover {
  text-decoration: underline;
}

</style>
</head>
<body>
<?php
include "database.php";
session_start();


if (isset($_POST["btnLogin"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Note: Use secure password hashing

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Successful login
        $_SESSION['email'] = $user['email'];
       
        header("Location: GiaoDien.php"); // Redirect to the dashboard or another authenticated page
        exit();
    } else {
        // Invalid credentials
        // echo "Invalid email or password";
        echo '<div style=" "> email hoặc mật khẩu có thể không đúng </div>';
    }

}

// echo md5("1");
?>
<div class="container">
  <h2>Đăng nhập</h2>
  <form action="" method="POST">
    <div class="form-group">
      <label for="email">Tên đăng nhập</label>
      <input type="email" class="form-control" id="email" placeholder="Nhập tên đăng nhập" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Mật khẩu</label>
      <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu" name="password">
    </div>
   
    <button type="submit" name="btnLogin" class="btn btn-primary">Đăng Nhập</button>
    <a href="registerUser.php">Đăng Ký</a>
  </form>
</div>

</body>
</html>
    
    
