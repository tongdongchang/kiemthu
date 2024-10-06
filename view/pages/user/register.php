
<div>
    <!-- Header Section Ends -->  


    <!-- Register Section Starts -->
    <div class="container py-5 text-center border-bottom" style="max-width: 500px;">
        <main class="form-login">
            <form>
              <img class="mb-3" src="./view/assets/img/logo.png" alt="" width="auto" height="60px">
              <h2 class="mb-3 fw-normal">Create your new account</h2>
          
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                <label for="floatingInput">Name</label>
              </div>
              <div class="form-floating mb-2">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                <label for="floatingInput">Email</label>
              </div>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone number">
                <label for="floatingInput">Phone number</label>
              </div>
              <div class="form-floating mb-2">
                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                <label for="floatingInput">Address</label>
              </div>
              <div class="form-floating mb-2">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                <label for="floatingPassword">Confirm password</label>
              </div>
          
              <div class="d-flex align-items-center justify-content-center pb-4 mt-4">
                <p class="mb-0 me-2">Already have an account?</p>
                <a class="login-btn btn btn-outline-primary" onclick="ShowLogin()" role="button">Login here</a>
              </div>

              <button class="w-100 btn btn-lg btn-warning" type="button" onclick="register()">Register</button>
            </form>
          </main>
    </div>
    <!-- Register Section Ends -->


</div>
