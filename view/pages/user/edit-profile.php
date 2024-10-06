<?php
   session_start();
   require("../../../util/dataProvider.php");
  $dp=new DataProvider();
  $sql="select * from nguoidung where idnguoidung=".$_SESSION['userID'];
  $info=$dp->excuteQuery($sql)->fetch_assoc();
?>
<div>
    <!-- Header Section Starts -->
    <!-- Header Section Ends -->  


    <!-- Profile Section Starts -->
    <div class="container">
        <div class="row g-5" id="myaccount">
            <div class="col-8 mx-auto">
              <h4 class="mb-3">Profile</h4>
              <form class="needs-validation" novalidate="">
                <div class="row g-3">
                  <div class="col-12">
                    <label for="firstName" class="form-label">Fullname</label>
                    <input type="text" class="form-control" id="txtHoTen" placeholder="Enter your fullname" value="<?=$info['hoten']?>" required="">
                    <div class="invalid-feedback">
                      Valid name is required.
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="phonenumber" class="form-label">Phone number </label>
                    <input type="text" class="form-control" id="txtSDT" placeholder="0123456789"  value="<?=$info['sdt']?>">
                    <div class="invalid-feedback">
                      Please enter a valid phone number for contact about shipping status.
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" class="form-control" id="txtEmail" placeholder="example@email.com" value="<?=$info['email']?>">
                  </div>
      
                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="txtAddress" placeholder="1234 Main St" value="<?=$info['diachi']?>">
                  </div>
                </div>
                <hr class="my-4">
      
                <button class="w-100 btn btn-primary btn-md" type="button" onclick="updateUser()">Save changes</button>
              </form>
            </div>
          </div>
    </div>
    <!-- Profile Section Ends -->
</div>
