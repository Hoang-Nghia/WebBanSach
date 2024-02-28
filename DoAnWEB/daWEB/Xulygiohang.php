<?php
include "database.php";
session_start();
$bookID = isset($_GET['book_id']) ? $_GET['book_id'] : 'hgdhdghhdhh';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


foreach ($_SESSION['cart'] as $key) {
    if($key==$_GET['book_id'])
    {
        // echo '<script>alert("Sản Phẩm đã có trong giỏ hàng")
        //  </script>';
        //  echo '<script>window.location.href = "GioHang.php";</script>';
        echo '<script>
    var message = "Sản Phẩm đã có trong giỏ hàng";
    var dialog = document.createElement("div");
    dialog.style.position = "fixed";
    dialog.style.top = "50%";
    dialog.style.left = "50%";
    dialog.style.transform = "translate(-50%, -50%)";
    dialog.style.padding = "20px";
    dialog.style.border = "1px solid #ccc";
    dialog.style.backgroundColor = "#fff";
    dialog.innerHTML = "<p>" + message + "</p><button onclick=\"closeDialog()\">OK</button>";
    document.body.appendChild(dialog);

    function closeDialog() {
        document.body.removeChild(dialog);
        window.location.href = "GioHang.php";
    }
</script>';

       
        exit();


    }

}
$_SESSION['cart'][] = $bookID;
echo '<script>window.location.href = "GiaoDien.php";</script>';
