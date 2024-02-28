<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Admin Panel</title>
  <style>
    .navbar {
      background-color: #3498db;
    }

    .navbar-brand,
    .navbar-nav .nav-link {
      color: #fff;
    }
    .navbar li a {
  margin-right: 40px;
}

    .navbar-toggler-icon {
      background-color: #fff;
    }

    .sidebar {
      height: 100vh;
      position: fixed;
      top: 56px;
      background-color: #2c3e50;
      padding-top: 20px;
    }

    .sidebar-sticky {
      padding-top: 20px;
    }

    .sidebar a {
      color: #fff;
    }

    .sidebar a:hover {
      color: #3498db;
    }

    .main-content {
      margin-left: 220px;
      padding: 20px;

    }

    form {
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin-left: 250px;

      /* Center the form horizontally */
    }

    label {
      display: block;
      margin-bottom: 8px;

    }

    h2 {
      margin-left: 270px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: vertical;

    }

    .DK {
      background: #3498db;
      border: 1px solid #f5f5f5;
      color: #fff;
      width: 100%;
      text-transform: uppercase;

      transition: 0.25s ease-in-out;
      margin-top: 10px;
    }

    .DK:hover {
      /* border: 5px solid #a52a2a; */
      background: #a52a2a;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Admin </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
                      <!-- Collapsible section -->
    <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cài Đặt
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            
              <a class="dropdown-item" href="LoginAdmin.php">Đăng Xuất</a>
            </div>
          </li>
      <!-- End of Collapsible section -->
      </ul>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">
                Quản Lý Sản Phẩm
              </a>
            </li>
            <!-- Collapsible section -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-toggle="collapse" href="#categoryCollapse" aria-expanded="false" aria-controls="categoryCollapse">
              Tạo Mới Sản Phẩm
              </a>
              <div class="collapse" id="categoryCollapse">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="insert_DonHang.php">Đơn Hàng</a>
                  <li class="nav-item">
                    <a class="nav-link" href="insert_SanPham.php">Sản Phẩm</a>
                  </li>
                  
                </ul>
              </div>
            </li>
            <!-- End of Collapsible section -->
            <li class="nav-item">
              <a class="nav-link" href="DonHang.php">
                Đơn Hàng
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="SanPham.php">
                Sản phẩm
              </a>
            </li>

          </ul>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="main-content">
        <div class="container-fluid">
          <?php
          
      

          // Kiểm tra xem form đã được submit chưa  
          function postIndex($index, $value = "")
          {
            if (!isset($_POST[$index]))  return $value;
            return trim($_POST[$index]);
          }
          include "database.php";
          // Lấy dữ liệu từ form
          $sm = postIndex("submit");
          if(isset($_POST['submit'])){
            $maDH = postIndex("maDH");
            $ngayDH = postIndex("ngayDH");
            $ngayGH = postIndex("ngayGH");
            $soLuong = postIndex("soLuong");
            $tongTien = postIndex("tongTien");
            $maKH = postIndex("maKH");
            $maSP = postIndex("maSP");
  
          
            // Check if the input is not empty  if (!empty($maDH) && !empty($CatName))
            if (!empty($maDH) && !empty($ngayDH) && !empty($ngayGH) 
              && !empty($soLuong)&& !empty($tongTien)&& !empty($maKH)&& !empty($maSP)) {
                $insertStm = $pdo->prepare("INSERT INTO donhang (madh, ngaydathang, ngaygiaohang, soluong, tongtien, makh, masp) VALUES (:madh, :ngaydathang, :ngaygiaohang, :soluong, :tongtien, :makh, :masp)");
               $insertStm->execute([':madh' => $maDH, ':ngaydathang' => $ngayDH, ':ngaygiaohang' => $ngayGH, ':soluong' => $soLuong, ':tongtien' => $tongTien, ':makh' => $maKH, ':masp' => $maSP]);
                echo '<script>window.location.href = "DonHang.php";</script>';
                
              
            } else {
              echo "<p>Không được trống thông tin.</p>";
            }
  
          }

         
        


          ?>
          <h2>Thêm Đơn Hàng</h2>
          <form method="POST" action="">
            <label for="madh"> Mã:</label>
            <input type="text" name="maDH" value="" >
            <br>
        <label for="ngaydathang"> Ngày Đặt Hàng:</label>
        <input type="text"  name="ngayDH" value="">
        <br>
        <label for="ngaygiaohang"> Ngày Giao Hàng:</label>
        <input type="text"  name="ngayGH" value=""><br>
        <label for="soluong"> Số Lượng:</label>
        <input type="text"  name="soLuong" value="" ><br>
        <label for="tongtien"> Tổng Tiền:</label>
        <input type="text"  name="tongTien" value="" ><br>
        <label for="makh"> Mã KH:</label>
        <input type="text"  name="maKH" value="" ><br>
        <label for="masp"> Mã SP:</label>
        <input type="text"  name="maSP" value="" >


            <input type="submit" value="Thêm Đơn Hàng" name="submit" class="DK">
          </form>


        </div>
      </main>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>