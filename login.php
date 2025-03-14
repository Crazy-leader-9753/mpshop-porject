<?php
require("php/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <title>Document</title>
</head>
<body>
  <?php
    require("element/nav.php");
  ?>
  <div class="container p-5">
    <div class="row p-5" style="box-shadow:0px 0px 15px #ccc">
      <h1 class="mb-4">Login with us</h1>
      <hr>
      <div class="col-md-6">
        <form class="login_frm">
        <label class="mb-2">Enter Email id</label>
          <input type="email"  required name="email" class="form-control mb-3">
          <label class="mb-2">Enter Password</label>
          <input type="password"  required name="password" class="form-control mb-3">
          <button type="submit" class="btn btn-primary r_btn">Login Now</button>
        </form>
      </div>
      <div class="msg"></div>
      <div class="col-md-6"></div>
    </div>
  </div>
  <?php
require("element/footer.php");
?>
  <script>
    $(document).ready(function(){
      $(".login_frm").submit(function(e){
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "php/s_login.php",
          data: new FormData(this),
          processData: false,
          contentType: false,

          beforeSend: function(){
            $(".r_btn").html("Please wait ....");
            $(".r_btn").attr("disabled", "disabled");
          },
          success: function(response){
            $(".r_btn").html("Login Now");
            $(".r_btn").removeAttr("disabled");
            
            if(response.trim() === 'success')
            {
             location.href="index.php";
            }
            else
            {
                var div = document.createElement("DIV");
              $(div).addClass("alert alert-danger mt-3");
              $(div).html(response);
              $(".msg").append(div);
              setTimeout(function() {
                    $(".msg").html("");
                }, 2500);
            }
            
          }
        });
      });
    });
  </script>
</body>
</html>
