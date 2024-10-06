<?php
   session_start();
   require("../../../util/dataProvider.php");
  $dp=new DataProvider();
  $id=$_POST['id'];
  $info = getInfoSupply($id);
  $products = getProductInSupply($id);
?>
<div id="new-supply">
   <h2>Thông tin phiếu nhập </h2>
   <button type="button" class="btn btn-danger" style="height:40px" onclick="ShowPhieuNhap()">Back</button>
  <div class="form-group">
    <h4 for="qty">Mã phiếu nhập :</h4>
    <input type="text" class="form-control supplyID" id="p_desc" value="<?=$info['idphieunhap']?>" disabled>
  </div>
  <div class="form-group">
    <h4 for="qty">Người nhập :</h4>
    <input type="text" class="form-control supplyID" id="p_desc" value="<?=$info['username']?>" disabled>
  </div>
  <div class="form-group">
    <h4 for="qty">Ngày nhập :</h4>
    <input type="text" class="form-control supplyID" id="p_desc" value="<?=$info['ngaynhap']?>" disabled>
  </div>
  <table class="table list-suply">
    <thead>
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Tên Sản Phẩm</th>
        <th class="text-center">Màu</th>
        <th class="text-center">Số lượng</th>

      </tr>
    </thead>
    <?php for ($i = 0; $i < count($products); $i++): ?>
      <tr>
        <td><?=$i+1?></td>
        <td><?=$products[$i]['tensanpham']?></td>
        <td><?=$products[$i]['tenMau']?></td>
        <td><?=$products[$i]['soluong']?></td>

      </tr>

      <?php endfor; ?>
  </table>
  <?php
function getInfoSupply($recordID)
{
    global $dp;
    $dp = new DataProvider();
    $sql = "SELECT * FROM phieunhap join taikhoan on idnguoinhap=idnguoidung WHERE idphieunhap = $recordID";
    $result = $dp->excuteQuery($sql);
    return $result->fetch_assoc();
}
function getProductInSupply($recordID)
{
    global $dp;
    $dp = new DataProvider();
    $sql = "SELECT * FROM chitietphieunhap join sanpham on chitietphieunhap.idsanpham=sanpham.idsanpham and chitietphieunhap.idmau=sanpham.idmau 
    join mau on chitietphieunhap.idmau=mau.idmau
    WHERE idphieunhap = $recordID";
    $result = $dp->excuteQuery($sql);
    $detailRecord = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($detailRecord, $row);
        }
    }
    return $detailRecord;
}
?>