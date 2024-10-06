
<div>
    <!-- Header Section Starts -->
    <!-- Header Section Ends -->  


    <!-- Login Section Starts -->
    <div class="container py-5 text-center border-bottom" style="max-width: 500px;">
        <main>
            <form class="login-form">
              <img class="mb-3" src="./view/assets/img/logo.png" alt="" width="auto" height="60px">
              <h2 class="mb-3 fw-normal">Please login</h2>
          
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>

              <div class="d-flex align-items-center justify-content-center py-4">
                <p class="mb-0 me-2">Don't have an account?</p>
                <a class="create-new-btn btn btn-outline-primary" onclick="ShowRegister()" role="button">Create new</a>
              </div>
              <button class="w-100 btn btn-lg btn-warning" type="button" onclick="login()">Login</button>
            </form>
          </main>
    </div>
    
    <!-- Login Section Ends -->
</div>
</html>
