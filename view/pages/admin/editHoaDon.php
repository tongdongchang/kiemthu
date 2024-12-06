<?php
   session_start();
   require("../../../util/dataProvider.php");
  $dp=new DataProvider();
  $id=$_POST['id'];
  $info = getInfoOrder($id);
  $products = getProductInOrder($id);
?>
<div id="new-supply">
   <h2>Thông tin hóa đơn </h2>
   
  <div class="form-group">
    <h4 for="qty">Mã hóa đơn :</h4>
    <input type="text" class="form-control supplyID" id="p_desc" value="<?=$info['idhoadon']?>" disabled>
  </div>
  <div class="form-group">
    <h4 for="qty">Người mua :</h4>
    <input type="text" class="form-control supplyID" id="p_desc" value="<?=$info['username']?>" disabled>
  </div>
  <div class="form-group">
    <h4 for="qty">Ngày mua :</h4>
    <input type="text" class="form-control supplyID" id="p_desc" value="<?=$info['thoigiandat']?>" disabled>
  </div>
  
  <div class="form-group">
    <h4 for="qty">Người phụ trách :</h4>
    <?php if($info['idphutrach']==""){?>
    <input type="text" class="form-control supplyID" id="p_desc" disabled>
      <?php }else{
        $name=getName($info['idphutrach']);
        ?>
        <input type="text" class="form-control supplyID" id="p_desc" value="<?=$name['hoten']?>" disabled>
        <?php }?>
  </div>
  <table class="table list-suply">
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Tên Sản Phẩm</th>
        <th class="text-center">Màu</th>
        <th class="text-center">Số lượng</th>
        <th class="text-center">Đơn giá</th>
        <th class="text-center">Thành Tiền</th>
  
      </tr>
    </thead>
    <?php for ($i = 0; $i < count($products); $i++): ?>
      <tr id="row-<?=$products[$i]['idsanpham']?>-<?=$products[$i]['idmau']?>">
        <td><?=$i+1?></td>
        <td><?=$products[$i]['tensanpham']?></td>
        <td><?=$products[$i]['tenMau']?></td>
        <td><?=$products[$i]['soluong_hd']?></td>
        <td><?=$products[$i]['Gia']*1.45?></td>
        <td><?=$products[$i]['soluong_tt']?></td>
        
      </tr>

      <?php endfor; ?>
  </table>
  <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowHoaDon()">Back</button>
 <?php if(checkCanAccess(7)&&$info['trangthai']==1){?> <button type="button" class="btn btn-primary confirmID" data-id ="<?=$id?>" style="height:40px" onclick="confirmOrder(<?=$id?>)">Confirm</button><?php }?>
 <?php if(checkCanAccess(7)&&$info['trangthai']==1){?> <button type="button" class="btn btn-primary confirmID" data-id ="<?=$id?>" style="height:40px" onclick="cancelOrder(<?=$id?>)">Cancel</button><?php }

 ?>

  <?php
function getInfoOrder($recordID)
{
    global $dp;
    $dp = new DataProvider();
    $sql = "SELECT * FROM hoadon join taikhoan on hoadon.idnguoidung=taikhoan.idnguoidung WHERE idhoadon = $recordID";
    $result = $dp->excuteQuery($sql);
    return $result->fetch_assoc();
}
function getProductInOrder($recordID)
{
    global $dp;
    $dp = new DataProvider();
    $sql = "SELECT sanpham.*, mau.*,chitietphieunhap.*,chitiethoadon.soluong AS soluong_hd,chitiethoadon.thanhtien AS soluong_tt FROM chitiethoadon join sanpham on chitiethoadon.idsanpham=sanpham.idsanpham and chitiethoadon.idmau=sanpham.idmau 
    join mau on chitiethoadon.idmau=mau.idmau join chitietphieunhap on chitiethoadon.idsanpham = chitietphieunhap.idsanpham and chitiethoadon.idmau=chitietphieunhap.idmau
    WHERE idhoadon = $recordID and chitietphieunhap.Gia > 0 and chitietphieunhap.soluong >0
    GROUP BY sanpham.idsanpham, sanpham.idmau
";
    $result = $dp->excuteQuery($sql);
    $detailRecord = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($detailRecord, $row);
        }
    }
    return $detailRecord;
}

function getName($recordID)
{
    global $dp;
    $dp = new DataProvider();
    $sql = "SELECT * FROM nguoidung  WHERE idnguoidung = $recordID";
    $result = $dp->excuteQuery($sql);
    return $result->fetch_assoc();
}
function checkCanAccess($permission)
{   
    if (in_array($permission, $_SESSION['permission']))
        return true;
    return false;
}
?>