<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$dp->getNewRoleId();
?>
<div >

<h2>New quyền</h4>

<form id="update-Items" class="info-role" onsubmit="updateItems()" enctype='multipart/form-data'>
<div class="form-group">
      <label for="desc">Mã Quyền:</label>
      <input type="text" class="form-control" disabled value="<?=$id?>" >
    </div>
    <div class="form-group">
      <label for="desc">Tên Quyền:</label>
      <input type="text" class="form-control roleName"  >
    </div>
            <div class="form-group">
      <label for="desc">Mô tả:</label>
      <input type="text" class="form-control roleDes"  >
    </div>
    <table class="table role-placeholder ">
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
      <td> <div class="checkbox-placeholder"><input type="checkbox" value="<?= $row['idquyen'] ?>" ></div></td>
      </tr>
      <?php
          }
        }
      ?>
  </table>
    <div class="form-group">
    <button type="button" style="height:40px" class="btn btn-danger" onclick="ShowQuyen()">Back</button>
      <button type="button" style="height:40px" class="btn btn-primary" onclick="addNewRole(<?=$id?>)">Create role</button>
    </div>
  </form>
    </div>
    <?php
function checkCanAccess($permission)
{   
    if (in_array($permission, $_SESSION['permission']))
        return true;
    return false;
}
?>