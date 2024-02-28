<?php

include "database.php";

function postIndex($index, $value = "")
{
    if (!isset($_POST[$index])) return $value;
    return trim($_POST[$index]);
}
$sm=postIndex("submit");
$sm2=postIndex("submitRegister"); // chưa xử lý 


$admin_username = postIndex("username");
$admin_password = postIndex("password");

if (!$admin_username || !$admin_password) {
    echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}

// Mã khóa mật khẩu
$admin_passwordmd5 = md5($admin_password);

// Thực hiện truy vấn để kiểm tra đăng nhập
$stm = $pdo->prepare("SELECT * FROM admin WHERE username = :admin_username");
$stm->bindParam(':admin_username', $admin_username);

if ($stm->execute()) {
    // Kiểm tra số lượng bản ghi trả về
    if ($stm->rowCount() > 0) {
        // Lấy thông tin người dùng từ kết quả truy vấn lấy 1 cột pass
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        
        // Kiểm tra mật khẩu
        if ($admin_passwordmd5===$row['password']) {
           // echo "Đăng nhập thành công!";
           // include "index.php";
           header("Location: index.php");
           exit;
           
        } else {
            echo "Mật khẩu không đúng. <a href='javascript: history.go(-1)'>Trở lại</a>";
        }
    } else {
        echo "Tên đăng nhập không tồn tại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    }
} else {
    echo "Có lỗi xảy ra trong quá trình kiểm tra đăng nhập.";
}

?>
