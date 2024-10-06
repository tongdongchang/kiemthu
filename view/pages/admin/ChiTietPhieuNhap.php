<?php
   session_start();
   require("../../../util/dataProvider.php");
  $dp=new DataProvider();
  $id=$_POST['id'];
  $productArray=array();
?>
<div id="new-supply">
   <h2>Chi Tiết Phiếu Nhập </h2>
   
  <div class="form-group">
    <h4 for="qty">Mã phiếu nhập :</h4>
    <input type="text" class="form-control supplyID" id="p_desc" value="<?=$id?>" disabled>
  </div>
    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#addNewSupply">
    Add product
  </button>
  <table class="table list-suply">
    <thead>
      <tr>
        <th class="text-center">Mã Sản Phẩm</th>
        <th class="text-center">Mã Màu</th>
        <th class="text-center">Tên Sản Phẩm</th>
        <th class="text-center">Màu</th>
        <th class="text-center">Giá</th>
        <th class="text-center">Số lượng</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
  </table>
  <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowPhieuNhap()">Back</button>
  <button type="button" class="btn btn-primary" style="height:40px" onclick="addNewSupply()">Add</button>


  <!-- Modal -->
  <div class="modal fade" id="addNewSupply" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Phiếu nhập mới</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="new-Product" enctype='multipart/form-data' onsubmit="addItems()" method="POST">
            <div class="form-group">
              <label>Mã sản phẩm:</label>
              <select id="productSelect" class="form-control  productID">
                <option disabled selected value="">Chọn</option>
                <?php
                  $sql="SELECT DISTINCT idsanpham,tensanpham from sanpham ";
                  $result = $dp-> excuteQuery($sql);
                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      $productID=$row['idsanpham'];
                      echo"<option value='".$row['idsanpham']."'>".$row['tensanpham'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Mã mẫu:</label>
              <select id="colorSelect" class="form-control colorID">
                <option disabled selected value="">Chọn</option>
              </select>
              </div>
              <div class="form-group">
              <label for="name">Giá:</label>
              <input type="number" class="form-control ProductPrice" id="p_name" required>
            </div>
            <div class="modal-footer">
              <button type="button"  class="btn btn-secondary" id="upload" style="height:40px" onclick="addExistingproduct()">Add Item</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
          </form>
        </div>
      </div>  
    </div>
  </div>
</div>
</div>
<script>
  $('#productSelect').change(function(){
    let productID=$('#productSelect').val();
    let colorSelect=$('#colorSelect');
    colorSelect.empty();
    $.ajax({
      url: "util/product.php?action=getListColorProduct&productID="+productID,
      type: "GET",
      success:function(res){
        if(res!="")
        colorSelect.html(res);
        else
        colorSelect.html('<option disabled value="" selected>Chọn</option>');
      }
    }); 
  })
</script>