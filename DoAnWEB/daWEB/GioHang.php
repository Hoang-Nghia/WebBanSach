<?php
include "database.php";

session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="css/cart.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    
    <style>
        .btn-submit {
            border: 1px solid;
            border-radius: 4px;
        }
        
h4{
    text-align: center;
}


.item-name {
    font-weight: bold;
}

.item-price {
    color: red; /* Change the color to your preference */
}

.quantityValue {
    width: 50px; /* Adjust the width as needed */
}

.close {
    color: red; /* Change the color to your preference */
    font-size: 20px;
}


    </style>
</head>

<body>
    <div class="card">
        <form action="Bill_order.php" method="post">

            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Sản phẩm của bạn</b></h4>
                            </div>
                        </div>
                    </div>
                    <?php

if (isset($_SESSION['cart']) && !empty($_SESSION['cart']))
{
    $listPro = $_SESSION['cart'];
        
    foreach ($listPro as $value) {
        $sql = "SELECT * from book where book_id = '$value'";
        $stmt = $pdo->query($sql);
        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row1 == 0) {
            continue;
        }

        echo '<div class="row border-top border-bottom">';
        echo '  <div class="row main align-items-center">';
        echo '    <div class="col-2"><img class="img-fluid" src="' . $row1['img'] . '"></div>';
        echo '    <div class="col">';
        echo '      <div class="row text-muted">' . $row1['book_name'] . '</div>';
        echo '      <div class="row">$' . $row1['price'] . '</div>';
        echo '    </div>';

        echo '  <div class="col"><input type="number" class="quantityValue" value="1" min="1" name="' . $row1['book_id'] . '"></div>';
        echo '    <div class="col">';
        echo '        <a href="DeleteGioHang.php?XoaIdSP=' . $row1['book_id'] . ' " class="close" aria-label="Delete">&#10005;</a>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
        
    }
}else{
    $listPro=0;
}
                   
                    
                    
                
                    
                    ?>

                    <div class="back-to-shop d-flex justify-content-between">
                        <a href="GiaoDien.php">
                            <span class="btn btn-primary">Quay lại</span>
                            <?php

                            ?>
                        </a>
                        <form action=""></form>
                        <button type="submit" name="btn-paybill" class="btn col-3 btn-submit">Tính tiền</button>
                        <div></div>
                    </div>

                </div>
        </form>

        

    </div>
    </div>
</body>
<?php
//============================kiểm tra giỏ hàng null và xóa sản phẩm nếu đặt thành công check từ session

?>

</html>