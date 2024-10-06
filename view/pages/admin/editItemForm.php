<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $productID=$_POST["id"];
    $product=getProductInfo($productID);
?>
<div >

<h2>Edit Sản Phẩm</h2>

<form id="edit-product" onsubmit="updateItems()" enctype='multipart/form-data'>
<div class="form-group">
              <label for="name"> sản phẩm:</label>
              <input type="text" class="form-control" id="p_name" value="<?=$product['idsanpham']?>"  disabled>
            </div>
            <div class="form-group">
              <label> phòng:</label>
              <select id="category " class="form-control phongID" >
                <?php
          
                  $sql="SELECT * from phong where idphong!=0";
                  $result = $dp-> excuteQuery($sql);

                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      if($product['idphong']==$row['idphong'])
                      echo"<option value='".$row['idphong']."' selected>".$row['tenphong'] ."</option>";
                      else
                      echo"<option value='".$row['idphong']."'>".$row['tenphong'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label> loại:</label>
              <select id="category" class="form-control loaiID" >
                <?php
                  $sql="SELECT * from loai where idloai!=0";
                  $result = $dp-> excuteQuery($sql);
                  if ($result-> num_rows > 0){
                    while($row = $result-> fetch_assoc()){
                      if($product['idloai']==$row['idloai'])
                      echo"<option value='".$row['idloai']."' selected>".$row['tenloai'] ."</option>";
                      else
                      echo"<option value='".$row['idloai']."'>".$row['tenloai'] ."</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Tên sản phẩm:</label>
              <input type="text" class="form-control productName" id="p_name" value="<?=$product['tensanpham']?>" required>
            </div>
            <div class="form-group">
              <label for="name">Giá:</label>
              <input type="number" class="form-control productPrice" id="p_name" value="<?=$product['gia']?>" required>
            </div>
            <div class="form-group">
              <label for="name">Mô tả:</label>
              <input type="text" class="form-control productDescribe" id="p_name" value="<?=$product['mota']?>" required>
            </div>
            <div class="form-group">
      <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowSanPham()">Back</button>
      <button type="button"  style="height:40px" class="btn btn-primary" onclick="updateProduct(<?=$product['idsanpham']?>)">Update Product</button>
    </div>
  </form>
    </div>
    <?php
    function getProductInfo($productID)
    {
        global $dp;
        $sql = "SELECT * FROM sanpham
                WHERE idsanpham ='" . $productID."'";
        $result = $dp->excuteQuery($sql);
        return $result->fetch_assoc();
    }
    ?>