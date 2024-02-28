<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cart.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
<style>
    .container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.text-center {
    text-align: center;
    
}

.row {
    margin-bottom: 10px;
}

.col {
    padding-left: 0;
}

select {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.row:last-child {
    border-top: 1px solid rgba(0, 0, 0, .1);
    padding: 2vh 0;
}

.btn {
    display: inline-block;
    padding: 10px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}

</style>
</head>

<body>
    <?php
    include "database.php";
    session_start();
    

    if (isset($_SESSION['order'])) {
        $_SESSION['order']=array();
    }
    
    

    $tongsl = 0;
    $tongDH = 0;
    foreach ($_POST as $key => $value) {
        if ($value>0) {
            $stm=$pdo->query("Select price from book where book_id ='$key' ");
            $row=$stm->fetch(PDO::FETCH_ASSOC);
            $_SESSION['order'][$key]=$value;

            $tongsl += $value;
            $tongDH += $tongsl *$row['price'];
        }
    }
    $tongship = 0;
    if (isset($_POST['ship'])) {


        $selectedOption = $_POST['ship'];

        // Adjust the delivery cost based on the selected option
        switch ($selectedOption) {
            case 'SH':
                $tongship = 15.00;
                break;
            case 'GH':
                $tongship = 20.00;
                break;
                // Add more cases if needed for other delivery options
        }
    }


  



        

        // $tongDH = $gia + $tongship;
    


    ?>
    <div class=" container col-4">

        <div class="text-center">
            <h1><b>Hoá đơn</b></h1>
        </div>
        <hr>
        <div class="row">
            <div class="col" style="padding-left:0;">Tổng Đơn hàng:
                <?php echo $tongsl ?>
            </div>
           
        </div>
        <form action="xulyThanhtoan.php" method="post">
            <p>Vận chuyển</p>
            <select name="ship">
                <option class="text-muted" value="SH">Shoppe- &dollar;15.00</option>
                <option class="text-muted" value="GH">GHN- &dollar;20.00</option>

            </select>
            <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                <div class="col">Tổng tiền</div>
                <div class="col text-right">&dollar;
                    <?php echo $tongDH ?>
                    <input type="hidden" value="<?php echo $tongDH ?>" name="tt">
                </div>
            </div>
            <input type="hidden" value="<?php echo $tongDH ?>" name="total">
            <input type="hidden" value="<?php echo  isset($oderID)?$oderID :'' ?>" name="oderID">
            <button type="submit" class="btn" name="btn-order">ĐẶT HÀNG</button>
        </form>


    </div>

</body>

</html>