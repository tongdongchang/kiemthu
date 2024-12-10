<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
?>
<div >
  <h2>Tài Khoản </h2>
    <!-- Trigger the modal with a button -->
    <?php if(checkCanAccess(11)){?>
    <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#new-account">
    New Account
  </button>
  <?php }?>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Username</th>
        <th class="text-center">Ngày tạo</th>
        <th class="text-center">Vai trò</th>
        <th class="text-center">Họ tên</th>
        <th class="text-center">Email</th>
        <?php if(checkCanAccess(12)){?>
        <th class="text-center" colspan ="2">Action</th>
        <?php }?>
      </tr>
    </thead>
    <?php
      $sql="SELECT * from taikhoan tk join nguoidung ng on tk.idnguoidung=ng.idnguoidung join vaitro on vaitro=idvaitro where trangthai=1 ";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["username"]?></td>       
      <td><?=$row["ngaytao"]?></td>
      <td><?=$row["tenvaitro"]?></td>
      <td><?=$row["hoten"]?></td>
      <td><?=$row["email"]?></td>
      <?php if(checkCanAccess(12)){?>
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="editTaiKhoan('<?=$row['username']?>')">Edit</button></td>
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="xoataikhoan('<?=$row['username']?>')">Delete</button></td>
        <?php }?>
    </tr>
      <?php
          }
        }
      ?>
  </table>



  <!-- Modal -->
  <div class="modal fade" id="new-account" role="dialog" >
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Tài Khoản</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  enctype='multipart/form-data' onsubmit="addItems()" method="POST">

    <div class="form-group">
      <label for="desc">Username:</label>
      <input type="text" class="form-control username"  >
    </div>
    <div class="form-group" style="position: relative;">
  <label for="desc">Password:</label>
  <input type="password" class="form-control password" id="password">
  <span class="toggle-password" onclick="togglePasswordVisibility()" 
        style="position: absolute; right: 10px; top: 55%; cursor: pointer;">
    👁️
  </span>
</div>

<script>
  function togglePasswordVisibility() {
    const passwordField = document.getElementById("password");
    const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
    passwordField.setAttribute("type", type);
  }
</script>

    <div class="form-group">
              <label>Vai trò:</label>
              <select id="category " class="role form-control">
                <option disabled value="NaN" selected>Chọn</option>
                <?php
                  $sql="SELECT * from vaitro where idvaitro>1";
                  $result = $dp-> excuteQuery($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      echo"<option value='".$row['idvaitro']."'>".$row['tenvaitro'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
    <div class="form-group">
      <label for="desc">Họ Tên:</label>
      <input type="text" class="form-control name"  >
    </div>
    <div class="form-group">
      <label for="desc">email:</label>
      <input type="text" class="form-control email"  >
    </div>
    <div class="form-group">
      <label for="desc">SĐT :</label>
      <input type="text" class="form-control phoneNumber"  >
    </div>
    <div class="form-group">
      <label for="desc">Địa chỉ:</label>
      <input type="text" class="form-control address"  >
    </div>
       <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="upload" style="height:40px" onClick="createNewAccount()">Add Item</button>
          <button type="button" class="btn btn-default closemodal" data-dismiss="modal" style="height:40px">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
function checkCanAccess($permission)
{   
    if (in_array($permission, $_SESSION['permission']))
        return true;
    return false;
}
?>