<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
?>
<div >
  <h2>Hóa Đơn </h2>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Mã Hóa Đơn</th>
        <th class="text-center">Tên khách hàng</th>
        <th class="text-center">Thời gian đặt</th>
        <th class="text-center">Trạng Thái</th>
        <th class="text-center">Địa chỉ giao hàng</th>
        <th class="text-center" >Action</th>
      </tr>
    </thead>
    <?php
      $sql="SELECT * from hoadon";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["idhoadon"]?></td>
      <td><?=getName($row["idnguoidung"])?></td>      
      <td><?=$row["thoigiandat"]?></td>    
      <?php if($row['trangthai']==1)
      echo '<td>chờ xử lý</td>';
       if($row['trangthai']==0)
      echo '<td>hủy</td>';
       if($row['trangthai']==2)
        echo ' <td>đã xử lý</td> ';
      ?>
      <td><?=$row["diachigiaohang"]?></td>     
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="editHoaDon('<?=$row['idhoadon']?>')">Detail</button></td>
      </tr>
      <?php
          }
        }
      ?>
  </table>


  
</div>
   <?php
   function getName($recordID)
   {
       global $dp;
       $dp = new DataProvider();
       $sql = "SELECT * FROM nguoidung  WHERE idnguoidung = $recordID";
       $result = $dp->excuteQuery($sql);
       return $result->fetch_assoc()['hoten'];
   }
   ?>