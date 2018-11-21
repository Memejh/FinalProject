<?php
session_start();
include '../function/head.php';
$html = new htmlDefault();
include '../function/navbar.php';
$navbar = new navbar();
include '../function/style.php';
include '../function/conn.php';
include '../style.php';
?>
<html>

    <head>
        <?php
        head('Local Restaurant Management System');
        headcss();
        menucss();
        js();
        ?> 

    </head>
    <body>  
        <?php $seesion = $_SESSION["Status"]; ?>
        <?php $navbar->navbarOpen($seesion) ?>
        <?php div('container menuXX'); ?> 

        <div class="col-sm-12 " style="margin-top:60px">
            <h2> กราฟเปรียบรายรับ - รายจ่าย </h2>
            <hr>
            <!-- BAR CHART -->
            <div class="box box-success">
                <div class="box-body chart-responsive">
                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </body>
</html>


        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../js/morris/morris.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="../js/jQuery-2.1.3.min.js"></script>
<!--        <script src="../js/bootstrap.min.js" type="text/javascript"></script>-->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../js/morris/morris.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                "use strict";
                //BAR CHART
                var bar = new Morris.Bar({
                    element: 'bar-chart',
                    resize: true,
                    data: [
<?php
include '../function/conn.php';

$sql = "SELECT SUM(total_price) as 'total_price',SUM(e_price) as 'e_price',order_date,e_date "
        . " from orders INNER JOIN expenditure"
        . " on orders.order_date = expenditure.e_date"
        . " GROUP BY order_date DESC ";
$query = mysqli_query($conn, $sql);

while ($result = mysqli_fetch_array($query)) {
    $day = $result["order_date"];
    $day2 = $result["e_date"];
    $total_r = $result["total_price"];
    $total_j = $result["e_price"];
    echo '{d: "' . $day . '", a: ' . $total_r . ' , b:  ' . $total_j . '},';
}
?>
                    ],
                    barColors: ['#00a65a', '#f56954'],
                    xkey: 'd',
                    ykeys: ['a', 'b'],
                    labels: ['รายรับ', 'รายจ่าย'],
                    hideHover: 'auto'
                });
            }
            );
        </script>