<?php


include "database.php";

// Kiểm tra xem form đã được submit chưa
function postIndex($index, $value="")
{
	if (!isset($_POST[$index]))	return $value;
	return trim($_POST[$index]);
}
    // Lấy dữ liệu từ form
    $sm = postIndex("submit");
  
 
    $admin_username=postIndex("username");
    $admin_password = postIndex("password");
    $admin_name=postIndex("Name");
    $admin_gmail=postIndex("gmail");


    if (!$admin_username || !$admin_password || !$admin_name || !$admin_gmail )
    {
        echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    // Mã khóa mật khẩu
    $admin_password = md5($admin_password);
    //Kiểm tra tên đăng nhập này đã có người dùng chưa
   
$stm = $pdo->prepare("SELECT username,email FROM admin WHERE username=:admin_username OR email = :admin_gmail");
$stm->bindParam(':admin_username', $admin_username);
$stm->bindParam(':admin_gmail', $admin_gmail);
// $stm->execute();

if ($stm->rowCount() > 0) {
    echo "Tên đăng nhập hoặc gmail này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}
$stm=$pdo->prepare("INSERT INTO admin (username, password, name, email, phone) VALUES(:user, :pass, :name, :email ,null)");
$stm->bindParam(':user', $admin_username);
$stm->bindParam(':pass', $admin_password);
$stm->bindParam(':name', $admin_name);
$stm->bindParam(':email', $admin_gmail);

if ($stm->execute()) {
    echo "Đăng ký thành công!";
    include"loginAdmin.php";
   

} else {
    //echo "Đăng ký không thành công. Có lỗi xảy ra!";
    echo "<p>Có lỗi xảy ra trong quá trình đăng ký. <a href='Register.php'>Thử lại</a></p>";
}




    // if ($sm != "") {
    //     if (empty($admin_username) || empty($admin_password)) {
    //         echo "Không Được bỏ trống <br>";
          
    //     } else {
    //         // Perform database query to check login credentials
           
    //         $query = "SELECT * FROM admin WHERE username = '$admin_username' AND password = '$admin_password'";
    //         $stmt = $pdo->query($query);
    //         if (!$stmt){
    //             die ('Câu truy vấn bị sai');
    //         }

    //   }
    // }
?>
