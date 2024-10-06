<?php
require("../../../util/dataProvider.php");
$dp = new DataProvider();
session_start();

?> 
<div>
    <!-- Header Section Starts -->

    <!-- Header Section Ends -->  


    <!-- Cart Section Starts -->
    <div class="container border-bottom py-5" id="cart-section">
        <div class="row g-5">
            <div class="col-md-4 col-lg-3 order-md-last">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span>Summary</span>
                <span class="badge bg-warning rounded-pill">3</span>
              </h4>
              <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                  <strong>Total (USD)</strong>
                  <strong class="total-final"></strong>
                </li>
              </ul>
              <a href="javascript:void(0)" onclick="ShowCheckOut()" class="w-100 btn btn-warning btn-md" role="button">Proceed to checkout</a>
            </div>
            <div class="col-md-8 col-lg-9">
              <h4 class="mb-3">Your cart</h4>
              <?php    
     $sql = "
     SELECT sanpham.*, mau.*, chitietphieunhap.*, giohang.soluong AS soluong_giohang
     FROM sanpham
     JOIN giohang ON sanpham.idsanpham = giohang.idsanpham AND sanpham.idmau = giohang.idmau
     JOIN mau ON sanpham.idmau = mau.idmau
     JOIN chitietphieunhap ON chitietphieunhap.idsanpham = sanpham.idsanpham AND chitietphieunhap.idmau = sanpham.idmau
     WHERE giohang.idnguoidung = ".$_SESSION['userID'];
 
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          ?>
                <div class="row mb-4 d-flex flex-wrap align-items-center product-placeholder" onload="changeQuantity(<?=$row['idsanpham'] ?>,<?=$row['idmau']?>,0,this)">
                <script>
            summary();
            </script>
                <hr class="my-4">
                <div class="col-2">
                    <a href="javascript:void(0)" onclick="ShowThongTin(<?=$row['idsanpham']?>)">
                      <img
                    src="./data/img/<?=$row['idsanpham']?>/<?=$row['hinh']?>"
                    class="img-fluid rounded-3" alt="Cotton T-shirt" style="overflow: hidden; width: 100px;">
                    </a>
                </div>
                <div class="col-3 text-break">
                    <h6 class="text-muted"><a href="javascript:void(0)" class="text-decoration-none text-black nav-link px-0" onclick="ShowThongTin(<?=$row['idsanpham']?> )"><?=$row['tensanpham']?></a></h6>
                    <h6 class="text-muted"><?=$row['tenMau']?></h6>
                    <h6 class="text-black mb-0 eachPrice"><?=$row['Gia']?> đ</h6>
                </div>
                <div class="col-3 d-flex ">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                    onclick="changeQuantity(<?=$row['idsanpham'] ?>,<?=$row['idmau']?>,-1,this);summary()">
                    <i class="bi bi-dash"></i>
                    </button>

                    <input id="quanity-info" min="0" name="quantity-info" value="<?=$row['soluong_giohang']?>" type="number"
                    class="form-control quantity-info" min="1" style="width: 52px;"
                   
                    onchange="changeQuantity(<?=$row['idsanpham'] ?>,<?=$row['idmau']?>,0,this);summary()"/>

                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2"
                    onclick="changeQuantity(<?=$row['idsanpham'] ?>,<?=$row['idmau']?>,1,this);summary()">
                    <i class="bi bi-plus"></i>
                    </button>
                </div>
                <div class="col-3 product-total">
                    <h6 class="mb-0 total"><?=$row['Gia']*$row['soluong_giohang']*1.45?> đ</h6>
                </div>
                <div class="col-1 text-end">
                    <a href="javascript:void(0)" class="text-muted" onclick="deleteFromCart(<?=$row['idsanpham']?>,<?=$row['idmau']?>,this)"><i class="bi bi-x-lg"></i></a>
                </div>
                </div>
        <?php }
      }?>

          </div>
          </div>
    </div>
    <!-- Cart Section Ends -->
</div>
