<?php
session_start();
if(isset($_GET['XoaIdSP']))
{
        $id=$_GET['XoaIdSP'];
        foreach ($_SESSION['cart'] as $key => $value) {
            if($value==$id)
            {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
        echo '<script>window.location.href = "GioHang.php";</script>';
}
?>