<?php
require("db.php");

$fullname = $_POST['fullname'];

$mobile = $_POST['mobile'];

$email = $_POST['email'];

$password =md5($_POST['password']);

$address = $_POST['address'];

$cd = date('y-m-d');

$check_table = $db->query("SHOW TABLES LIKE 'register'");

if ($check_table->num_rows > 0)
{
    $check_user = $db->query("SELECT * FROM register WHERE email='$email'");
    if($check_user->num_rows !=0)
    {
        echo "user allready exist";

    }
    else
    {
        $store = $db->query("INSERT INTO register(fullname,mobile,email,address,password,date)VALUE('$fullname','$mobile','$email','$address','$password','$cd')");

        if($store)
        {
            echo "success";
        }
        else
        {
            echo "failed";
        }
    }
}
else
{
    $create_table = $db->query("CREATE TABLE register(
    id INT(11) NOT NULL AUTO_INCREMENT,
    fullname VARCHAR(255),
    mobile VARCHAR(100),
    email VARCHAR(200),
    address MEDIUMTEXT,
    password VARCHAR(255),
    date DATE,
    PRIMARY KEY(id)

     )");

    if($create_table)
    {
        $check_user = $db->query("SELECT * FROM register WHERE email='$email'");
        if($check_user->num_rows !=0)
        {
            echo "user allready exist";

        }
        else
        {
            $store = $db->query("INSERT INTO register(fullname,mobile,email,address,password,date)VALUE('$fullname','$mobile','$email','$address','$password','$cd')");

            if($store)
            {
                echo "success";
            }
            else
            {
                echo "failed";
            }
        }
    }
    else
    {
        echo "table_not_crated";

    }
   
}

?>