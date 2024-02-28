
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
    .navbar li a {
  margin-right: 40px;
}

    .navbar-brand, .navbar-nav .nav-link {
      color: #fff;
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
            padding: 8px;
            margin-left: 150px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"]
         {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
        
.DK{
    background: #3498db;
    border: 1px solid #f5f5f5;
    color: #fff;
    width: 100%;
    text-transform: uppercase;

    transition: 0.25s ease-in-out;
    margin-top: 10px;
}
.DK:hover{
    /* border: 5px solid #a52a2a; */
    background:#a52a2a ;
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
            </li>
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
// Kết nối
include "database.php";


if (isset($_GET['id'])) {
    $maDH = $_GET['id'];

   
    $stm = $pdo->prepare("SELECT * FROM donhang WHERE madh = ?");
    $stm->execute([$maDH]);
    $cat = $stm->fetch(PDO::FETCH_ASSOC);

    // Check if the book exists
    if (!$cat) {
        echo "cat not found.";
        exit;
    }
} else {
    echo "madh not provided.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $updatedmadh = $_POST['madh'];
    $updatedNgayDH = date('Y-m-d', strtotime($_POST['ngaydathang']));
    $updatedNgayGH = date('Y-m-d', strtotime($_POST['ngaygiaohang']));
   $updatedsoluong = $_POST['soluong'];
    $updatedtongtien = $_POST['tongtien'];
    $updatedmakh = $_POST['makh'];
    $updatedmasp = $_POST['masp'];
    // Update  book trong database
    $updateStm = $pdo->prepare("UPDATE donhang SET ngaydathang = ?, ngaygiaohang = ?, soluong = ?, tongtien = ?, makh = ?, masp = ? WHERE madh = ?");
    $updateStm->execute([$updatedNgayDH, $updatedNgayGH, $updatedsoluong, $updatedtongtien, $updatedmakh, $updatedmasp, $updatedmadh]);
    

 
    echo '<script>window.location.href = "DonHang.php";</script>';
}
?>

        <h2>Cập Nhật Đơn Hàng</h2>
        <form method="POST">
        <label for="madh"> Mã DH:</label>
        <input type="text"  name="madh" value="<?= $cat['madh'] ?>" required>
        <br>
    <label for="ngaydathang"> Ngày Đặt Hàng:</label>
    <input type="text" name="ngaydathang" value="<?= date('Y-m-d', strtotime($cat['ngaydathang'])) ?>" required>
    <br>
    <label for="ngaygiaohang"> Ngày Giao Hàng:</label>
    <input type="text" name="ngaygiaohang" value="<?= date('Y-m-d', strtotime($cat['ngaygiaohang'])) ?>" required><br>
    <label for="soluong"> Số Lượng:</label>
        <input type="text"  name="soluong" value="<?= $cat['soluong'] ?>" required><br>
        <label for="tongtien"> Tổng Tiền:</label>
        <input type="text"  name="tongtien" value="<?= $cat['tongtien'] ?>" required><br>
        <label for="makh"> Mã KH:</label>
        <input type="text"  name="makh" value="<?= $cat['makh'] ?>" required><br>
        <label for="masp"> Mã SP:</label>
        <input type="text"  name="masp" value="<?= $cat['masp'] ?>" required>
        
        <input type="submit" value="Cập Nhật" name="submit" class="DK">
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
