<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$_POST['id'];
    $role=getRole($id);
    $listPermission=getListPermission($id);
?>
<div >

<h2>Edit Quyền</h4>
<form id="update-Items" class="info-role" onsubmit="updateItems()" enctype='multipart/form-data'>
<div class="form-group">
      <label for="desc">Mã Quyền:</label>
      <input type="text" class="form-control" disabled value="<?=$role['idvaitro']?>">
    </div>
    <div class="form-group">
      <label for="desc">Tên Quyền:</label>
      <input type="text" class="form-control roleName" <?php if (!checkCanAccess(15)): ?>disabled<?php endif ?> value="<?=$role['tenvaitro']?>">
    </div>
            <div class="form-group">
      <label for="desc">Mô tả:</label>
      <input type="text" class="form-control roleDes"<?php if (!checkCanAccess(15)): ?>disabled <?php endif ?>value="<?=$role['mota']?>" >
    </div>
    <table class="table role-placeholder">
    <?php

      $sql="SELECT * from mottaquyen";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          if($row['tieude']==1){
            ?><tr>
                <th class="text-center" colspan="2"><?=$row['model']?></th>
            <?php
          }
          ?>
          </tr><tr>
      <td class="permission-text" ><?=$row["mota"]?></td>    
      <td> <div class="checkbox-placeholder"><input type="checkbox" value="<?= $row['idquyen'] ?>" <?php if (!checkCanAccess(15)): ?> disabled<?php endif ?> <?php if (checkExist($row['idquyen'] )): ?>checked<?php endif ?>></div></td>
      </tr>
      <?php
          }
        }
      ?>
  </table>
    <div class="form-group">
    <button type="button" style="height:40px" class="btn btn-danger" onclick="ShowQuyen()">Back</button>
    <?php if (checkCanAccess(15)): ?> <button type="button" style="height:40px" onclick="updateRole(<?=$id?>)" class="btn btn-primary">Update Item</button><?php endif ?>
      
    </div>
  </form>
    </div>
  <?php
  function getRole($roleID)
  {
      global $dp;
      $sql='select * from vaitro where idvaitro='.$roleID;
      $result = $dp->excuteQuery($sql);
      return $result->fetch_assoc();
  }
  function checkCanAccess($permission)
  {
      if (in_array($permission, $_SESSION['permission']))
          return true;
      return false;
  }
  function checkExist($perID)
{
    global $listPermission;
    foreach ($listPermission as $per) {
        if ($per == $perID) {
            return true;
        }
    }
    return false;
  }
  function getListPermission($roleID)
{
    global $dp;
    $sql = "SELECT * FROM quyen where idvaitro = " . $roleID;
    $result = $dp->excuteQuery($sql);
    $listPermission = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($listPermission, $row['idquyen']);
        }
    }
    return $listPermission;
}
  ?>
  