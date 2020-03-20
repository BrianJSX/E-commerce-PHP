<?php
  include './includes/headerlogin.php';
  include './controller/adminlogin.php';
?>
<?php
   $class = new adminlogin();
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $adminUser = $_POST['adminUser'];
      $adminPass = md5($_POST['adminPass']);
      $login_check = $class->login_admin($adminUser, $adminPass);
  }
?>
<div class="container tm-mt-big tm-mb-big">
  <div class="row">
    <div class="col-12 mx-auto tm-login-col">
      <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="tm-block-title mb-4">Welcome to Dashboard, Login</h2>
          </div>
          <div class="row mx-auto">
            <?php if(isset($login_check)) {
               echo "<p class='alert alert-danger'>. $login_check .</p>";
            } ?>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-12">
            <form action="login.php" method="post" >
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control validate" name="adminUser" />
              </div>
              <div class="form-group mt-3">
                <label for="password">Password</label>
                <input type="password" class="form-control validate" name="adminPass" />
              </div>
              <div class="form-group mt-4">
                <input type="submit" class="btn btn-primary btn-block text-uppercase" value="Login"/>
              </div>
              <a href="registeradmin.php" class="mt-5 btn btn-primary btn-block text-uppercase">
                Register Admin
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