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

    .navbar-brand,
    .navbar-nav .nav-link {
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


    .form-inline {
      display: flex;
      align-items: center;
    }

    .form-group {
      margin-right: 10px;
    }

    .btn-primary {
      background-color: #007bff;
      color: #fff;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    img {
      height: 100px;
      width: 150px;
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
                Thể Loại
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
          <h1>Thông Tin Sản Phẩm</h1>
          <!-- Add a Search Form -->
          <form method="GET" action="" class="form-inline">
            <div class="form-group">
             
              <input type="text" name="search" class="form-control" placeholder="Nhập Tên Sách">
            </div>
            <input type="submit" name="btnFind" value="Tìm kiếm" class="btn btn-primary"></input>
          </form>

          <!-- Updated PHP code to filter results based on search -->
          <!-- Table -->
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Mã</th>
                <th>Tên</th>
                <th>Mô Tả</th>
                <th>Giá</th>
                <th>Hình</th>
                <th>Chức Năng</th>
              </tr>
            </thead>

        <script>
          
     
        </script>
            <?php
            include "database.php";
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
              $book_id_to_delete = $_POST["delete"];

              $delete_query = $pdo->prepare("DELETE FROM book WHERE book_id = :book_id");
              $delete_query->bindParam(":book_id", $book_id_to_delete);

               $delete_query->execute();
               

               
            }
            
            if (isset($_GET['btnFind'])) {
              $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

              // Query to search for books based on the book name
              $stm = $pdo->prepare("SELECT * FROM book WHERE book_name LIKE :search");
              $searchParam = '%' . $searchTerm . '%';
              $stm->bindParam(':search', $searchParam);
              $stm->execute();

              $searchResults = $stm->fetchAll(PDO::FETCH_ASSOC);

              // Display search results or handle as needed
              if ($searchResults) {
                foreach ($searchResults as $row) {
                  echo "<tr>";
                  echo "<td>" . $row['book_id'] . "</td>";
                  echo "<td>" . $row['book_name'] . "</td>";
                  echo "<th>" . substr($row['description'], 0, 20) . "...</th>";
                  echo "<td>" . $row['price'] . "</td>";
                  echo "<td> <img src='" . $row['img'] . "' alt=''> </td>";
                  echo "<td>";
                  echo '<a href="editSP.php?id=' . $row['book_id'] . '" class="btn btn-warning btn-sm">Sửa</a>';
                  echo '  <form method="post" style="display:inline;">
                        <input type="hidden" name="delete" value="' . $row['book_id'] . '">
                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                       </form>';
                  echo "   </td>";
                  echo "  </tr>";
                }
              }
            } else {
              $stm = $pdo->query("select * from book limit 3");
              $row1 = $stm->fetchAll(PDO::FETCH_ASSOC);
              foreach ($row1 as $row) {
                echo "<tr>";
                echo "   <td>" . $row['book_id'] . "</td>";
                echo "<td>" . $row['book_name'] . "</td>";
                echo "<th>" . substr($row['description'], 0, 20) . "...</th>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td> <img src='" . $row['img'] . "' alt=''> </td>";
                echo "<td>";
                echo '<a href="editSP.php?id=' . $row['book_id'] . '" class="btn btn-warning btn-sm">Sửa</a>';
                echo '  <form method="post" style="display:inline;">
           <input type="hidden" name="delete" value="' . $row['book_id'] . '">
           <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
        </form>';
                echo "   </td>";
                echo "  </tr>";
              }
            }

            //////
         
            ?>

          </table>
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