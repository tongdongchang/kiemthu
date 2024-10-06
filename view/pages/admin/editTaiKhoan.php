<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
   $username = $_POST["id"];
    $account=getAccount($username);
?>
<div >

<h2>Edit Tài Khoản</h4>

<form id="edit-account" onsubmit="updateItems()" enctype='multipart/form-data'>
    <div class="form-group">
      <label for="desc">Username:</label>
      <input type="text" class="form-control username" value="<?=$account['username']?>" disabled >
    </div>
    <div class="form-group">
      <label for="desc">Ngày tạo:</label>
      <input type="text" class="form-control" value="<?=$account['ngaytao']?>" disabled>
    </div>
    <div class="form-group">
              <label>Vai trò:</label>
              <select id="category" class="form-control roleAccount" <?php if ($account['vaitro'] == 1) {
                    echo 'disabled';
                } ?> >
                <?php
                if ($account['vaitro'] != 1){
                  $sql="SELECT * from vaitro where idvaitro>1";
                  $result = $dp-> excuteQuery($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      if($account['vaitro']==$row['idvaitro'])
                      echo'<option selected value="'.$row['idvaitro'].'">'.$row['tenvaitro'].'</option>';
                      else
                      echo'<option value="'.$row['idvaitro'].'">'.$row['tenvaitro'] .'</option>';
                    }
                  }
                }
                else{
                  echo'<option selected value="1">khachhang</option>';
                }
                ?>
              </select>
            </div>
      <div class="form-group">
      <label for="desc">Họ tên:</label>
      <input type="text" class="nameAccount form-control" value="<?=$account['hoten']?>" disabled >
    </div>       
    <div class="form-group">
      <label for="desc">SĐT:</label>
      <input type="text" class="phoneAccount form-control" value="<?=$account['sdt']?>"  disabled>
    </div>
    <div class="form-group">
      <label for="desc">Địa chỉ:</label>
      <input type="text" class="addressAccount form-control" value="<?=$account['diachi']?>" disabled>
    </div>
    <div class="form-group">
      <label for="desc">Email:</label>
      <input type="text" class="emailAccount form-control" value="<?=$account['email']?>" disabled>
    </div>
    <div class="form-group">
      <label for="desc">Password:</label>
      <input type="password" class="passwordAccount form-control">
    </div>
    <div class="form-group">
      <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowTaiKhoan()">Back</button>
      <button type="button" style="height:40px" class="btn btn-primary" onclick="updateAccount()">Update Tài Khoản</button>
    </div>
  </form>
    </div>
    <?php
    function getAccount($accountID)
    {
        global $dp;
        $sql = "SELECT * FROM taikhoan
                join nguoidung on taikhoan.idnguoidung = nguoidung.idnguoidung
                join vaitro on taikhoan.vaiTro = vaitro.idvaitro
                WHERE username ='" . $accountID."'";
        $result = $dp->excuteQuery($sql);
        return $result->fetch_assoc();
    }
    ?>