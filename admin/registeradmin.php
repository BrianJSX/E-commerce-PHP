<?php
  include './includes/headerlogin.php';
  include './controller/adminregister.php';
?>
<?php
   $class = new adminregister();
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $adminName = $_POST['adminName'];
      $adminUser = $_POST['adminUser'];
      $adminEmail = $_POST['adminEmail'];
      $adminPass = md5($_POST['adminPass']);
      $adminRepass = md5($_POST['adminRepass']);
      $register_check = $class->register_admin($adminName,$adminUser,$adminEmail,$adminPass, $adminRepass);
      
  }
?>
<div class="container tm-mt-big tm-mb-big">
  <div class="row">
    <div class="col-12 mx-auto tm-login-col">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="tm-block-title mb-4">Register admin</h2>
          </div>
          <div class="row mx-auto">
            <?php 
            if(isset($register_check)) {
               echo $register_check;
            }
             ?>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12">
            <form action="registeradmin.php" method="post" >
              <div class="form-group">
                <label for="username">Name</label>
                <input type="text" class="form-control validate" name="adminName" />
              </div>
              <div class="form-group">
                <label for="username">User</label>
                <input type="text" class="form-control validate" name="adminUser" />
              </div>
              <div class="form-group">
                <label for="username">Email</label>
                <input type="email" class="form-control validate" name="adminEmail" />
              </div>
              <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control validate" name="adminPass" />
              </div>
              <div class="form-group mt-3">
                <label for="password">Repassword</label>
                <input type="password" class="form-control validate" name="adminRepass" />
              </div>
              <div class="form-group mt-4">
                <input type="submit" class="btn btn-primary btn-block text-uppercase" value="Register"/>
              </div>
              <a href="login.php" class="mt-5 btn btn-primary btn-block text-uppercase">
                click back to Login Admin
               </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include './includes/footer.php';
?>