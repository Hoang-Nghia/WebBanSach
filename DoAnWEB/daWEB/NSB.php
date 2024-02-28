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
                Thể Loại   </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="NSB.php">
                NSX  </a>
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
          <h1>Thông Tin Thể Loại</h1>
      
          <!-- Table -->
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Mã</th>
                <th>Tên</th>
                <th>Chức Năng</th>
              </tr>
            </thead>
            <?php
            
              include"database.php";
              if($_SERVER["REQUEST_METHOD"]=="POST"&&isset($_POST["delete"]))
              {
               $cat_id_to_delete = $_POST["delete"];
            
               $delete_query = $pdo->prepare("DELETE FROM category WHERE cat_id = :cat_id");
               $delete_query->bindParam(":cat_id", $cat_id_to_delete);
            
               $delete_query->execute();
              }
              $stm=$pdo->query("select * from publisher");
              $row1=$stm->fetchAll(PDO::FETCH_ASSOC);
              foreach ($row1 as $row ) {
               # code...          
             echo" <tr>";
            echo"    <td>".$row['pub_id']."</td>";
               echo" <td>".$row['pub_name']."</td>";
              echo"  <td>";
              echo '<a href="editTL.php?id=' . $row['pub_id'] . '" class="btn btn-warning btn-sm">Sửa</a>';
                echo '  <form method="post" style="display:inline;">
                <input type="hidden" name="delete" value="' . $row['pub_name'] . '">
                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
             </form>';
              echo"  </td>   ";
           echo"   </tr>";
           }
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
