<?php
session_start();
require("../util/dataProvider.php");
$dp = new DataProvider();
switch ($_SERVER["REQUEST_METHOD"]) {
  case 'GET':
    switch ($_GET['action']) {
      case 'isLogin':
        if (isset($_SESSION['userID'])) {
          echo true;
        } else {
          echo false;
        }
        break;
      case 'getRole':
        echo $_SESSION['role'];
        break;
    }
    break;
  case 'POST':
    switch ($_POST['action']) {
      case 'checkLogin':
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $md5Pass = md5($password);
        $result = $dp->getUserByUsername($username);
        if ($result != null) {
          if (mysqli_num_rows($result) == 0) {
            echo "Account does not exist!";
          } else {
            $user = $result->fetch_assoc();
            if ($user['password'] != $md5Pass) {
              echo "Wrong password!";
            } else {
              $_SESSION['userID'] = $user['idnguoidung'];
              $_SESSION['userName'] = $user['username'];
              $_SESSION['role'] = $user['vaitro'];
              $_SESSION['permission'] = $dp->getPermissionByRoleID($user['vaitro']);
              if ($user['vaitro'] == 1) {
                echo "cus";
              } else {
                echo "emp";
              }
            }
          }
        }
        break;
      case 'checkUsernameExist':
        $username = $_POST['user'];
        $result = $dp->getUserByUsername($username);
        if (mysqli_num_rows($result) != 0) {
          echo true;
        } else {
          echo false;
        }
        break;
      case 'register':
        $newid = $dp -> getNewUserId();
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $md5Pass = md5($password);
        $sql1 = "INSERT INTO taikhoan
        VALUES (".$newid.",'". $username ."','".$md5Pass."','" . (new Datetime())->format('Y-m-d')."',1)";
        $result1 = $dp->excuteQuery($sql1);
        $sql2 = "INSERT INTO nguoidung
        VALUES (".$newid.",'" . $name . "','" . $phone . "', '" . $address . "','" . $email ."',1)";
        $result2 = $dp->excuteQuery($sql2);
        if ($result1 && $result2) {
          echo "Success";
        } else {
          echo "Error";
        }
        break;
      case 'createNewAccount':
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        $md5Pass = md5($password);
        $address = $_POST['address'];
        $newid=$dp->getNewUserId();
        $sql1 = "INSERT INTO taikhoan
        VALUES (".$newid.",'". $username ."','".$md5Pass."','" . (new Datetime())->format('Y-m-d')."',".$role.")";
        $result1 = $dp->excuteQuery($sql1);
        $sql2 = "INSERT INTO nguoidung
        VALUES (".$newid.",'" . $name . "','" . $phone . "', '" . $address . "','" . $email ."',1)";
        $result2 = $dp->excuteQuery($sql2);
        if ($result1 && $result2) {
          echo "Success";
        } else {
          echo "Error";
        }
        break;
    }
    break;
  case 'PUT':
    switch ($_GET['action']) {
      case 'updateUser':
        $fullname = $_GET['fullname'];
        $phone = $_GET['phone'];
        $address = $_GET['address'];
        $email = $_GET['email'];
        $sql1 = "UPDATE Nguoidung
                SET hoten='" . $fullname . "',
                    sdt='" . $phone . "',
                    diaChi='" . $address . "',
                    email='" . $email . "'
                WHERE idnguoidung='" . $_SESSION['userID'] . "'";
        $result1 = $dp->excuteQuery($sql1);
      
        if ($result1) {
          echo "Success";
        } else {
          echo "Error";
        } 
        break;
      case 'updateAccount':
        $username = $_GET['username'];
        $fullname = $_GET['fullname'];
        $phone = $_GET['phone'];
        $password = $_GET['password'];
        $md5Pass = md5($password);
        $address = $_GET['address'];
        $email = $_GET['email'];
        $role = $_GET['role'];
        $id=$dp->getAccountIDByusername($username);
        $sql1 = "UPDATE nguoidung
                SET hoTen='" . $fullname . "',
                    SDT='" . $phone . "',
                    diaChi='" . $address . "',
                    email='" . $email . "'
                WHERE idnguoidung=" . $id ;
        $result1 = $dp->excuteQuery($sql1);
        $sql2 = "UPDATE taikhoan SET vaitro=" . $role . " WHERE username='" . $username . "'";
        $result2 = $dp->excuteQuery($sql2);
        if(strcmp($password,"") != 0){
          $sql3 = "UPDATE taikhoan SET password='" . $md5Pass . "' WHERE username='" . $username . "'";
          $result3 = $dp->excuteQuery($sql3);
        }
        
        if ($result1 && $result2) {
          if(strcmp($password,"") != 0 && $result3){
            echo "Success";
          }
          else if(strcmp($password,"") != 0 &&!$result3){
            echo "Error";
          }
          else{
            echo "Success";
          }
        } else {
          echo "Error";
        }
        break;
      case 'updatePassword':
        $oldPassword = $_GET['oldPassword'];
        $newPassword = $_GET['newPassword'];
        $confirmNewPassword = $_GET['confirmNewPassword'];
        $username = $_SESSION['userName'];
        $result = $dp->getUserByUsername($username);
        if ($result != null) {
          if (mysqli_num_rows($result) == 0) {
            echo 'Account does not exist!';
          } else {
            $user = $result->fetch_assoc();
            $password = $user['matKhau'];
            if ($password != md5($oldPassword)) {
              echo 'Old password is not correct!';
            } else {
              $md5Pass = md5($newPassword);
              $sql = "UPDATE taikhoan
                SET password='" . $md5Pass .
                "' WHERE username='" . $username . "'";
              $result = $dp->excuteQuery($sql);
              if ($result) {
                echo "Success";
              } else {
                echo "Error";
              }
            }
          }
        }
        break;
    }
    break;
}