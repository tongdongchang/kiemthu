<?php
session_start();
require("../util/dataProvider.php");
$dp = new DataProvider();
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        switch ($_GET['action']) {
            case 'getQuantity':
                $productID = $_GET['productID'];
                $colorID = $_GET['colorID'];
                $sql = "SELECT soLuong FROM sanpham WHERE  idSanPham= " . $productID." and  idMau=".$colorID;
                $result = $dp->excuteQuery($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo $row['soLuong'];
                } else {
                    echo "error";
                }
                break;
            case 'getProductInfo':
                $productID = $_GET['productID'];
                $sql = "SELECT * FROM sanpham where  idSanPham= " . $productID;
                $result = $dp->excuteQuery($sql);
                $product = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($product, $row);
                    }
                }
                if ($result != null) {
                    echo json_encode($product);
                } else {
                    echo "error";
                }
                break;
            case 'getListColorProduct':
                $productID = $_GET['productID'];
                // Thực hiện truy vấn SQL
                $sql = "SELECT * FROM sanpham JOIN mau ON sanpham.idmau=mau.idmau WHERE mau.idmau!=0 AND idsanpham=".$productID;
                $result = $dp->excuteQuery($sql);
                // Xử lý kết quả trả về và tạo danh sách tùy chọn
                $options = '';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $options .= '<option value="'.$row['idmau'].'">'.$row['tenMau'].'</option>';
                    }
                }
                // Trả về danh sách tùy chọn cho JavaScript
                echo $options;
                break;
            case 'getNewIDProduct':
                echo $dp->getNewProductId();
                break;
            case 'getAllproduct':
                $sql = "SELECT * FROM sanpham";
                $result = $dp->excuteQuery($sql);
                $product = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($product, $row);
                    }
                }
                echo json_encode($product);
                break;
        }
        break;
    case 'POST':
        switch ($_POST['action']) {
            case 'favorite':
                if (!isset($_SESSION['userID'])) {
                    echo "You are not logged in!";
                    break;
                }
                $userID = $_SESSION['userID'];
                $productID = $_POST['productID'];
                $sql = "INSERT INTO yeuthich
                    VALUES ( " . $productID . " ,'" . $userID . "')";
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break;
            case 'addNewproduct':
                $productID =$_POST['productID'];
                $phongID=$_POST['phongID'];
                $loaiID=$_POST['loaiID'];
                $productName = $_POST['productName'];
                $productDescribe = $_POST['productDescribe'];
                $colorID=$_POST['colorID'];
                $active=$_POST['active'];
                $hinh=$_POST['hinh'];
                $sql = "INSERT INTO SanPham 
                VALUES(" . $productID . ", " . $colorID . ", " . $phongID . ", " . $loaiID . ", '" . $productName . "', 0, '" . $productDescribe . "', '" . $hinh . "', 0, " . $active . ")";        
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break;
            case 'newphong':
                $newid=$dp->getNewPhongId();
                $ten=$_POST['tenphong'];
                $sql="INSERT INTO phong
                VALUES(".$newid.",'".$ten."')";
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break;
            case 'newloai':
                $newid=$dp->getNewLoaiId();  
                $ten=$_POST['tenloai'];
                $sql="INSERT INTO loai
                VALUES(".$newid.",'".$ten."')";
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break; 
            case 'newmau':
                $newid=$dp->getNewMauId();
                $ten=$_POST['tenmau'];
                $sql="INSERT INTO mau
                VALUES(".$newid.",'".$ten."')";
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break;
        }
        break;
    case 'PUT':
        switch ($_GET['action']) {
            case 'updateProductInfo':
                $productID = $_GET['productID'];
                $phongID=$_GET['phongID'];
                $loaiID=$_GET['loaiID'];
                $productName = $_GET['productName'];
                $productPrice = $_GET['productPrice'];
                $productDescribe = $_GET['productDescribe'];
                $sql = "UPDATE sanpham
                        SET tenSanPham = '" . $productName . "',
                            idPhong = " . $phongID . ",
                            idLoai = " . $loaiID . ",
                            gia = " . $productPrice . ",
                            moTa = '" . $productDescribe . "'
                        WHERE idsanpham = " . $productID;
                $result = $dp->excuteQuery($sql);
                break;
                case 'updateProductImage':
                    $productID = $_GET['productID'];
                    $image=$_GET['image'];
                    $colorID=$_GET['colorID'];
                    $sql = "UPDATE sanpham
                            SET hinh = '" . $image . "'
                            WHERE idsanpham = " . $productID." 
                            and idmau=".$colorID;
                    $result = $dp->excuteQuery($sql);
                    if ($result) {
                        echo "Success";
                    } else {
                        echo $result;
                    }
                    break;
            case 'deleteproduct':
                $productID = $_GET['productID'];
                $colorID=$_GET['colorID'];
                $sql = "Update sanpham
                        SET TrangThai = 0
                        WHERE idsanpham = " . $productID." 
                        and idmau=".$colorID;
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "Success";
                } else {
                    echo "error";
                }
                break;
            case 'restoreproduct':
                    $productID = $_GET['productID'];
                    $colorID=$_GET['colorID'];
                    $sql = "Update sanpham
                            SET TrangThai = 1
                            WHERE idsanpham = " . $productID." 
                            and idmau=".$colorID;
                    $result = $dp->excuteQuery($sql);
                    if ($result) {
                        echo "Success";
                    } else {
                        echo "error";
                    }
                    break;
            case 'updatephong':
                $phongID=$_GET['phongID'];
                $tenphong=$_GET['tenphong'];
                $sql = "UPDATE phong
                        SET tenphong = '" . $tenphong . "'
                        WHERE idphong = " . $phongID;
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "Success";
                } else {
                    echo "error";
                }
                break;
            case 'updateloai':
                $loaiID=$_GET['loaiID'];
                $tenloai=$_GET['tenloai'];
                $sql = "UPDATE loai
                        SET tenloai = '" . $tenloai . "'
                        WHERE idloai = " . $loaiID;
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "Success";
                } else {
                    echo "error";
                }
                break;
            case 'updatemau':
                $mauID=$_GET['mauID'];
                $tenmau=$_GET['tenmau'];
                $sql = "UPDATE mau
                        SET tenMau = '" . $tenmau . "'
                        WHERE idmau = " . $mauID;
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "Success";
                } else {
                    echo "error";
                }
                break;
        }
        break;
    case 'DELETE':
        switch ($_GET['action']) {
            case 'dislike':
                $userID = $_SESSION['userID'];
                $productID = $_GET['productID'];
                $sql = "DELETE FROM yeuthich
                    WHERE idNguoiDung = '" . $userID . "' AND idSanPham = " . $productID . "";
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break;
            case 'deleteColor':
                $productID = $_GET['productID'];
                $colorID=$_GET['$colorID'];
                $sql = "DELETE FROM sanpham
                        WHERE idSanPham= " . $productID." and idMau= ".$colorID;
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break;
            case 'deleteProductByID':
                $productID = $_GET['productID'];
                $sql = "DELETE FROM sanpham
                        WHERE idSanPham= " . $productID;
                $result = $dp->excuteQuery($sql);
                if ($result) {
                    echo "success";
                } else {
                    echo "error";
                }
                break;
        }
        break;
}