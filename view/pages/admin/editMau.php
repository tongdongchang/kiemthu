<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$_POST['id'];
    $ten=$dp->getNameID($id,3);
?>
<div >

<h2>Edit màu</h2>

<form id="update-Mau" onsubmit="updateItems()" enctype='multipart/form-data'>
<div class="form-group">
      <label for="desc">Mã màu:</label>
      <input type="text" class="form-control mauID" disabled value="<?=$id?>">
    </div>
    <div class="form-group">
      <label for="desc">Tên màu:</label>
      <input type="text" class="form-control mauName" value="<?=$ten?>"   >
    </div>
    <div class="form-group">
      <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowMau()">Back</button>
      <button type="button" style="height:40px" class="btn btn-primary" onclick="updatemau()">Update Màu</button>
    </div>
  </form>
    </div>