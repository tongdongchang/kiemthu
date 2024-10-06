
<nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid gap-5 p-0 d-flex align-items-center ">
            <a href="index.php" class="link-body-emphasis text-decoration-none">
              <img src="./view/assets/img/logo.png" alt="" width="100px">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
              <ul class="nav nav-pills gap-2 navigation-links">
                <li class="nav-item"><a href="index.php" aria-current="page" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="javascript:void(0)" onclick="ShowShopping()" class="nav-link">Shopping</a></li>
                <li class="nav-item"><a href="javascript:void(0)" class="nav-link" onclick="ShowProfile()">Profile</a></li>
                <li class="nav-item"><a href="javascript:void(0)" class="nav-link" onclick="ShowMyOrder()">My Order</a></li>
              </ul>
              <ul class="nav nav-pills navigation-icons">
                <li class="nav-item"><a href="javascript:void(0)" onclick="ShowCart()"  class="nav-link">
                    <i class="bi bi-bag" style="font-size: 16px;"></i>
                </a></li>
                <?php  if (isset($_SESSION['userID'])) :?>
        <li class="nav-item"><a href="javascript:void(0)" onclick="logout()" class="nav-link">
          <i class="bi bi-box-arrow-in-right" style="font-size: 16px;"></i>
      </a></li>
                <?php else :?>
                <li class="nav-item"><a href="javascript:void(0)" onclick="ShowLogin()" class="nav-link">
                    <i class="bi bi-person" style="font-size: 16px;"></i>
                </a></li>
                <?php endif?>
              </ul>
            </div>
          </div>
        </nav>