<?php
   session_start();
   require("../../../util/dataProvider.php");
    $dp=new DataProvider();
    $id=$_GET['id'];
    $sql='select * from sanpham 
    join phong on sanpham.idphong=phong.idphong 
    join loai on sanpham.idloai=loai.idloai
    join mau on sanpham.idmau=mau.idmau
    where idsanpham='.$id." and trangthai=1";
    $result=$dp->excuteQuery($sql);
    $info=$result-> fetch_assoc();
?>
<div>
    <!-- Header Section Starts -->

    <!-- Header Section Ends -->  


    <!-- Product Detail Section Starts -->
    <div class="container p-3" id="product-detail-section">
      <div class="row g-5 justify-content-between">
        <div class="col-md-6 col-lg-4 d-flex justify-content-center">
          <img src="./data/img/<?=$info['idsanpham']?>/<?=$info['hinh']?>" id="productimg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" loading="lazy" style="max-width: 300px;">
        </div>
        <div class="col-md-6 col-lg-3">
          <h4 class="product-name"><?=$info['tensanpham']?></h4>
          <div class="informations">
            <h4 class="text-success fw-bold"><?=$info['gia']?> đ</h4>
            <p><strong>Type: </strong><?=$info['tenloai']?></p>
            <p><strong>Room: </strong><?=$info['tenphong']?></p>
            <strong>Colors: </strong>
            <div class="colors mt-2">
              <ul class="list-unstyled list-inline">
             
              <li class="list-inline-item">  
              <div class="button">
                
                    <input type="radio" name="color" id="<?=$info['idmau']?>" value="<?=$info['idmau']?>" class="d-none color" checked onclick="loadimg(<?=$id?>,'<?=$info['hinh']?>')">
                    
                    <label for="<?=$info['idmau']?>"><?=$info['tenMau']?></label>
                </div></li>
                <?php  if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {

          echo '<li class="list-inline-item"><div class="button"><input type="radio" name="color" id="'.$row['idmau'].'" value="'.$row['idmau'].'" class="d-none color" onclick="loadimg('.$id.",'".$row['hinh']."'".');"><label for="'.$row['idmau'].'">'.$row['tenMau'].'</label></div></li>';
        }
      }?>
              </ul>
            </div> 
          </div>
          <div class="d-flex gap-1 justify-content-md-start mt-3">
            <button type="button" class="add-to-cart-btn btn btn-warning" onclick="addToCart(<?=$info['idsanpham']?>,getcurrentColor())">Add to cart</button>
            <!---->
          </div>
        </div>
        <div class="col-lg-5">
          <h5 class="pb-3 border-bottom">Product Description</h5>
          <p class="product-description"><?=$info['mota']?></p>
        </div>
      </div>
    </div>
    <!-- Product Detail Section Ends -->
    <!--Related products-->
    <div class="container pt-5" id="popular-products-section">
      <h2 class="py-3 border-bottom">Related products</h2>
      <div class="row g-3 justify-content-start pt-3 product-cards">
      <?php    
      $sql="SELECT min(idmau),idsanpham,gia,tensanpham from sanpham where trangthai=1 and idsanpham!=".$info['idsanpham']." and idloai=".$info['idloai']." group by idsanpham,gia,tensanpham limit 6";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $sql2="SELECT hinh,idmau from sanpham where idsanpham=".$row['idsanpham']." and idmau=".$row['min(idmau)'];
              $result2=$dp-> excuteQuery($sql2);
              if ($result2-> num_rows > 0){
                 $image=$result2-> fetch_assoc();
                }
      ?>
      
        <div class="col-4 col-md-3 col-lg-2">        
          <div class="product-card card text-black">
            <a href="javascript:void(0)" onclick="ShowThongTin(<?=$row['idsanpham']?>)" class="link-body-emphasis text-decoration-none">
              <img
              src="./data/img/<?=$row['idsanpham']?>/<?=$image['hinh']?>"
              class="product-img card-img-top img-fluid "
              alt=""
              />
            </a>
            <div class="card-body p-2">
              <div class="text-center text-break">
                  <h6 class="card-title"><a class="product-name" href="product-detail.php"><?=$row['tensanpham']?></a></h6>
              </div>
              <div class="d-flex justify-content-center">
                <strong class="text-success product-price"><?=$row['gia']?> đ</strong>
              </div>
              <div class="d-flex justify-content-between font-weight-bold mt-3">
                <button class="w-100 btn btn-warning add-to-cart-btn" onclick="addToCart(<?=$row['idsanpham']?>,<?=$row['min(idmau)']?>)">Add to cart</button>
              </div>
            </div>
          </div>
        </div>
        <?php }
      }?>
        </div>
      </div>

    </div>

    <!--Frequently bought together-->
    <div class="container pt-5" id="popular-products-section">
      <h2 class="py-3 border-bottom">Frequently bought together</h2>
      <div class="row g-3 justify-content-start pt-3 product-cards">
      <?php    
      $sql="SELECT min(idmau),idsanpham,gia,tensanpham from sanpham where trangthai=1 and idsanpham!=".$info['idsanpham']." and idphong=".$info['idphong']." group by idsanpham,gia,tensanpham limit 6";
      $result=$dp-> excuteQuery($sql);
      if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $sql2="SELECT hinh,idmau from sanpham where idsanpham=".$row['idsanpham']." and idmau=".$row['min(idmau)'];
              $result2=$dp-> excuteQuery($sql2);
              if ($result2-> num_rows > 0){
                 $image=$result2-> fetch_assoc();
                }
      ?>
      
        <div class="col-4 col-md-3 col-lg-2">        
          <div class="product-card card text-black">
            <a href="javascript:void(0)" onclick="ShowThongTin(<?=$row['idsanpham']?>)" class="link-body-emphasis text-decoration-none">
              <img
              src="./data/img/<?=$row['idsanpham']?>/<?=$image['hinh']?>"
              class="product-img card-img-top img-fluid "
              alt=""
              />
            </a>
            <div class="card-body p-2">
              <div class="text-center text-break">
                  <h6 class="card-title"><a class="product-name" href="product-detail.php"><?=$row['tensanpham']?></a></h6>
              </div>
              <div class="d-flex justify-content-center">
                <strong class="text-success product-price"><?=$row['gia']?> đ</strong>
              </div>
              <div class="d-flex justify-content-between font-weight-bold mt-3">
                <button class="w-100 btn btn-warning add-to-cart-btn" onclick="addToCart(<?=$row['idsanpham']?>,<?=$row['min(idmau)']?>)">Add to cart</button>
              </div>
            </div>
          </div>
        </div>
        <?php }
      }?>
        </div>
      </div>

    </div>
</div>
<script>
  function loadimg(id,name){
    document.getElementById("productimg").src="./data/img/"+id+"/"+name;
  };
  function getcurrentColor(){
   let checkboxs=document.getElementsByClassName("color");
   for(let i=0;i<checkboxs.length;i++){
    if(checkboxs[i].checked==true){
      console.log(checkboxs[i].value);
     return checkboxs[i].value;
    }
   }
  };
</script>
