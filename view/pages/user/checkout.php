
<?php
require("../../../util/dataProvider.php");
$dp = new DataProvider();
session_start();
$sql="select * from nguoidung where idnguoidung=".$_SESSION["userID"];
$info=$dp->excuteQuery($sql)->fetch_assoc();
?> 
<div id="mycart">
    <!-- Header Section Starts -->
    <!-- Header Section Ends -->  


    <!-- Checkout Section Starts -->
    <div class="container py-5" id="checkout-section">
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>Your cart</span>
                <span class="badge bg-warning rounded-pill">0</span>
              </h4>
              <ul class="list-group mb-3 ">
             <?php $sql = "
    SELECT sanpham.*, mau.*, chitietphieunhap.*, giohang.soluong AS soluong_giohang
    FROM sanpham
    JOIN giohang ON sanpham.idsanpham = giohang.idsanpham 
                AND sanpham.idmau = giohang.idmau
    JOIN mau ON sanpham.idmau = mau.idmau
    JOIN chitietphieunhap ON chitietphieunhap.idsanpham = sanpham.idsanpham 
                         AND chitietphieunhap.idmau = sanpham.idmau 
    WHERE chitietphieunhap.Gia > 0 and chitietphieunhap.soluong > 0 
      AND giohang.idnguoidung = ".$_SESSION['userID']."
    GROUP BY sanpham.idsanpham, sanpham.idmau
   ";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          ?>
          <script>
            summary()
          </script>
                <li class="list-group-item d-flex justify-content-between lh-sm product-placeholder">
                  <div>
                    <h6 class="my-0 productID" data-value="<?=$row['idsanpham']?>"><?=$row['tensanpham']?></h6> 
                    <h6 class="my-0 colorID" data-value="<?=$row['idmau']?>"><?=$row['tenMau']?></h6>
                    <small class="text-success fw-bold eachPrice"><?=$row['Gia']*1.45?> đ</small>
                    x<strong class="quanity-info" id="quanity-info" value="<?=$row['soluong_giohang']?>"><?=$row['soluong_giohang']?></strong>
                  </div>
                  <span class="text-success fw-bold total"><?=$row['soluong_giohang']*$row['Gia']*1.45?> đ</span>
                </li>
        <?php }}?>
                <li class="list-group-item d-flex justify-content-between">
                  <strong>Total (Đ)</strong>
                  <strong class="total-final"></strong>
                </li>
              </ul>
              <ul class="nav d-flex justify-content-between">
                <li class="nav-item"><a href="javascript:void(0)" onclick="ShowCart()" class="nav-link px-0">Change your cart</a></li>
                <li class="nav-item"><a href="javascript:void(0)" onclick="ShowShopping()" class="nav-link px-0">Continue to shopping</a></li>
              </ul>
            </div>
            <div class="col-md-7 col-lg-8">
              <h4 class="mb-3">Billing address</h4>
              <form class="needs-validation" novalidate="">
                <div class="row g-3">
                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="checkout-address" placeholder="1234 Main St" required value="<?=$info['diachi']?>">
                    <div class="invalid-feedback">
                      Please enter your shipping address.
                    </div>
                  </div>
                </div>
      
                <hr class="my-4">
      
                <button class="w-100 btn btn-warning btn-lg" type="button" onclick="order()">Proceed to checkout</button>
              </form>
            </div>
          </div>
    </div>
    <!-- Checkout Section Ends -->
</div>
