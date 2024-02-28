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
    flex-wrap: wrap;
    justify-content: space-around;
    font-family:'Segoe UI';
  }
  h1 {
text-align: center;
  }

  .book-card {
    height: 360px;
    width: 230px;
    margin: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card-img-top {
    height: 230px;
    width: 229px;
    
  }

  .card-body-center {
    height: 100px;
    width: 200px;
    text-align: center;
   
  }

  .card-body-center-name {
    color: black;
  }

  .card-body-center-price {
    font-style: oblique;
    color: red;
  }

  .card-title {
    color: black;
  }

  .card-text {
    color: black;
  }
  .btn{
    padding-right: 10px;
  }


  .card-footer {
    display: flex;
    /* justify-content: space-evenly; */
    align-items: center;
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
        <a class="nav-link" href="#">Trang Chủ <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="SanPhamUser.php">Sản Phẩm</a>
      </li>
      <a href="GioHang.php" class="btn btn-outline-secondary ml-2"   >Giỏ Hàng</a> <?php echo count($_SESSION['cart'])+1-1?>
      <li class="nav-item">
        <a class="nav-link" href="#">Liên Hệ</a>
      </li>
    </ul>
  </div>
</nav>
<?php
include"database.php";
$stm = $pdo->query("select * from book ");
$row1 = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Nội dung trang -->
<div class="container mt-5">
    <h1>Sản Phẩm Mới Nhất</h1>
<!-- Sản phẩm 1 -->
    <div class="book-container">
    <?php foreach ($row1 as $row): ?>
      <div class="card book-card">
        <img src="<?php echo $row['img']; ?>" class="card-img-top" alt="">
        <div class="card-body-center">
          <b class="card-body-center-name"> <?php echo $row['book_name']; ?></b>
          <br>
          <b class="card-body-center-price"><?php  echo $row['price']."đ"; ?></b>
        </div>
        <div class="card-footer">
      <a href="Xulygiohang.php?book_id=<?php echo $row['book_id']; ?>"  class="btn btn-primary">Add to Mua</a>
      <!-- Button to trigger the modal -->
      
      <form action="" method="get">
  <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#chiTietModal<?php echo $row['book_id']; ?>">
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

<!-- Sử dụng Bootstrap JS và Popper.js từ CDN -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


</body>
</html>
