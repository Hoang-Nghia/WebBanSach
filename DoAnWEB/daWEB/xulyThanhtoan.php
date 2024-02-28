<?php
include"database.php";
session_start();
if (isset($_POST["btn-order"])) {
    if (!isset($_SESSION['email'])) {
        header("Location: loginUser.php");
        exit();
    }

    $orderID=uniqid();
    $status=0;
    $gmail=$_SESSION['email'];

    $sql = $pdo->prepare("INSERT INTO `order` (order_id, email, status) VALUES (:order_id, :email, :status)");
    $sql->bindParam(':order_id', $orderID);
    $sql->bindParam(':email', $gmail);
    $sql->bindParam(':status', $status);
    $sql->execute();

    $Arrayoder=$_SESSION['order'];
    foreach ($Arrayoder as $ID => $quantity) {
        $stm=$pdo->query("Select price from book where book_id ='$ID' ");
        $row=$stm->fetch(PDO::FETCH_ASSOC);
       $gia= $row['price'];
       $sql=$pdo->prepare("INSERT INTO order_detail ( order_id,book_id,quantity,price ) VALUES( :order_id,:book_id,:quantity,:price)");
       $sql->bindParam(':order_id', $orderID);
       $sql->bindParam(':book_id', $ID);
       $sql->bindParam(':price', $gia);
       $sql->bindParam(':quantity', $quantity);
       $sql->execute();
        
    }
        
}
echo '<script>
var message = "Thanh toán thành công ";
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
    window.location.href = "GiaoDien.php";
}
</script>';
?>