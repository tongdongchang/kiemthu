<?php
session_start();
require("../util/dataProvider.php");
$dp = new DataProvider();
switch ($_SERVER["REQUEST_METHOD"]) {
  case 'POST':
    switch ($_POST['action']) {
      case 'addToCart':
        if (!isset($_SESSION['userID'])) {
          echo "You are not logged in!";
          break;
        }
        $colorID=$_POST['colorID'];
        $productID = $_POST['productID'];
        if (!isset($_SESSION['userID'])) {
          echo "You are not logged in!";
          break;
        }
        $userID = $_SESSION['userID'];
        $result = $dp->getItemInCart($colorID,$productID, $userID);
        if (mysqli_num_rows($result) != 0) {
          echo "Product already exists in your cart!";
        } else {
          $sql = "INSERT INTO giohang
          VALUES (" . $userID . "," . $productID . ",".$colorID."," . 1 . ")";
          $result = $dp->excuteQuery($sql);
          if ($result) {
            echo "Added to your Cart";
          } else {
            echo "Error";
          }
        }
        break;
    }
    break;
  case 'PUT':
    $userID = $_SESSION['userID'];
    $productID = $_GET['productID'];
    $quantity = $_GET['quantity'];
    $colorID=$_GET['colorID'];
    $sql = "UPDATE giohang
          SET soLuong = " . $quantity .
      " WHERE idnguoidung = '" . $userID . "' and idsanpham = " . $productID." and idmau=".$colorID;
    $result = $dp->excuteQuery($sql);
    if ($result) {
      echo "Success";
    } else {
      echo "Error";
    }
    break;
  case 'DELETE':
    $productID = $_GET['productID'];
    $colorID=$_GET['colorID'];
    $userID=$_SESSION['userID'];
    $sql = "DELETE FROM giohang WHERE idnguoidung = '" . $userID . "' and idsanpham = " . $productID." and idmau=".$colorID;
    $result = $dp->excuteQuery($sql);
    if ($result) {
      echo "Success";
    } else {
      echo "Error";
    }
    break;
}