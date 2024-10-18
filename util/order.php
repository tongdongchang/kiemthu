<?php
session_start();
require("../util/dataProvider.php");
$dp = new DataProvider();
switch ($_SERVER["REQUEST_METHOD"]) {
  case 'GET':
    switch ($_GET['action']) {
      case 'getOrderInfo':
        $orderID = $_GET['orderID'];
        $sql = "SELECT * FROM hoadon WHERE idhoadon = " . $orderID;
        $result = $dp->excuteQuery($sql)->fetch_assoc();
        if ($result) {
          echo json_encode($result);
        } else {
          echo "Error";
        }
        break;
      case 'getProductInOrder':
        $orderID = $_GET['orderID'];
        $sql = "SELECT * FROM chitiethoadon WHERE idhoadon = " . $orderID;
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
      case 'createOrder':
        $address = $_POST['address'];
        $userID = $_SESSION['userID'];
        $products = json_decode($_POST['products']);
        $hoaDonID = $dp->getNewHoaDonId();
        $error = false;
        $test = true;
        foreach ($products as $product) {
          $sql = "select soluong,Gia from chitietphieunhap where soluong>0 and idsanpham=".$product->{"productID"}." and idmau=".$product->{"colorID"};
          $result = $dp->excuteQuery($sql);
          if(!$result->fetch_assoc()){
            $test = false;
          }
        }
        if($test){
        
        
        $sql1 = "INSERT INTO hoadon
        VALUES (" . $hoaDonID .",".$userID.",'".(new Datetime())->format('Y-m-d')."',1,NULL,'" .$address."')";
        $result1 = $dp->excuteQuery($sql1);
            foreach ($products as $product) {
              $sql = "select soluong,Gia from chitietphieunhap where soluong>0 and idsanpham=".$product->{"productID"}." and idmau=".$product->{"colorID"};
              $result = $dp->excuteQuery($sql);
            $row = $result->fetch_assoc();
            $sql = "INSERT INTO chitiethoadon
                    VALUES (" .$hoaDonID . ",". $product->{"productID"} . "," . $product->{"colorID"} . ",". $product->{"quantity"} . "," . $row['Gia']*1.45 . ","   .$row['Gia']*1.45*$product->{"quantity"}  . ")";
            $result = $dp->excuteQuery($sql);
            if (!$result) {
              $error = true;
            }
          }
        }
        if (!$error && $test) {
          echo "Success";
        } else {
          echo "Error";
        }
        break;
    }
    break;
  case 'PUT':
    switch ($_GET['action']) {
      case 'cancelOrder':
        $orderID = $_GET['orderID'];
        $sql = "UPDATE hoadon SET trangThai =0  WHERE idhoadon = " . $orderID;
        $result = $dp->excuteQuery($sql);
        if ($result) {
          echo "Success";
        } else {
          echo "Error";
        }
        break;
      case 'deleteOrder':
        $orderID = $_GET['orderID'];
        $idsanpham = $_GET['idsanpham'];
        $idmau = $_GET['idmau'];
        $sql = "delete from chitiethoadon WHERE idhoadon = " . $orderID." and idsanpham = ".$idsanpham." and idmau = ".$idmau;
        $result = $dp->excuteQuery($sql);
        if ($result) {
          echo "Success";
        } else {
          echo "Error";
        }
        break;
      case 'updateOrder':
        $orderID = $_GET['orderID'];
        $status = $_GET['status'];
        $confirmUser=$_SESSION['userID'] ;
        $f = true;
        if ($status == 2) {
          $sql = "SELECT * from chitiethoadon where idhoadon=".$orderID;  
          $result = $dp->excuteQuery($sql);
          $products = array();
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              array_push($products, $row);
            }
          }
          foreach ($products as $product) {
            // Truy vấn để lấy số lượng sản phẩm từ chi tiết phiếu nhập
            $sql11 = "SELECT soluong FROM chitietphieunhap WHERE idsanpham=" . $product['idsanpham'] . " AND idmau=" . $product['idmau'];
            $result11 = $dp->excuteQuery($sql11);
            
            // Lấy số lượng đầu tiên
            $sl = 0;  // Khởi tạo số lượng bằng 0
            while ($row = $result11->fetch_assoc()) {
                $sl += $row['soluong'];
                if ($sl >= $product['soluong']) {
                    break;  // Nếu đã đủ số lượng thì thoát vòng lặp
                }
            }
            
            // Kiểm tra nếu số lượng không đủ
            if ($sl < $product['soluong']) {
                $f = false;
                break;
            }
        }
        
        }
        if (!$f) {
          echo "Not enough product quantity";
          break;
        }
        $sql = "UPDATE hoadon SET trangthai=". $status.", idphutrach=".$confirmUser. " WHERE idhoadon = " . $orderID;
        $result1 = $dp->excuteQuery($sql);
        $error = false;
        if ($status == 2) {
          $sql = "SELECT * from chitiethoadon where idhoadon=".$orderID;
          $result = $dp->excuteQuery($sql);
          if ($result->num_rows > 0) {
            $products = array();
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                array_push($products, $row);
              }
            }
            foreach ($products as $product) {
              // Truy vấn để lấy số lượng sản phẩm từ chi tiết phiếu nhập
              $sql11 = "SELECT soluong FROM chitietphieunhap WHERE idsanpham=" . $product['idsanpham'] . " and idmau=".$product['idmau'];
              $result11 = $dp->excuteQuery($sql11);
              
              // Lấy số lượng đầu tiên
              $sl = $product['soluong'];  // Khởi tạo số lượng bằng 0
              while ($row = $result11->fetch_assoc()) {
                  $sl = $sl - $row['soluong'];
                  if($sl>0){
                    $sql = "UPDATE chitietphieunhap SET soluong = 0 WHERE soluong>0 and idsanpham = " . $product['idsanpham']. " and idmau=".$product['idmau']." limit 1";
                    $dp->excuteQuery($sql);
                  }
                  if ($sl <= 0) {
                    $sl = abs($sl);
                  $sql = "UPDATE chitietphieunhap SET soluong = ".$sl." WHERE soluong>0 and idsanpham = " . $product['idsanpham']. " and idmau=".$product['idmau']." limit 1";
                  $dp->excuteQuery($sql);
                      break;
                  }
              }
              
              // Kiểm tra nếu số lượng không đ
          }
          
        }
      }
        if ($result1 && !$error) {
          echo "Success";
        } else {
          echo "Error";
        }
        break;
    }
    break;
}