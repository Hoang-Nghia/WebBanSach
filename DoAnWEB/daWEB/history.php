<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Book</title>
    <!-- Sử dụng Bootstrap CSS từ CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    <style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #007bff;
    }

    .book-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .book-card {
        width: 100%;
        background-color: #ffffff;
        border: 1px solid #ced4da;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    .book-card:hover {
    transform: scale(1.05);
}

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5rem;
        color: #343a40;
        margin-bottom: 10px;
    }

    .card-text {
        margin-bottom: 5px;
        color: #007bff;
    }
    .cart-icon {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    color: #007bff;
    
}


.icon {
    font-size: 24px; /* Điều chỉnh kích thước của biểu tượng */
    margin-right: 1px; /* Khoảng cách giữa biểu tượng và số lượng sản phẩm */
    text-decoration: none;
  
  }



.cart-count {
    background-color: black;
    color: white;
    border-radius: 50%;
    padding: 4px 8px;
    font-size: 12px;
}

</style>


</head>

<body>
    <?php
session_start();

    ?>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#"> Book Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="GiaoDien.php">Trang Chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="SanPhamUser.php">Sản Phẩm</a>
                </li>
                <a href="GioHang.php" class="cart-icon">
    <span class="icon">&#x1F6D2;</span> <!-- Đây là biểu tượng giỏ hàng, bạn có thể thay đổi nó -->
    <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?></span>
</a>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">Lịch sử </a>
                </li>
                <li class="">
        <?php

        if(isset($_SESSION['email']))
        {
            echo '<a class="btn btn-primary" href="Dangxuat.php">Đăng Xuất</a> ';
        }else {
          echo '<a class="btn btn-primary" href="loginUser.php">Đăng nhập</a>';
        }
        ?>
                  
          </li>
            </ul>
        </div>
    </nav>

    <!-- Nội dung trang -->
    <div class="container mt-5">
    <h1>Danh sách đơn hàng</h1>

    <div class="book-container">
        <?php
        include "database.php";
        // session_start();
        if( !isset($_SESSION['email']))
        {
            echo '<script>
            var message = "Bạn phải đăng nhập";
            var dialog = document.createElement("div");
            dialog.style.position = "fixed";
            dialog.style.top = "50%";
            dialog.style.left = "50%";
            dialog.style.transform = "translate(-50%, -50%)";
            dialog.style.padding = "20px";
            dialog.style.border = "1px solid #ccc";
            dialog.style.backgroundColor = "#fff";
            dialog.innerHTML = "<p>" + message + "</p><button onclick=\"closeDialog()\">OK</button>";
            document.body.appendChild(dialog);
        
            function closeDialog() {
                document.body.removeChild(dialog);
                window.location.href = "loginUser.php";
            }
        </script>';
        exit();
        }
        $user_email = $_SESSION['email'];
       

        // Retrieve orders for the specified user email
        $query = "SELECT o.order_id, o.order_date, o.status, od.book_id, od.quantity, od.price ,b.book_name
                  FROM `order` o
                  JOIN `order_detail` od ON o.order_id = od.order_id
                  JOIN `book` b ON od.book_id =b.book_id
                  WHERE o.email = :user_email";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->execute();

        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display orders
        foreach ($orders as $order) {
            echo '<div class="book-card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Đơn hàng #' . $order['order_id'] . '</h5>';
            echo '<p class="card-text">Ngày đặt hàng: ' . $order['order_date'] . '</p>';
            echo '<p class="card-text">Trạng thái: ' . $order['status'] . '</p>';
            echo '<p class="card-text">Tên Sách : ' . $order['book_name'] . '</p>';
            echo '<p class="card-text">Số lượng: ' . $order['quantity'] . '</p>';
            echo '<p class="card-text">Giá: ' . $order['price'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>



</body>
<!-- Sử dụng Bootstrap JS và Popper.js từ CDN -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</html>