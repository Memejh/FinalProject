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
<?php
// สวนของการเพิ่มรายการในตะกร้าสินค้า
if (isset($_POST['add_to_cart'])) {
    $keyProID = $_POST['h_id_menu'];
    if ($_POST['h_id_menu'] != "" && $_POST['h_name_menu'] != "" && $_POST['h_price_menu'] != "") {
        $_SESSION['id_menu'][$keyProID] = $_POST['h_id_menu'];
        $_SESSION['name_menu'][$keyProID] = $_POST['h_name_menu'];
        $_SESSION['qty_menu'][$keyProID][] = 1;
        $_SESSION['price_menu'][$keyProID] = $_POST['h_price_menu'];
        $_SESSION['total_price'][$keyProID] = array_sum($_SESSION['qty_menu'][$keyProID]) * $_SESSION['price_menu'][$keyProID];
    }
}
// ยกเลิก และลบรายการในตัวแปร session
if (isset($_GET['remove']) && $_GET['d_pro_id'] != "") {
    $keyProID = $_GET['d_pro_id'];
    unset($_SESSION['id_menu'][$keyProID]);
    unset($_SESSION['name_menu'][$keyProID]);
    unset($_SESSION['qty_menu'][$keyProID]);
    unset($_SESSION['price_menu'][$keyProID]);
    unset($_SESSION['total_price'][$keyProID]);
    header("Location:cart.php");
    exit;
}
// ส่วนของการอัพเดทจำนวนและราคาของแต่ละรายการ เมื่อเปลี่ยนแปลงจำนวน
if (isset($_GET['update']) && $_GET['u_pro_id'] != "" && $_GET['new_qty'] != "") {
    $keyProID = $_GET['u_pro_id'];
    unset($_SESSION['qty_menu'][$keyProID]);
    for ($i = 0; $i < $_GET['new_qty']; $i++) {
        $_SESSION['qty_menu'][$keyProID][] = 1;
    }
    $_SESSION['total_price'][$keyProID] = array_sum($_SESSION['qty_menu'][$keyProID]) * $_SESSION['price_menu'][$keyProID];
    header("Location:cart.php");
    exit;
}
?>
<!--suppress ALL -->
<script src="../js/click.js"></script>
<link rel="stylesheet" href="../css/btorder.css">
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
                <div class="col-sm-1"></div>
                <div class="col-sm-10"><h2>สั่งอาหาร</h2><hr></div>
                </div>
        <?php div('col-sm-2 text-center sidenav beet'); ?>
        <?php _div(); ?>
        <?php div('col-sm-8 text-center sidenav beet');
        { ?>

        <a href="order.php"><button class="btn btn-primary">สั่งอาหาร</button></a> <br>
           <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่ออาหาร</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>รวม</th>
                        <th>ลบ</th>
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
                                <td>
                                    <select name="qty[]"
                                            onchange="window.location = '?u_pro_id=<?= $k_pro_id ?>&new_qty=' + this.value + '&update'">
                                        <?php for ($v = 1; $v <= 15; $v++) { ?>
                                            <option value="<?= $v ?>" <?= ($qty_data == $v) ? "selected" : "" ?> ><?= $v ?></option>
            <?php } ?>
                                    </select>
                                </td>
                                <td><?= $_SESSION['total_price'][$k_pro_id] ?></td>
                                <td><a href="?d_pro_id=<?= $k_pro_id ?>&remove">ลบ</a></td>
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
                            <td colspan="3"></td>
                            <td><?= count($_SESSION['qty_menu'], 1) - count($_SESSION['qty_menu']) ?></td>
                            <td><?= array_sum($_SESSION['total_price']) ?></td>
                            <td>
                                <input class="btn btn-success" type="button" onclick="window.location = 'checkout.php'" value="เสร็จสิ้น">
                            </td>
                        </tr>
        <?php }} ?>
            </tbody>
        </table>
    </div>

</body>
</html>