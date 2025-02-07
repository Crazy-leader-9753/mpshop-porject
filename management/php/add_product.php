<?php
require("db.php");

$category = $_POST['catogery'];
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_quantity =$_POST['product_quantity'];
$product_amount = $_POST['product_amount'];

$product_pic = $_FILES['product_pic'];



 $pro_pic_name = $product_pic['name'];
 $location = $product_pic['tmp_name'];

 $check_table = $db->query("SELECT * FROM product");
 if($check_table)
 {
   $file_check = file_exists("../../product_pic/".$pro_pic_name);
      if($file_check)
      {
         echo "file_already_exists";
      }
      else
      {
         $upload_pic = move_uploaded_file($location,"../../product_pic/".$pro_pic_name);
      }
      if($upload_pic)
      {
         $data_store = "INSERT INTO product(category,product_pic,product_name,product_description,product_quantity,product_amount)VALUES('$category','$pro_pic_name','$product_name','$product_description','$product_quantity','$product_amount')";

         $store_response = $db->query($data_store);
         if($store_response)
         {
            echo "success";
         }
         else
         {
            echo "failled";
         }
      }
      else
      {
         echo "file not uploaded";
      }

 }
 else
 {
   $create_table = $db->query("CREATE TABLE product(
      id INT(11) NOT NULL AUTO_INCREMENT,
      category VARCHAR(100),
      product_pic VARCHAR(200),
      product_name VARCHAR(200),
      product_description MEDIUMTEXT,
      product_quantity VARCHAR(100),
      product_amount VARCHAR(100),
      PRIMARY KEY(id)

      ,)");
   if($create_table)
   {
      $file_check = file_exists("../../product_pic/".$pro_pic_name);
      if($file_check)
      {
         echo "file_already_exists";
      }
      else
      {
         $upload_pic = move_uploaded_file($location,"../../product_pic/".$pro_pic_name);
      }
      if($upload_pic)
      {
         $data_store = "INSERT INTO product(category,product_pic,product_name,product_description,product_quantity,product_amount)VALUES('$category','$pro_pic_name','$product_name','$product_description','$product_quantity','$product_amount')";

         $store_response = $db->query($data_store);
         if($store_response)
         {
            echo "success";
         }
         else
         {
            echo "failled";
         }
      }
      else
      {
         echo "file not uploaded";
      }
   }
   else
   {
      echo "create_table_failed";
   }
 }




?>