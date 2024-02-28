<?php




// Create connection
   try{
        $pdo=new PDO("mysql:host=localhost;dbname=sach","root","");
        $pdo->query("set names utf8");
      //  echo "Connected to $database at $servername successfully.";
   }catch(Exception $e)
   {
    echo "loi ket noi".$e->getMessage(); exit;
   }






?><hr />