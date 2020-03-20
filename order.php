<?php
  include 'includes/header.php';
  ?>
   <?php
					$check_login = Session::get('custumer_longin');
            if($check_login == false){
              echo "<script>window.location='login.php'</script>";
            }
              
	?>
 <div class="container">
     <div class="row">
        <h1>Page order</h1>
     </div>
 </div>
 <!-- Bootstrap core JavaScript-->
 <?php
  include 'includes/footer.php';
  ?>