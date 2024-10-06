<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$_POST['id'];
    $ten=$dp->getNameID($id,1);
?>
<div >
<h2>Edit Phòng</h2>

<form id="update-Phong" onsubmit="updateItems()" enctype='multipart/form-data'>
<div class="form-group">
      <label for="desc">Mã phòng:</label>
      <input type="text" class="form-control phongID" disabled value="<?=$id?>">
    </div>
    <div class="form-group">
      <label for="desc">Tên phòng:</label>
      <input type="text" class="form-control phongName" value="<?=$ten?>" >
    </div>
    <div class="form-group">
    <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowPhong()">Back</button>
      <button type="button" style="height:40px" class="btn btn-primary" onclick="updatephong()">Update Phòng</button>
    </div>
  </form>
    </div>