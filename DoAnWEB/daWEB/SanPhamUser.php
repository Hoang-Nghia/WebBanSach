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
        .book-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
          
            margin-left: 80px;
           
        }
      
        h1 {
            text-align: center;
        }
        

        .book-card {
            width: 220px;
            /* margin: 20px; */
            margin-left: 30px;
            margin-top: 20px;
         
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            
        }

        .card-img-top {
            max-height: 230px;
            width: 170px;
            margin-left: 10px;
        }
   

        .card-title {
            color: black;
        }

        .card-text {
            color: black;
        }

        .card-footer {
            display: flex;
            align-items: center;
          
        }

        .sidebar {
            height: 100%;
            width: 160px;
            position: absolute;
            z-index: 2;
            top: 90px;
            left: 0;
           
            padding-right: 12px;
            /* padding-top: 60px; */



        }

        .sidebar a {
            /* padding: 8px 16px; */
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;

        }

        .sidebar a:hover {
            background-color: #ced4da;
        }

        .filter-group {
            margin-bottom: 10px;
            margin-left: 15px;

        }

        .form-inline {
            display: flex;
            align-items: center;

            padding-left: 450px;
        }

        .form-group {
            margin-right: 8px;
        }

        .form-control {
            width: 200px;
        }

        .form-controls {
            margin-right: -20px;
            width: 140px;
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
        <a class="navbar-brand" href="#">Store Book</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="GiaoDien.php">Trang Chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Sản Phẩm</a>
                </li>
                <a href="GioHang.php" class="cart-icon">
    <span class="icon">&#x1F6D2;</span> 
    <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '0'; ?></span>
</a>                  
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">Lịch sử</a>
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
        
        <div class="row">
            <!-- Thanh menu bên trái -->
            <div class="col-md-3">
                <div class="sidebar">
                    <form action="" method="GET">
                        <h5>Thể loại</h5>
                        <select class="form-controls" id="categoryDropdown" name="cat">
                            <option value="all">Tất cả</option>
                            <?php
                            include 'database.php';
                            $stm = $pdo->query("select * from category");
                            $row1 = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($row1 as $row) {
                                echo '<option value="' . $row["cat_id"] . '"> ' . $row["cat_name"] . '</option>';
                            }
                            ?>
                        </select>
                        <h5>Nhà Sản Xuất</h5>
                        <select class="form-controls" id="categoryDropdown" name="pub">
                        <option value="all">Tất cả</option>
                            <?php
                            include 'database.php';
                            $stm = $pdo->query("select * from publisher");
                            $row1 = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($row1 as $row) {
                                echo '<option value="' . $row["pub_id"] . '"> ' . $row["pub_name"] . '</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" value="Lọc" name="send">
                        </form>
                </div>
                
            </div>
        </div>
        <?php
        include "database.php";
        $sql="select * from book";
        $catogory = isset($_GET['cat']) ? $_GET['cat'] : 'all';
        $pub = isset($_GET['pub']) ? $_GET['pub'] : 'all';
        if($catogory !="all"||$pub !="all")
        {
            $sql .=" where 1=1";
            if($catogory !="all")
            {
                $sql .=" AND cat_id = '$catogory'";
            }
            if($pub !="all")
            {
                $sql .=" AND pub_id = '$pub'";
            }

        } elseif(isset($_GET['btnFind'])) {
            $search=$_GET['search'];
               $sql.=" WHERE book_name LIKE '%$search%'
                          OR description LIKE '%$search%'
                          OR price LIKE '%$search%' " ;
        }

        $stmt=$pdo->query($sql);
        $row1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- Nội dung trang -->
        <div class="col-md-12">
            <!-- Add a Search Form -->
            <form method="GET" action="" class="form-inline">
                <div class="form-group">
                    <label for="search"></label>
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm ">
                </div>
                <input type="submit" name="btnFind" value="Tìm kiếm" class="btn btn-primary"></input>
            </form>

            <!-- Sản phẩm 1 -->

            <div class="book-container">
                <?php foreach ($row1 as $row) : ?>
                    <div class="card book-card">
                        <img src="<?php echo $row['img']; ?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><Strong style="color: red">Tên: </Strong> <?php echo $row['book_name']; ?></h5>
                            <p class="card-text"><Strong style="color: red">Mô tả: </Strong> <?php echo substr($row['description'], 0, 200)  ?></p>
                            <p class="card-text"><strong style="color: red">Giá:</strong> <?php echo $row['price']; ?></p>
                        </div>
                        <div class="card-footer">
                        <a href="Xulygiohang.php?book_id=<?php echo $row['book_id']; ?>"  class="btn btn-primary">Thêm giỏ</a>
                        <form action="" method="get">
  <button type="button"  class="btn btn-primary ml-2" data-toggle="modal" data-target="#chiTietModal<?php echo $row['book_id']; ?>">
    Chi Tiết
  </button>

  <!-- Modal -->
  <div class="modal fade" id="chiTietModal<?php echo $row['book_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="chiTietModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-family: 'Times New Roman'; font-size: 25px;" class="modal-title" id="chiTietModalLabel">Thông Tin Chi Tiết</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Populate modal with information from the database -->
          <img style=" margin-left: 100px; width: 300px;" src="<?php echo $row['img']; ?>" class="card-img-top" alt="" >
          <p><strong style="color: red;">Tên: </strong><?php echo $row['book_name']; ?></p>
          <p><strong style="color: red;">Mô tả: </strong> <?php echo $row['description']; ?></p>
         
          <?php
          // Assuming you have a database connection named $pdo
          $manufacturerId = $row['pub_id'];
          $genreId = $row['cat_id'];

          // Fetch manufacturer name
          $manufacturerStmt = $pdo->prepare("SELECT pub_name FROM publisher WHERE pub_id = :id");
          $manufacturerStmt->bindParam(':id', $manufacturerId);
          $manufacturerStmt->execute();
          $manufacturerName = $manufacturerStmt->fetchColumn();

          // Fetch genre name
          $genreStmt = $pdo->prepare("SELECT cat_name FROM category WHERE cat_id = :id");
          $genreStmt->bindParam(':id', $genreId);
          $genreStmt->execute();
          $genreName = $genreStmt->fetchColumn();
          ?>

          <p><strong style="color: red;">Nhà Sản Xuất:</strong> <?php echo $manufacturerName ?></p>
          <p><strong style="color: red;">Thể Loại:</strong> <?php echo $genreName; ?></p>
          <p><strong style="color: red;">Price:</strong> <?php echo $row['price']."đ"; ?></p>
          <!-- Add additional information as needed -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</form>  
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>
    </div>

    <!-- Sử dụng Bootstrap JS và Popper.js từ CDN -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    

</body>

</html>