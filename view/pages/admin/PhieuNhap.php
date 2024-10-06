<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$dp->getNewPhieuNhapId();
?>
<div >
  <h2>Phiếu Nhập </h2>
    <!-- Trigger the modal with a button -->
    <?php if(checkCanAccess(8)){?>
    <button type="button" class="btn btn-secondary " style="height:40px" onclick="ShowChiTietPhieuNhap(<?=$id?>)">
    New Supply
  </button>
  <?php }?>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Mã Phiếu Nhập</th>
        <th class="text-center">Mã người nhập</th>
        <th class="text-center">Ngày nhập</th>
        <th class="text-center" colspan="1">Action</th>
      </tr>
    </thead>
    <?php

      $sql="SELECT * from phieunhap join taikhoan on idnguoinhap=idnguoidung";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["idphieunhap"]?></td>
      <td><?=$row["username"]?></td>      
      <td><?=$row["ngaynhap"]?></td>    
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="ShowThongTinPhieuNhap('<?=$row['idphieunhap']?>')">Detail</button></td>
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