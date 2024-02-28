<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Store Book</title>
  <!-- Sử dụng Bootstrap CSS từ CDN -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">



  <style>
  .book-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }
  h1 {
text-align: center;
  }

  .book-card {
    width: 300px;
    margin: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .card-img-top {
    max-height: 200px;
    object-fit: cover;
  }

  .card-title {
    color: black;
  }

  .card-text {
    color: black;
  }

  .card-footer {
    display: flex;
    /* justify-content: space-evenly; */
    align-items: center;
  }
</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#">Store Book</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Trang Chủ <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Sản Phẩm</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Dịch Vụ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Liên Hệ</a>
      </li>
    </ul>
  </div>
</nav>
<?php
include"database.php";
$stm = $pdo->query("select * from book");
$row1 = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Nội dung trang -->
<div class="container mt-5">
    <h1>Sản Phẩm mới Nhất</h1>
<!-- Sản phẩm 1 -->
    <div class="book-container">
    <?php foreach ($row1 as $row): ?>
      <div class="card book-card">
        <img src="<?php echo $row['img']; ?>" class="card-img-top" alt="">
        <div class="card-body">
          <h5 class="card-title"><Strong style="color: red">Tên: </Strong> <?php echo $row['book_name']; ?></h5>
          <p class="card-text"><Strong style="color: red">Mô tả: </Strong> <?php echo substr($row['description'], 0, 200)  ?></p>
          <p class="card-text"><strong style="color: red">Giá:</strong>  <?php echo $row['price']; ?></p>
        </div>
        <div class="card-footer">
      <button class="btn btn-primary">Mua</button>
      <button class="btn btn-outline-secondary ml-2">Giỏ Hàng</button>
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
