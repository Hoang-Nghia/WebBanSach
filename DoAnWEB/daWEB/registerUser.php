<?php
include "database.php";
// session_start();

if (isset($_POST["btnRegister"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Note: Use secure password hashing
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];

    // Check if the email is already registered
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $error = "Email already registered";
    } else {
        // Insert the new user into the database
        $insertStmt = $pdo->prepare("INSERT INTO users (email, password, name, address, phone) VALUES (:email, :password, :name, :address, :phone)");
        $insertStmt->bindParam(":email", $email);
        $insertStmt->bindParam(":password", $password);
        $insertStmt->bindParam(":name", $name);
        $insertStmt->bindParam(":address", $address);
        $insertStmt->bindParam(":phone", $phone);

        $result = $insertStmt->execute();

        if ($result) {
            // $_SESSION['email'] = $email;
            header("Location: LoginUser.php"); // Redirect to the dashboard or another authenticated page
            exit();
        } else {
            $error = "Registration failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
  margin-left: 140px;
}

button:hover {
  background-color: #0056b3;
}

a {
  display: block;
  margin-top: 10px;
  text-align: center;
  color: #007bff;
}

a:hover {
  text-decoration: underline;
}

</style>
</head>
<body>

<div class="container mt-5">
<h2>Đăng ký </h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Tên đăng nhập</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary" name="btnRegister">Đăng Ký</button>
    </form>
</div>

<!-- Include Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
