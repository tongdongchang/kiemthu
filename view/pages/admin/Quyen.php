<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
?>
<div >
  <h2>Quyền </h2>
  <?php if (checkCanAccess(14)): ?> 
  <button type="button" class="btn btn-secondary " style="height:40px" onclick="newQuyen()">
    New role
  </button><?php endif ?>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Mã quyền</th>
        <th class="text-center">Tên quyền</th>
        <th class="text-center">Mô tả</th>
        <th class="text-center" <?php if (checkCanAccess(16)): ?>colspan="2"<?php endif ?>>Action</th>
      </tr>
    </thead>
    <?php

      $sql="SELECT * from vaitro where idvaitro>3";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["idvaitro"]?></td>
      <td><?=$row["tenvaitro"]?></td>      
      <td><?=$row["mota"]?></td>    
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="editQuyen('<?=$row['idvaitro']?>')">Detail</button></td>
      <?php if (checkCanAccess(16)): ?><td><button type="button" class="btn btn-danger" style="height:40px" onclick="deleteRole(<?=$row['idvaitro']?>)" >Delete</button></td><?php endif ?>
      </tr>
      <?php
          }
        }
      ?>
  </table>
</div>
<?php
function checkCanAccess($permission)
{   
    if (in_array($permission, $_SESSION['permission']))
        return true;
    return false;
}
?>