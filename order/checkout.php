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

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
        date_default_timezone_set('Asia/Bangkok');
        $date = date("Y-m-d");
        $time = date("H:i:sa");
// บันทึกข้อมูลลงตาราง tbl_order
        if (isset($_POST['save_order'])) {
            $total_qty = count($_SESSION['qty_menu'], 1) - count($_SESSION['qty_menu']);
            $total_price = array_sum($_SESSION['total_price']);
            $q = "
        INSERT INTO orders (  
           order_id,  
           order_time,
           order_date,  
           total_qty,  
           total_price 
        ) VALUES (  
            NULL,
            '" . $time . "',
           '" . $date . "',  
           '" . $total_qty . "',  
           '" . $total_price . "' 
        )  
    ";
            $query = mysqli_query($conn, $q);
            if ($query) {
                $sql2 = "SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1";
                $querys2 = mysqli_query($conn, $sql2);
                while ($result = mysqli_fetch_assoc($querys2)) {
                    if (count($_SESSION['id_menu']) > 0) {
                        foreach ($_SESSION['id_menu'] as $k_pro_id => $v_pro_id) {
                            $qty_menu = array_sum($_SESSION['qty_menu'][$k_pro_id]);
                            $q2 = " INSERT INTO order_details (  
                    orderd_id,
                    order_id,  
                    menu_id,  
                    qty_menu,  
                    price_menu,  
                    total_price_menu  
                ) VALUES (  
                    NULL,
                   '" . $result["order_id"] . "',  
                   '" . $k_pro_id . "',  
                   '" . $qty_menu . "', 
                   '" . $_SESSION['price_menu'][$k_pro_id] . "',
                   '" . $_SESSION['total_price'][$k_pro_id] . "' 
                )  
            ";
                            $query3 = mysqli_query($conn, $q2);

                            if ($query3) {
                                $sql3 = "SELECT * FROM admixture "
                                        . " INNER JOIN menu ON admixture.id_menu_adm = menu.id_menu"
                                        . " INNER JOIN stock ON admixture.id_stock_adm = stock.id_stock"
                                        . " INNER JOIN unit ON admixture.id_unit_adm = unit.id_unit"
                                        . " WHERE id_menu_adm = '$k_pro_id'";
                                $querys4 = mysqli_query($conn, $sql3);
                                while ($result = mysqli_fetch_assoc($querys4)) {
                                    if ($result["id_stock"] == $result["id_stock_adm"]) {
                                        $qq = $result["num_stock"] * $qty_menu * $result["value"];
                                        $all = $result["amount_stock"] - $qq;

                                        $sql4 = " UPDATE stock"
                                                . " SET amount_stock = " . $all . ""
                                                . " WHERE id_stock = " . $result["id_stock"] . "";
                                        $querys5 = mysqli_query($conn, $sql4);
                                    }
                                }
                            }


                            //  $cutmenu->cut($k_pro_id, $qty_menu);
                            //  $cutmenu->cut($id_menu, $qty_menu);
//                    if ($query3) {
//                        $sql3 = "SELECT * FROM orders "
//                                . " INNER JOIN order_details ON orders.order_id = order_details.orderd_id"
//                                . " INNER JOIN menu ON order_details.menu_id = menu.id_menu"
//                                //   . " INNER JOIN stock ON "
//                                . "ORDER BY order_id DESC LIMIT 1";
//                        $querys3 = mysqli_query($conn, $sql3);
//
//                        while ($result = mysqli_fetch_assoc($querys3)) {
//                            $menu = $result["id_menu"];
//                            $qty_menu = $result["qty_menu"];



                            $keyProID = $k_pro_id;
                            unset($_SESSION['id_menu'][$keyProID]);
                            unset($_SESSION['name_meu'][$keyProID]);
                            unset($_SESSION['qty_menu'][$keyProID]);
                            unset($_SESSION['price_menu'][$keyProID]);
                            unset($_SESSION['total_price'][$keyProID]);
                        }
                    }
                }
                if ($query) {
                    echo '<br><br><br><center><img src="../img/t.png" style="width="300" height="300""></center>';
                    echo '<center><h1 style="color:green;">บันทึกข้อมูลสำเร็จ</h1><center><br><br><br>';
                    echo '<meta http-equiv="refresh" content="2; url=../order/order.php">';
                } else {
                    echo '<br><br><br><center><img src="../img/f.png" style="width="300" height="300""></center>';
                    echo "<center><h1 style='color:red;'>Database Connect Failed : " . mysqli_connect_error() . '</h1><center><br><br><br>';
                    echo '<meta http-equiv="refresh" content="2; url=../order/order.php">';
                }
                exit;
            }
        }
        ?>
        <div class="col-sm-12 " style="margin-top:60px">
            <div class="col-sm-1"></div>
            <div class="col-sm-10"><h2>สั่งอาหาร</h2><hr></div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-9"> 

            <a href="order.php"><button class="btn btn-primary">สั่งอาหาร</button></a><br>
            <form id="myform" method="post" action="">    
                <table class="table">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อเมนูอาหาร</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (count($_SESSION['id_menu']) > 0) {
                            $i = 1;
                            foreach ($_SESSION['id_menu'] as $k_pro_id => $v_pro_id) {
                                $qty_data = array_sum($_SESSION['qty_menu'][$k_pro_id]);
                                ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $_SESSION['name_menu'][$k_pro_id] ?></td>
                                    <td><?= $_SESSION['price_menu'][$k_pro_id] ?></td>
                                    <td><?= $qty_data ?></td>
                                    <td><?= $_SESSION['total_price'][$k_pro_id] ?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        <?php
                        if (count($_SESSION['total_price']) > 0) {
                            ?>
                            <tr>
                                <td colspan="3">
                                    <input type="button" class="btn btn-default" onclick="window.location = 'cart.php'" value="Edit">
                                </td>
                        <strong> <td><?= count($_SESSION['qty_menu'], 1) - count($_SESSION['qty_menu']) ?></td>
                            <td><?= array_sum($_SESSION['total_price']) ?></td></strong>
                        </tr>
                        <tr>
                            <th></th>
                            <td colspan="4">
                                <input class="btn btn-success" type="submit" name="save_order"  value="บันทึกการสั่งซื้อ">  
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </form>

        </div>              
    </body>
</html>

<?php

function cut($k_pro_id, $qty_menu) {
    $sql3 = "SELECT * FROM admixture "
            . " INNER JOIN menu ON admixture.id_menu_adm = menu.id_menu"
            . " INNER JOIN stock ON admixture.id_stock_adm = stock.id_stock"
            . " INNER JOIN unit ON admixture.id_unit_adm = unit.id_unit"
            . " WHERE id_menu_adm = '$k_pro_id'";
    $querys2 = mysqli_query($conn, $sql3);
    while ($result = mysqli_fetch_assoc($querys2)) {
        if ($result["id_stock"] == $result["id_stock_adm"]) {
            $qq = $result["num_stock"] * $qty_menu;
            $all = $result["amount_stock"] - $qq;

            $sql2 = " UPDATE stock
SET amount_stock = " . $all . "
WHERE id_stock = " . $result["id_stock"] . "";
            $querys3 = mysqli_query($conn, $sql2);
        }
    }
}
?>