<?php
session_start();
//session_destroy();
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
        <?php
        $sql = "select * from orders group by order_date DESC";
        $query = mysqli_query($conn, $sql);
        {
            ?>
            <div class="col-sm-12 " style="margin-top:60px">
                <div class="col-sm-1"></div>
                <div class="col-sm-4"><h2> รายรับ </h2>
                </div>
            </div>
            <div class="col-sm-2"></div>
            <div class="col-sm-3">
                <table class="table table-condensed">
                    <form action="" method="post" > 
                        <tbody>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">เลือกวันที่
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <?php
                            }
                            while ($result = mysqli_fetch_assoc($query)) { {
                                    ?>

                                    <li><input class="btn btn-default" type="submit" name="date" value="<?php echo $result["order_date"]; ?>"></li>

                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    </tbody>
                </form>
            </table>
        </div>
        <div class="col-sm-5">

            <?php
            if (isset($_POST["date"])) {

                $sql = "select * from ((orders inner join order_details on orders.order_id = order_details.order_id)"
                        . "inner join menu on order_details.menu_id = menu.id_menu)"
                        . "WHERE '" . $_POST["date"] . "'";
                $query = mysqli_query($conn, $sql);
                {      echo '<h2> วันที่ '.$_POST["date"].'</h2>';
                    ?>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>เวลา</th>
                                <th>ชื่อ</th>
                                <th>จำนวน</th>
                                <th>ราคา</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php }
                            while ($result = mysqli_fetch_assoc($query)) {
                                if ($_POST["date"] == $result["order_date"]) {
                                    $result["qty_menu"];
                                    ?>
                                    <tr> 
                                        <td><?php echo $result["order_time"]; ?></td> 
                                        <td><?php echo $result["name_menu"]; ?></td> 
                                        <td><?php echo $result["qty_menu"]; ?></td> 
                                        <td><?php echo $result["total_price_menu"]; ?></td> 
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <?php
                            $sql2 = "select SUM(total_qty) as 'total_qty',"
                                    . "SUM(total_price) as 'total_price',order_date"
                                    . " FROM orders WHERE order_date = '" . $_POST["date"] . "'";
                            $query2 = mysqli_query($conn, $sql2);

                            while ($result = mysqli_fetch_assoc($query2)) {
                                if ($_POST["date"] == $result["order_date"]) {
                                    $result["total_qty"];
                                    ?>
                                    <tr> 
                                        <td></td> 
                                        <th>รวมทั้งหมด</th> 
                                        <th><?php echo $result["total_qty"]; ?></th> 
                                        <th><?php echo $result["total_price"]; ?></th> 
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                        </tfoot>
    <?php } ?>
                </table>
            </div>
            <!-- /container -->
            <script src="bootstrap/js/bootstrap.min.js"></script>      
    <?php _div(); ?>
    </body>
</html>
