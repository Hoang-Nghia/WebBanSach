<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cart.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->

</head>

<body>
    <?php
    include "database.php";
    session_start();
    // $stm = $pdo->query("select email from users ");
    // $row1 = $stmt->fetch(PDO::FETCH_ASSOC);

    // echo $row1;


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn-order'])) {
            $listCart = $_SESSION['cart'] ?? null;
            // $total = $_POST['total'];



            // Check if the user is logged in
            if (!isset($_SESSION['email'])) {
                // Redirect to the login page
                header("Location: login.php");
                exit();
            }


            if ($listCart == null) {
                echo '<h1>Giỏ hàng của bạn chưa có gì<h1>';
                echo '<h3>Hãy quay lại mua sắm<h3>';
                echo '<br><a href = "GiaoDien.php"> Về trang chủ</a>';
                exit();
            }

        }
    }

    ?>

</body>

</html>