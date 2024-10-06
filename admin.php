<!DOCTYPE html>
<html>
<head>
<link rel="icon" type="image/x-icon" href="view\assets\imgPage\logo.png">
  <title>Admin</title>
  <head>
    <meta name="./viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="./view/styles/admin.css"></link>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
        <script type="text/javascript" src="./view/pages/admin/assets/js/ajaxWork.js"></script>    
    <script type="text/javascript" src="./view/pages/admin/assets/js/script.js"></script>
  </head>
</head>
<body>
<header id="header">
<?php
            include "./view/pages/admin/adminHeader.php";
            require("./util/dataProvider.php");
            ?>
    </header>
    <main>
    <div class=container-all>
            <?php
            include "./view/pages/admin/sidebar.php";
             ?>
    <div id="main-content" class="container allContent-section py-4" >

    </div>
    <div id="notice"></div>
    </div>
    </main>        
    </body>
    <script>
</script>
    <!--views-->
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="view/js/notice.js"></script>
  <!--controller-->
    <script src="controller/managerAccountController.js"></script>
    <script src="controller/managerOrderController.js"></script>
    <script src="controller/loginController.js"></script>
    <script src="controller/productController.js"></script>
    <script src="controller/orderController.js"></script>
    <script src="controller/roleController.js"></script>
    <script src="controller/supplyController.js"></script>
    <script src="controller/userController.js"></script>
</html>