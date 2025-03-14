
<?php
require("php/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>

    <title>Document</title>
</head>
<body>
<?php
    require("element/nav.php");

?>


<?php

$pro_id = $_GET['id'];

$pro_sql = $db->query("SELECT *FROM product WHERE id = '$pro_id'");

$aa = $pro_sql->fetch_assoc();
?>

<h1 class = "mt-5 text-center">Product_Details</h1>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="product_pic/<?php echo $aa['product_pic']; ?>" width="80%">
        </div>
        <div class="col-md-6 p-5">

        <div class=" d-flex justify-content-center flex-column"></div>
        <h2><?php echo $aa['product_name']; ?></h2>
        <hr>
        <h2>&#8377; <?php echo $aa['product_amount']; ?></h2>
        <?php
        if($aa['product_quantity']== 0)
        {
            echo "<h3 class='text-danger'>Stock: Not Available <h3>";
        }
        else
        {
            echo "<h3 class='text-success'>Stock: Available </h3>";
        }
        ?>

        <label class="fs-4">Product Feature</label><br>
        <label class="fs-5"><?php echo $aa['product_description'];?></label>
        <br>
        <br>
        <?php
        if(!empty($_COOKIE['_aut_ui_']))
        {
            echo '<a href="order_details.php?p_id='.$pro_id.'"<button class="btn btn-primary w-25">Buy Now </button></a>';
        }
        else
        {
            echo '<a href="login.php"<button class="btn btn-primary w-25">Buy Now </button></a>';
        }
        ?>
        

      <!--<button class="btn btn-primary w-25">Buy Now </button>-->
    </div>
        </div>
        </div>
</div>
</body>
</html>