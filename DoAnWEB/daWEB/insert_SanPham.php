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

        form {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
            margin-left: 250px;


            /* Center the form horizontally */
        }

        label {
            display: block;
            margin-bottom: 8px;

        }

        #description {
            width: 100%
        }

        #select {
            width: 150px;
            margin-right: 70px;
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
                    <?php
                    function postIndex($index, $value = "")
                    {
                        if (!isset($_POST[$index]))  return $value;
                        return trim($_POST[$index]);
                    }


                    include 'database.php';
                    $sm = postIndex('submit');

                    if (isset($_POST['submit'])) {

                        $updatedID = postIndex("book_ID");
                        $updatedName = postIndex("book_name");
                        $updatedDescription = postIndex("description");
                        $updatedPrice = postIndex("price");
                        if (isset($_FILES['img'])) {
                            $file_name = $_FILES['img']['name'];
                            $file_tamp = $_FILES['img']['tmp_name'];
                            move_uploaded_file($file_tamp, "uploads/" . $file_name);
                        }
                        $updatedimg = "uploads/" . $file_name;
                        $NSB = postIndex("publish");
                        $DM = postIndex("category");
                        if (!empty($updatedID)) {
                            $insertSanPham = $pdo->prepare("INSERT INTO book VALUES(:book_id,:book_name,:description,:price,:img,:pub_id,:cat_id)");
                            $insertSanPham->execute([

                                ':book_id' => $updatedID,
                                ':book_name' => $updatedName,
                                ':description' => $updatedDescription,
                                ':price' => $updatedPrice,
                                ':img' => $updatedimg,
                                ':pub_id' => $NSB,
                                ':cat_id' => $DM
                            ]);
                            echo '<script>window.location.href = "SanPham.php";</script>';
                        } else {
                            echo "KO NULL";
                        }
                        //
                        // // Kiểm tra xem form đã được submit chưa  
                        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        //     // Retrieve the form data
                        //     $updatedID = $_POST['book_ID'];
                        //     $updatedName = $_POST['book_name'];
                        //     $updatedDescription = $_POST['description'];
                        //     $updatedPrice = $_POST['price'];

                        //     if (isset($_FILES['img'])) {
                        //         $file_name = $_FILES['img']['name'];
                        //         $file_tamp = $_FILES['img']['tmp_name'];
                        //         move_uploaded_file($file_tamp, "uploads/" . $file_name);
                        //     }
                        //     $updatedimg = "uploads/" . $file_name;
                        //     $NSB = $_POST['publish'];
                        //     $DM = $_POST['category'];
                        //     // if (!$updatedName || !$updatedDescription || !$updatedPrice || !$updatedimg||$NSB||$DM) {
                        //     //     echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
                        //     //     exit;
                        //     // }
                        //     // Update the book in the database

                        //     $insertSanPham = $pdo->prepare("INSERT INTO book VALUES(:book_id,:book_name,:description,:price,:img,:pub_id,:cat_id)");
                        //     if ($insertSanPham->execute([

                        //             ':book_id' => $updatedID,
                        //             ':book_name' => $updatedName,
                        //             ':description' => $updatedDescription,
                        //             ':price' => $updatedPrice,
                        //             ':img' => $updatedimg,
                        //             ':pub_id' => $NSB,
                        //             ':cat_id' => $DM
                        //         ] )) {
                        //         header("Location: SanPham.php");
                        //         exit;
                        //     }else {echo "Lỗi";}
                        // }
                    }





                    ?>
                    <h2>Thêm Sách</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <label for="book_name">Mã:</label>
                        <input type="text" id="book_id" name="book_ID" value="">
                        <br>
                        <label for="book_name">Tên:</label>
                        <input type="text" id="book_name" name="book_name" value="">
                        <br>


                        <label for="description">Mô tả:</label>
                        <textarea id="description" name="description"></textarea>
                        <br>

                        <label for="price">Giá:</label>
                        <input type="text" id="price" name="price" value="">
                        <br>
                        <label for="Hình">Hình:</label>
                        <input type="file" id="img" name="img" accept="image/*" value="">
                        <br>
                        <!-- //required -->

                        <select name="publish" id="select">
                            <option value="">Chọn NXB</option>
                            <?php
                            include 'database.php';
                            $stm = $pdo->query("select * from publisher");
                            $row1 = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($row1 as $row) {
                                echo '<option value="' . $row["pub_id"] . '"> ' . $row["pub_name"] . '</option>';
                            }
                            ?>


                        </select>

                        <select name="category" id="select1">
                            <option value="">Chọn Thể Loại</option>
                            <?php
                            include 'database.php';
                            $stm = $pdo->query("select * from category");
                            $row1 = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($row1 as $row) {
                                echo '<option value="' . $row["cat_id"] . '"> ' . $row["cat_name"] . '</option>';
                            }
                            ?>


                        </select>
                        <input type="submit" name="submit" value="Thêm Sách" class="DK"></input>
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