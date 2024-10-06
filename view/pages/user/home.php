<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
?>
<div>


    <!-- Heroes Section Starts -->
    <?php include 'heroes.php'?>
    <!-- Heroes Section Ends -->


    <!-- Popular Products Section Starts -->
    <?php include 'popular.php'?>
    <!-- Popular Products Section Ends -->


    <!-- Rooms Section Starts -->
    <?php include 'room.php' ?>
    <!-- Rooms Section Ends -->


    <!-- About Us Section Starts -->
    <!-- Testimonial 1 - Bootstrap Brain Component -->
    <?php include 'aboutus.php' ?>
    <!-- About Us Section Ends -->



</div>
</html>