<?php
session_start();
require("../util/dataProvider.php");
$dp = new DataProvider();
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        switch ($_GET['action']) {
          case 'getSupplyInfo':
            $phieunhapID = $_GET['phieunhapID'];
            $sql = "SELECT * FROM phieunhap WHERE idphieunhap = " . $phieunhapID;
            $result = $dp->excuteQuery($sql)->fetch_assoc();
            if ($result) {
              echo json_encode($result);
            } else {
              echo "Error";
            }
            break;
          case 'getProductInSupply':
            $phieunhapID = $_GET['phieunhapID'];
            $sql = "SELECT * FROM chitietphieunhap WHERE idphieunhap = " . $phieunhapID;
            $result = $dp->excuteQuery($sql);
            $products = array();
            if ($result) {
              while ($row = $result->fetch_assoc()) {
                $products[] = $row;
              }
              echo json_encode($products);
            } else {
              echo "Error";
            }
            break;
        }
        break;
    case 'POST':
        switch ($_POST['action']) {
            case 'addNewSupply':
                $supplyID =$dp->getNewPhieuNhapId();
                //need delete
                $_SESSION["userID"]=1;
                $userID=$_SESSION["userID"];
                $products = json_decode($_POST['productList']);
                $sql = "INSERT INTO phieunhap
                        VALUES (" . $supplyID .",".$userID .",'" . (new Datetime())->format('Y-m-d') . "')";
                $result1 = $dp->excuteQuery($sql);
                $error = false;
                $errortext;
                foreach ($products as $product) {
                    $sql = "INSERT INTO chitietphieunhap
                            VALUES (".$supplyID . ",". $product->{"productID"} . "," .$product->{"colorID"}  . "," . $product->{"productPrice"} ."," . $product->{"quantity"} . ','.'0'. ")";
                    $result2 = $dp->excuteQuery($sql);
                    $sql = "UPDATE sanpham SET soLuong=soLuong + " . $product->{"quantity"} . " WHERE idsanpham=" . $product->{"productID"}." and idmau=". $product->{"colorID"};
                    $result3 = $dp->excuteQuery($sql);
                    if (!$result2 || !$result3) {
                      $error = true;
                  }
                }
                if ($result1 && !$error) {
                    echo "Success";
                } else {
                    echo  "Error";
                }
                break;
        }
        break;
}