<?php
include './includes/header.php';
include './controller/adminAccount.php';
?>

<?php
$check_guest = Session::get('adminLevel');
if ($check_guest == 1 || $check_guest == 2) {
    echo "<script>window.location='index.php'</script>";
}elseif ($check_guest == 4) {
  echo "<script>window.location='guest.php'</script>";
}
$class = new adminAccount();
$check_level = Session::get('adminLevel');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $adminName = $_POST['adminName'];
  $adminUser = $_POST['adminUser'];
  $adminEmail = $_POST['adminEmail'];
  $adminPass = md5($_POST['adminPass']);
  $adminRepass = md5($_POST['adminRepass']);
  $addnewprof_check = $class->addnewprof($adminName, $adminUser, $adminEmail, $adminPass, $adminRepass);
}
if (isset($_GET['delId'])) {
  $id = $_GET['delId'];
  $delaccount = $class->del_account($id);
}
?>
<?php 
  if ($checkadmin != 0) {
    echo "<script>window.location='login.php'</script>";
  }
?>
<div clas="container">
  <div class="row">
    <div class="col-md-7">
      <div>
        <h2 class="tm-block-title">Account admin</h2>
      </div>
      <table class="table tm-table-small">
        <tbody>
          <tr style="color:black;">
            <th>ID .No</th>
            <th>Admin Name</th>
            <th>Admin User</th>
            <th>Email</th>
            <th class="text-center">Action</th>
          </tr>
          <?php
          $showaccount = $class->showaccount();
            if ($showaccount == true) {
              $i = 0;
              while ($result = $showaccount->fetch_assoc()) {
                $i++;
          ?>
                <tr>
                  <td class="tm-product-name"><?php echo $i ?></td>
                  <td class="tm-product-name"><?php echo $result['adminName'] ?></td>
                  <td class="tm-product-name"><?php echo $result['adminUser'] ?></td>
                  <td class="tm-product-name"><?php echo $result['adminEmail'] ?></td>
                  <td class="tm-product-name">
                    <?php if ($result['level'] == 0) {
                      echo "Admin";
                      }else if($result['level'] == 1) {
                        echo "Censor Oder";
                      }else if($result['level'] == 2) {
                        echo "Censor Product";
                      }else if($result['level'] == 4) {
                        echo "Guest";
                      }
                      ?>
                  </td>
                  
                  <td class="text-center">
                    <a href="accountsedit.php?ProfileId=<?php echo $result['adminId'] ?>" class="tm-product-delete-link">
                      <i class="far fas fa-pen-square tm-product-delete-icon"></i>
                    </a> 
                    <?php
                      if ($result['level'] != 0 ) {
                  ?>
                    <a onclick="return confirm('Bạn có muốn xóa không??')" href="?delId=<?php echo $result['adminId'] ?>" class="tm-product-delete-link">
                      <i class="far fa-trash-alt tm-product-delete-icon"></i>
                    </a>
                  </td>
                   <?php }?>

                </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
    </div>



    <div class="col-md-5 mt-5 ">
      <div class="tm-bg-primary-dark tm-block tm-block-settings">
        <div class="row">
          <h2 class="tm-block-title">Add New Admin</h2>
        </div>
        <div class="row">
          <?php
          if (isset($addnewprof_check)) {
            echo $addnewprof_check;
          }
          unset($addnewprof_check);
          ?>

        </div>
        <form action="accountsList.php" class="tm-signup-form row" method="POST">
          <div class="form-group col-lg-6">
            <label for="name">Account Name</label>
            <input id="name" name="adminName" type="text" class="form-control validate" />
          </div>
          <div class="form-group col-lg-6">
            <label for="name">Account User</label>
            <input id="name" name="adminUser" type="text" class="form-control validate" />
          </div>
          <div class="form-group col-lg-6">
            <label for="email">Account Email</label>
            <input id="email" name="adminEmail" type="email" class="form-control validate" />
          </div>
          <div class="form-group col-lg-6">
            <label for="password">Password</label>
            <input id="password" name="adminPass" type="password" class="form-control validate" />
          </div>
          <div class="form-group col-lg-6">
            <label for="password2">Re-enter Password</label>
            <input id="password2" name="adminRepass" type="password" class="form-control validate" />
          </div>
          <div class="col-12">
            <input type="submit" class="btn btn-primary btn-block text-uppercase" value="Add New ADMIN">
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- row -->



  <?php
  include './includes/footer.php';
  ?>