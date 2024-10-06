<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
?>
<div >
<h2>Phòng </h2>
<button type="button" class="btn btn-danger" style="height:40px" onclick="ShowSanPham()">Back</button>
<button type="button" class="btn btn-secondary " style="height:40px" data-toggle="modal" data-target="#new-Phong">
    Add Room
  </button> 
  <table class="table ">
    <thead>
      <tr>
        <th class="text-center">Mã Phòng</th>
        <th class="text-center">Tên phòng</th>
        <th class="text-center" >Action</th>
      </tr>
    </thead>
    <?php
      $sql="SELECT * from phong  where idphong!=0";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
    ?>
    <tr>
      <td><?=$row["idphong"]?></td>
      <td><?=$row["tenphong"]?></td>   
      <td><button type="button" class="btn btn-primary" style="height:40px" onclick="editPhong('<?=$row['idphong']?>')">Edit</button></td>
      </tr>
      <?php
          }
        }
      ?>
  </table>

  <!-- Trigger the modal with a button -->
 

  <!-- Modal -->
  <div class="modal fade" id="new-Phong" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Phòng</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  enctype='multipart/form-data' onsubmit="addItems()" method="POST">
    <div class="form-group">
      <label for="desc">Tên phòng:</label>
      <input type="text" class="form-control PhongName"  >
    </div>   
          </form>

        </div>
       <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="upload" style="height:40px" onclick="newphong()">Add Item</button>
          <button type="button" class="btn btn-default" data-dismiss="modal" style="height:40px">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  
</div>
   