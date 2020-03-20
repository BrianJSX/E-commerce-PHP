<?php
include './includes/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col">
            <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
        </div>
    </div>
    <!-- row -->
    <div class="col-12 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
            <h2 class="tm-block-title">Orders DETAIL</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ORDER ID.</th>
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">CUSTUMER NAME</th>
                        <th scope="col">ADDRESS</th>
                        <th scope="col">PHONE</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row"><b>#122349</b></th>
                        <td><b>LAPTOP DELLXPS50</b></td>
                        <td><b>3</b></td>
                        <td>Minh Hồ</td>
                        <td>TPHCM</td>
                        <td>03443873271</td>
                        <td>Minhho.technology@gmail.com</td>
                        <td>
                            <div class="tm-status-circle moving">
                            </div>Moving
                        </td>
                    </tr>
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