<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$_POST['id'];
    $sql="SELECT * FROM sanpham where idsanpham=".$id." and idmau=0";
    $result=$dp->excuteQuery($sql);
    $product=$result-> fetch_assoc();
?>
<div >
  <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowSanPham()" >Back</button>
  <h2>Chi Tiết Sản Phẩm </h2>
  <h4 class="modal-title">Mã sản phẩm : <?=$product['idsanpham']?></h4>
  <h4 class="modal-title">Tên sản phẩm : <?=$product['tensanpham']?></h4>
    <!-- Trigger the modal with a button -->
    <?php if(checkCanAccess(3)){?>
    <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#newColorProduct">
    New Color Product
  </button>
  <?php }?>
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Màu</th>
        <th class="text-center">Số lượng</th>
        <th class="text-center">Hình</th>
        <th class="text-center">Trạng thái</th>
        <th class="text-center" <?php if(checkCanAccess(5)){?>colspan="2"<?php }?>>Action</th>
      </tr>
    </thead>
    <?php
      $sql="SELECT * from sanpham join mau on sanpham.idmau=mau.idmau where idsanpham='".$id."' and sanpham.idmau!=0";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["tenMau"]?></td>    
      <td><?=$row["soLuong"]?></td> 
      <td><img src="data/img/<?=$id?>/<?=$row['hinh']?>" class="dataimg"></td>
      <?php
        if(checkCanAccess(5)){
        if($row['trangthai']==1)
          echo '<td>Hoạt động</td><td><button type="button" class="btn btn-danger" style="height:40px" onclick="deleteColorID('.$id.','.$row['idmau'].')">Dừng hoạt động</button></td>';
        else
          echo '<td>Ngưng Hoạt động</td><td><button type="button" class="btn btn-primary" style="height:40px" onclick="restoreColorID('.$id.','.$row['idmau'].')">Hoạt động</button></td>';
        }
      ?>
      <?php if(checkCanAccess(4)){?>
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="editchitietsanpham(<?=$id?>,<?=$row['idmau']?>)">Edit</button></td>
      <?php }?>
      </tr>
      <?php
          }
        }
      ?>
  </table>



  <!-- Modal -->
  <div class="modal fade" id="newColorProduct" role="dialog">
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
              <label> màu:</label>
              <select id="category" class="form-control color">
                <option id="" disabled value="NaN" selected>Chọn</option>
                <?php
                  $sql="SELECT * from mau where idmau!=0 and idmau not in (select mau.idmau from sanpham join mau on sanpham.idmau=mau.idmau where idsanpham=".$id.") ";
                  $result = $dp-> excuteQuery($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      echo"<option value='".$row['idmau']."'>".$row['tenMau'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group imagecontent">
              <label for="name">Hình:</label>
              <input type="file" class="fileToUpload form-control imgsrc" onchange="uploadImg(<?=$id?>)"></input>
              <img width="100%" class="img" src="data/img/default.jpg" alt="img">
            </div>
            
          </form>

        </div>
        <div class="modal-footer">
              <button  class="btn btn-secondary" id="upload" style="height:40px" onclick="newProductColor('<?=$product['idsanpham']?>','<?=$product['tensanpham']?>','<?=$product['idphong']?>','<?=$product['idloai']?>','<?=$product['gia']?>','<?=$product['mota']?>')">Add Item</button>           
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