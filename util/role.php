<?php
session_start();
require("../util/dataProvider.php");
$dp = new DataProvider();
switch ($_SERVER["REQUEST_METHOD"]) {
    case 'POST':
        switch ($_POST["action"]) {
            case 'addNewRole':
                $roleID = $_POST["roleID"];
                $roleName = $_POST["roleName"];
                $roleDescription = $_POST["roleDescription"];
                $listPermission = $_POST["listPermission"];
                $sql = "INSERT INTO vaitro
                        VALUES (" . $roleID . ",'" . $roleName . "','" . $roleDescription . "')";
                $result1 = $dp->excuteQuery($sql);
                $sql = "INSERT INTO quyen
                        VALUES ";
                foreach ($listPermission as $permission) {
                    $sql .= "(" . $roleID . "," . $permission . "),";
                }
                $sql = substr($sql, 0, -1);
                $result2 = $dp->excuteQuery($sql);
                if ($result1 && $result2) {
                    echo "Success";
                } else {
                    echo "error";
                }
                break;
            case 'updateRole':
                $roleID = $_POST["roleID"];
                $roleName = $_POST["roleName"];
                $roleDescription = $_POST["roleDescription"];
                $listPermission = $_POST["listPermission"];
                $sql = "UPDATE vaitro
                        SET tenvaitro ='" . $roleName . "',
                            moTa = '" . $roleDescription . "'
                        WHERE idvaitro = " . $roleID;
                $result1 = $dp->excuteQuery($sql);
                $sql = "DELETE FROM quyen
                        WHERE idvaitro = " . $roleID;
                $result2 = $dp->excuteQuery($sql);
                $sql = "INSERT INTO quyen
                        VALUES ";
                foreach ($listPermission as $permission) {
                    $sql .= "(" . $roleID . "," . $permission . "),";
                }
                $sql = substr($sql, 0, -1);
                $result3 = $dp->excuteQuery($sql);
                if ($result1 && $result2 && $result3) {
                    echo "Success";
                } else {
                    echo "error";
                }
                break;
        }
        break;
    case 'DELETE':
        switch ($_GET["action"]) {
            case 'deleteRole':
                $roleID = $_GET["roleID"];
                $sql = "UPDATE taikhoan
                SET vaitro = 2
                WHERE vaitro = " . $roleID;
                $result3 = $dp->excuteQuery($sql);
                $sql = "DELETE FROM quyen
                        WHERE idvaitro = " . $roleID;
                $result1 = $dp->excuteQuery($sql);
                $sql = "DELETE FROM vaitro
                        WHERE idvaitro = " . $roleID;
                $result2 = $dp->excuteQuery($sql);
                if ($result1 && $result2 && $result3) {
                    echo "Success";
                } else {
                    echo "error";
                }
                break;
        }
        break;
}
