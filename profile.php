<?php
include 'includes/header.php';
?>
<?php
$check_login = Session::get('custumer_longin');
if ($check_login == false) {
    echo "<script>window.location='login.php'</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = Session::get("custumer_id");
    $updatecustumers = $cs->update_custumer($_POST, $id);
}
?>
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<div class="container">
    <div class="row">
        <div class="col-md-3 mt-3">
            <div class="text-center" style="margin-top:50px;">
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                <h3>Thông tin về bạn</h3>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <?php
                if (isset($updatecustumers)) {
                    echo $updatecustumers;
                }
                ?>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <?php
                    $id = Session::get("custumer_id");
                    $get_custumers = $cs->show_custumers($id);
                    if ($get_custumers) {
                        while ($result = $get_custumers->fetch_assoc()) {
                            ?>
                            <form class="form" action="profile.php" method="POST">
                                <table>
                                    <tbody>
                                        <tr class="row">
                                            <td class="col-xs-6" style="padding: 10px;">
                                                <label for="">
                                                    <h4>Name</h4>
                                                </label>
                                                <input type="text" class="form-control" name="name" value="<?php echo $result['name'] ?>">
                                            </td>
                                            <td class="col-xs-6" style="padding: 10px;" >
                                                <label for="">
                                                    <h4>City</h4>
                                                </label>
                                                <input type="text" class="form-control" name="city" value="<?php echo $result['city'] ?>">
                                            </td>
                                        </tr>

                                        <tr class="row">
                                            <td class="col-xs-6" style="padding: 10px;">
                                                <label for="">
                                                    <h4>Zipcode</h4>
                                                </label>
                                                <input type="text" class="form-control" name="zipcode" value="<?php echo $result['zipcode'] ?>">
                                            </td>
                                            <td class="col-xs-6" style="padding: 10px;">
                                                <label for="">
                                                    <h4>Email</h4>
                                                </label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $result['email'] ?>">
                                            </td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-xs-6" style="padding: 10px;">
                                                <label for="">
                                                    <h4>Address</h4>
                                                </label>
                                                <input type="text" class="form-control" name="address" value="<?php echo $result['address'] ?>">
                                            </td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-xs-6" style="padding: 10px;">
                                                <label for="">
                                                    <h4>Phone</h4>
                                                </label>
                                                <input type="text" class="form-control" name="phone" value="<?php echo $result['phone'] ?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <span class="col-md-4"></span>
                                    <span class="col-md-3">
                                    <input class="btn btn-lg btn-success pull-right" style="padding: 10px 70px 10px 70px; margin:20px;" type="submit" name="submit" value="Save">
                                    </span>
                                    
                                    <div class="col-md-5"></div>
                                   
                                </div>
                                <br>
                </div>
                </form>
        <?php
            }
        }
        ?>
            </div>

        </div>
        <!--/tab-pane-->


    </div>
    <div class="col-md-3"></div>
</div>
<br>
</div>
<?php
include 'includes/footer.php';
?>