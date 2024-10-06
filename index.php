<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/x-icon" href="view\assets\imgPage\logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.D.E.A</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./view/styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body onload="ShowHome()">
<div id="notice"></div>
    <!-- Header Section Starts -->
    <header class="py-3 mb-3 border-bottom"></header>
    <div class="container" id="header-section">    
      <?php include 'view/pages/user/header.php'?>
    </div>
    </header>
    <main>
    <div id="main-content" class="container allContent-section py-4" >

</div>
<div id="footer">
<?php include 'view/pages/user/footer.php'?>
</div>
    </main>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
<script type="text/javascript" src="./view/pages/user/js/ajaxuser.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="view/js/notice.js"></script>
  <!--controller-->
    <script src="controller/loginController.js"></script>
    <script src="controller/productController.js"></script>
    <script src="controller/orderController.js"></script>
    <script src="controller/roleController.js"></script>
    <script src="controller/userController.js"></script>
    <script src="controller/cartController.js"></script>
</html>