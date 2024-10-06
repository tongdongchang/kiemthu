<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$_POST['id'];
    $ten=$dp->getNameID($id,2);
?>
<div >
<h2>Edit Loại</h2>

<form id="update-Loai" onsubmit="updateItems()" enctype='multipart/form-data'>
    <div class="form-group">
      <label for="name">Mã Loại:</label>
      <input type="text" class="form-control loaiID"disabled value="<?=$id?>">
    </div>
    <div class="form-group">
      <label for="desc">Tên loại:</label>
      <input type="text" class="form-control loaiName" value="<?=$ten?>" >
    </div>
    <div class="form-group">
    <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowLoai()">Back</button>
      <button type="button" style="height:40px" class="btn btn-primary" onclick="updateloai()">Update Loại</button>
    </div>
  </form>
    </div>