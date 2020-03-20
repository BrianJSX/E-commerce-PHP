<?php
include './includes/header.php';
include_once './/controller/custummer.php';
    $cs = new custumer();
    if (!isset($_GET['custumerid']) || $_GET['custumerid']== NULL ) {
        echo "<script>window.location='orderpending.php'</script>";
    }else {
        $id = $_GET['custumerid'];
    }

?>
<div class="container">
    <!-- row -->
    <div class="col-12 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
            <h2 class="tm-block-title">Orders DETAIL</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col">CITY</th>
                        <th scope="col">COUNTRY</th>
                        <th scope="col">ZIPCODE</th>
                        <th scope="col">PHONE</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_cutumer = $cs->show_custumers($id);
                    if ($show_cutumer){
                        while ($result = $show_cutumer->fetch_assoc()) {
                    ?>
                    <tr>
                        <th scope="row"><b><?php echo $result['id']?></b></th>
                        <td><?php echo $result['name']?></td>
                        <td><?php echo $result['email']?></td>
                        <td><b><?php echo $result['address']?></b></td>
                        <td><?php echo $result['city']?></td>
                        <td><?php echo $result['country']?></td>
                        <td><?php echo $result['zipcode']?></td>
                        <td><?php echo $result['phone']?></td>
                        
                    </tr>
                    <?php
                    }
                }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<footer class="tm-footer row tm-mt-small">
    <div class="col-12 font-weight-light">
        <p class="text-center text-white mb-0 px-4 small">
            Copyright &copy; <b>2018</b> All rights reserved.

            Design: <a rel="nofollow noopener" href="https://templatemo.com" class="tm-footer-link">Template Mo</a>
        </p>
    </div>
</footer>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<!-- https://jquery.com/download/ -->
<script src="js/moment.min.js"></script>
<!-- https://momentjs.com/ -->
<script src="js/Chart.min.js"></script>
<!-- http://www.chartjs.org/docs/latest/ -->
<script src="js/bootstrap.min.js"></script>
<!-- https://getbootstrap.com/ -->
<script src="js/tooplate-scripts.js"></script>
<script>
    Chart.defaults.global.defaultFontColor = 'white';
    let ctxLine,
        ctxBar,
        ctxPie,
        optionsLine,
        optionsBar,
        optionsPie,
        configLine,
        configBar,
        configPie,
        lineChart;
    barChart, pieChart;
    // DOM is ready
    $(function() {
        drawLineChart(); // Line Chart
        drawBarChart(); // Bar Chart
        drawPieChart(); // Pie Chart

        $(window).resize(function() {
            updateLineChart();
            updateBarChart();
        });
    })
</script>
</body>

</html>