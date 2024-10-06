<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$_POST['id'];
    $color=$_POST['color'];
    $sql="SELECT * FROM sanpham join mau on sanpham.idmau=mau.idmau where idsanpham=".$id." and sanpham.idmau=".$color;
    $result=$dp->excuteQuery($sql);
    $product=$result-> fetch_assoc();
?>
<div >
<h2>Edit chi tiết</h2>

<form id="updatechitiet" onsubmit="updateItems()" enctype='multipart/form-data'>
    <div class="form-group">
      <label for="name">Màu:</label>
      <input type="text" class="form-control loaiID"disabled value="<?=$product['tenMau']?>">
    </div>
    <div class="form-group imagecontent" id="updateimage">
              <label for="name">Hình:</label>
              <input type="file" class="fileToUpload form-control imgsrc" onchange="uploadImg(<?=$id?>)"></input>
              <img width="100%" class="img" src="data/img/<?=$product['hinh']?>" alt="img">
    </div>
    <div class="form-group">
    <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowChiTietSanPham(<?=$id?>)">Back</button>
      <button type="button" style="height:40px" class="btn btn-primary" onclick="updateimage(<?=$id?>,<?=$color?>)">Update Loại</button>
    </div>
  </form>
    </div>