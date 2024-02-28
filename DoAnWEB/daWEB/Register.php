<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #333;
        
    }

    form {
        max-width: 300px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
    }

    input {
        width: auto;
        padding: 8px;
        margin-bottom: 10px;
        box-sizing: border-box;
       
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }
</style>
</head>

<body>
<?php

include "database.php";


?>


<h2>Admin Login</h2>

<fieldset>
<legend style="margin:0 auto">Đăng ký thông tin </legend>
<form action="xulyRegister.php" method="post" enctype="multipart/form-data" id='frm1'>
<table  align="center">
    <tr>
      <td width="300">UserName</td>
      <td width="320"><input type="text" name="username" value=""/>*</td></tr>
       <tr>
      <td>Mật khẩu</td>
      <td><input type="text" name="password" value=""  />*</td></tr>
       <tr>
      <td>Name</td>
      <td><input type="text" name="Name"  value=""  />*</td></tr>
       <tr>
      <td>GMAIL</td>
      <td><input type="text" name="gmail" value="" />*</td></tr>
       
   
      
      <tr><td colspan="2" align="center"><input type="submit" value="ĐĂNG KÝ" name="submit"></td></tr>
</table>
</form>
</fieldset>

</body>
</html>
    
    
