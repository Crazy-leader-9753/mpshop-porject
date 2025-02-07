<?php
require("db.php");
// print_r($_GET);

if(isset($_GET['payment_status']))
{
    if($_GET['payment_status'] !='Credit')
    {
        die('payment_failed');
    }
}
$p_id = $_GET['p_id'];
$pro_sql = $db->query("SELECT * FROM product WHERE id = '$p_id'");
$aa = $pro_sql->fetch_assoc();

$product_name = $aa['product_name'];
$product_amount = $aa['product_amount'];
$product_qty = $_GET['p_qty'];
$p_pic = $aa['product_pic'];


$tp_amount = $product_qty * $product_amount;

$user_email = base64_decode($_COOKIE['_aut_ui_']);
$user_response = $db->query("SELECT * FROM register WHERE email = '$user_email'");
$user_aa = $user_response->fetch_assoc();

$c_name = $user_aa['fullname'];
$c_mobile = $user_aa['mobile'];
$c_address = $user_aa['address'];

$p_mode = $_GET['p_mode'];

$payment_status="";

if($p_mode =="online")
{
    $payment_status = "completed";
}
else if($p_mode == "cod")
{
    $payment_status = "pending";
}

$order_date = date("y-m-d");

// $check = $db->query("SELECT * FROM receive_order");


$check = $db->query("SHOW TABLES LIKE 'receive_order'");

if ($check->num_rows > 0)
 {
    $store = $db->query("INSERT INTO receive_order(order_date,p_name,p_pic, p_amount, tp_amount, p_qty, c_name, c_mobile, c_email, c_address, payment_mode,payment_status)
    VALUES ('$order_date','$product_name','$p_pic', '$product_amount', '$tp_amount', '$product_qty', '$c_name', '$c_mobile', '$user_email', '$c_address', '$p_mode','$payment_status')");

    if ($store) 
    {
        header("Location:../my_ordere.php");
    } 
    else 
    {
        echo "failed";
    }
}
else
{
    $create_table = $db->query("CREATE TABLE receive_order(
        id INT(11) NOT NULL AUTO_INCREMENT,
        order_date DATE,
        p_name VARCHAR(255),
        p_pic VARCHAR(255),
        p_amount VARCHAR(255),
        tp_amount VARCHAR(255),
        p_qty VARCHAR(255),
        c_name VARCHAR(255),
        c_mobile VARCHAR(255),
        c_email VARCHAR(255),
        c_address VARCHAR(255),
        payment_mode VARCHAR(255),
        payment_status VARCHAR(255),
        order_status VARCHAR(255) DEFAULT 'pending',
        PRIMARY KEY(id)
        )");
        if ($create_table) 
        {
            $store = $db->query("INSERT INTO receive_order(order_date,p_name,p_pic, p_amount, tp_amount, p_qty, c_name, c_mobile, c_email, c_address, payment_mode,payment_status)
             VALUES ('$order_date','$product_name','$p_pic', '$product_amount', '$tp_amount', '$product_qty', '$c_name', '$c_mobile', '$user_email', '$c_address', '$p_mode','$payment_status')");

            if ($store) {
                header("location:../my_order.php");
            } 
            else 
            {
                echo "failed";
            }
        } 
        else
        {
            echo "table not created";
        }
}
?>
