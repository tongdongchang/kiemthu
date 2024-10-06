<?php
class DataProvider
{
  public static function excuteQuery($sql)
  {
    include('conInfo.php');
    if (!$connection = mysqli_connect($servername, $username, $password, $dbname)) {
      die("couldn't connect to localhost");
    }
    if (!(mysqli_select_db($connection, $dbname))) {
      echo "Khong the ket noi den database";
    }
    if (!(mysqli_query($connection, "set names 'utf8'"))) {
      echo "Khong the set utf8";
    }
    if (!($result = mysqli_query($connection, $sql))) {
      echo "Khong the thuc thi cau truy van";
    }
    if (!(mysqli_close($connection))) {
      echo "Khong the ket noi 404";
    }
    return $result;
  }
  public static function getNewProductId()
  {
    $sql = "SELECT MAX(idsanpham) FROM sanpham";
    $result = self::excuteQuery($sql);
    if (mysqli_num_rows($result) != 0) {
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idsanpham)'] + 1;
    }
    return 1;
  }
  public static function getUserByUsername($username)
  {
    $sql = "select * from taikhoan join nguoidung on taikhoan.idnguoidung=nguoidung.idnguoidung
    where username='" . $username . "'";
    return self::excuteQuery($sql);
  }
  public static function getPermissionByRoleID($roleID)
  {
    $sql = "SELECT idquyen FROM quyen where idvaitro = " . $roleID;
    $result = Self::excuteQuery($sql);
    $permissions = array();
    while ($row = $result->fetch_assoc()) {
      array_push($permissions, $row['idquyen']);
    }
    return $permissions;
  }
  public static function getAccountIDByusername($username)
  {
    $sql = "SELECT idnguoidung FROM taikhoan where username = '" . $username."'";
    $result = Self::excuteQuery($sql);
    if (mysqli_num_rows($result) != 0) {
      return self::excuteQuery($sql)->fetch_assoc()['idnguoidung'] + 1;
    }
    return -1;
  }
  public static function isFavorite($proID, $userID)
  {
    $sql = "SELECT * FROM yeuthich where idsanpham = " . $proID . " and idnguoidung ='" . $userID . "'";
    $result = self::excuteQuery($sql);
    if ($result->num_rows > 0) {
      return true;
    }
    return false;
  }
  public static function getItemInCart($colorID,$itemID,$userID)
  {
    $sql = "SELECT * FROM giohang where idnguoidung = '" . $userID . "' and idsanpham = " . $itemID." and idmau=".$colorID;
    return self::excuteQuery($sql);
  }
  public static function getNewHoaDonId()
  {
    $sql = "SELECT MAX(idhoadon) FROM hoadon";
    $result = self::excuteQuery($sql);
    if (mysqli_num_rows($result) != 0) {
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idhoadon)'] + 1;
    }
    return 1;
  }
  public static function getNewPhieuNhapId()
  {
    $sql = "SELECT MAX(idphieunhap) FROM phieunhap";
    $result = self::excuteQuery($sql);
    if (mysqli_num_rows($result) != 0) {
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idphieunhap)'] + 1;
    }
    return 1;
  }
  public static function getNewLoaiId()
  {
    $sql = "SELECT MAX(idloai) FROM loai";
    $result = self::excuteQuery($sql);
    if (mysqli_num_rows($result) != 0) {
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idloai)'] + 1;
    }
    return 1;
  }
  public static function getNewPhongId()
  {
    $sql = "SELECT MAX(idphong) FROM phong";
    $result = self::excuteQuery($sql);
    if (mysqli_num_rows($result) != 0) {
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idphong)'] + 1;
    }
    return 1;
  }
  public static function getNewMauId()
  {
    $sql = "SELECT MAX(idmau) FROM mau";
    $result = self::excuteQuery($sql);
    if (mysqli_num_rows($result) != 0) {
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idmau)'] + 1;
    }
    return 1;
  }
  public static function getNewUserId(){
    $sql="SELECT MAX(idnguoidung) from taikhoan";
    $result=self::excuteQuery($sql);
    if(mysqli_num_rows($result)!=0){
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idnguoidung)'] + 1;
    }
    return 1;
  }
  public static function getNewRoleId(){
    $sql="SELECT MAX(idvaitro) from vaitro";
    $result=self::excuteQuery($sql);
    if(mysqli_num_rows($result)!=0){
      return self::excuteQuery($sql)->fetch_assoc()['MAX(idvaitro)'] + 1;
    }
    return 1;
  }
  public static function getNameID($id,$type){
    if($type==1)
    $sql="SELECT tenphong as ten from phong where idphong=".$id;
    if($type==2)
    $sql="SELECT tenloai as ten from loai where idloai=".$id;
    if($type==3)
    $sql="SELECT tenMau as ten from mau where idmau=".$id;
    $result=self::excuteQuery($sql);
    if(mysqli_num_rows($result)!=0){
      return self::excuteQuery($sql)->fetch_assoc()['ten'];
    }
    return $result;
  }
}
  