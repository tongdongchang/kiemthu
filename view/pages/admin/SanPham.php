<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $newId=$dp->getNewProductId()
?>
<div >
  <h2>Sản Phẩm </h2>
  <?php if(checkCanAccess(3)||checkCanAccess(4)){?>
  <button type="button" class="btn btn-primary" style="height:40px" onclick="ShowMau()" >Màu</button>
  <button type="button" class="btn btn-primary" style="height:40px" onclick="ShowPhong()">Phòng</button>
  <button type="button" class="btn btn-primary" style="height:40px" onclick="ShowLoai()">Loại</button>
  <?php }?>
    <!-- Trigger the modal with a button -->
    <?php if(checkCanAccess(3)){?>
    <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#new-Product">
    New Product
  </button>
  <?php }?>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Mã sản phẩm</th>
        <th class="text-center">Tên sản phẩm</th>
        <th class="text-center">Phòng</th>
        <th class="text-center">Loại</th>
        <th class="text-center">Giá</th>
        <th class="text-center"<?php if(checkCanAccess(4)){?> colspan="2"<?php }?>>Action</th>
      </tr>
    </thead>
    <?php
      $sql="SELECT DISTINCT idsanpham,tenphong,tenloai,tensanpham,gia from sanpham join loai on sanpham.idloai=loai.idloai join phong on sanpham.idphong=phong.idphong ";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["idsanpham"]?></td>    
      <td><?=$row["tensanpham"]?></td>     
      <td><?=$row["tenphong"]?></td> 
      <td><?=$row["tenloai"]?></td>
      <td><?=$row["gia"]?></td>   
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="ShowChiTietSanPham('<?=$row['idsanpham']?>')">Detail</button></td>
      <?php if(checkCanAccess(4)){?>
        <td><button type="button" class="btn btn-primary" style="height:40px" onclick="itemEditForm('<?=$row['idsanpham']?>')">Edit</button></td>
        <?php }?>
      </tr>
      <?php
          }
        }
      ?>
  </table>



  <!-- Modal -->
  <div class="modal fade" id="new-Product" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Sản Phẩm</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  enctype='multipart/form-data' onsubmit="addItems()" method="POST">
            <div class="form-group">
              <label>Mã phòng:</label>
              <select id="category" class="form-control PhongID">
                <option disabled selected value="">Chọn</option>
                <?php
          
                  $sql="SELECT * from phong where idphong!=0";
                  $result = $dp-> excuteQuery($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      echo"<option value='".$row['idphong']."'>".$row['tenphong'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Mã loại:</label>
              <select id="category" class="form-control LoaiID">
                <option disabled selected value="">Chọn</option>
                <?php
          
                  $sql="SELECT * from loai where idloai!=0";
                  $result = $dp-> excuteQuery($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      echo"<option value='".$row['idloai']."'>".$row['tenloai'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Tên sản phẩm:</label>
              <input type="text" class="form-control ProductName" id="p_name" required>
            </div>
            <div class="form-group">
              <label for="name">Mô tả:</label>
              <input type="text" class="form-control ProductDescribe" id="p_name" required>
            </div>          
          </form>
        </div>
        <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="upload" style="height:40px" onclick="newProduct()">New Item</button>           
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
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