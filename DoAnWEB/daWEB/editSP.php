
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

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        button {
            
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            

        }

        button:hover {
            background-color: #45a049;
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
           
              <a class="dropdown-item" href="LoginAdmin.php">Đăng xuất</a>
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
          Tạo mới Sản Phẩm
        </a>
        <div class="collapse" id="categoryCollapse">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="insert_TheLoai.php">Thể Loại</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="insert_SanPham.php">Sản Phẩm</a>
            </li>
            
          </ul>
        </div>
      </li>
      <!-- End of Collapsible section -->
            <li class="nav-item">
              <a class="nav-link" href="TheLoai.php">
                Danh mục
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
    $bookId = $_GET['id'];

   
    $stm = $pdo->prepare("SELECT * FROM book WHERE book_id = ?");
    $stm->execute([$bookId]);
    $book = $stm->fetch(PDO::FETCH_ASSOC);

    // Check if  book exists
    if (!$book) {
        echo "Book not found.";
        exit;
    }
} else {
    echo "Book ID not provided.";
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $updatedName = $_POST['book_name'];
    $updatedDescription = $_POST['description'];
    $updatedPrice = $_POST['price'];
  
    if (isset($_FILES['imgg'])) {
      $file_name = $_FILES['imgg']['name'];
      $file_tamp = $_FILES['imgg']['tmp_name'];
      move_uploaded_file($file_tamp, "uploads/" . $file_name);
  }
  $updatedimg = "uploads/" . $file_name;

    // Update  book trong database
    $updateStm = $pdo->prepare("UPDATE book SET book_name = ?, description = ?, price = ?,img = ? WHERE book_id = ?");
    $updateStm->execute([$updatedName, $updatedDescription, $updatedPrice, $updatedimg,$bookId]);

    // Nhảy
    echo '<script>window.location.href = "SanPham.php";</script>';
}
?>

        <h2>Cập Nhật Sách</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="book_name">Tên Sách:</label>
        <input type="text" id="book_name" name="book_name" value="<?= $book['book_name'] ?>" required>
        <br>
        

        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" required><?= $book['description'] ?></textarea>
        <br>

        <label for="price">Giá:</label>
        <input type="text" id="price" name="price" value="<?= $book['price'] ?>" required>
        <br>
        <label for="Hình">Hình:</label>
        <input type="file" id="img" name="imgg"  accept="image/*"  >
        <br>

        <button type="submit" name="submit">Cập Nhật</button>
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
