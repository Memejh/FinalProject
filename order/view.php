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
            <?php
            $strid = null;

            if (isset($_GET["id"])) {
                $strid = $_GET["id"];
            }
            $q = "SELECT * FROM menu WHERE id_menu='" . $strid . "' ";
            $result = mysqli_query($conn, $q); // ทำการ query คำสั่ง sql
            while ($data = mysqli_fetch_assoc($result)) {
                ?>


                <form class="form-horizontal" method="post" action="cart.php"><h3>
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8"><b>รหัส : </b><?php echo $data['key_menu'] ?></div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8"><b>ชื่ออาหาร : </b><?php echo $data['name_menu'] ?></div>
                            <div class="col-sm-2"></div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8"><b>ราคา : </b><?php echo $data['price_menu'] ?> </div>
                            <div class="col-sm-2"></div>
                        </div></h3>
                    <input type="hidden" name="h_id_menu" value="<?php echo $data['id_menu'] ?>">
                    <input type="hidden" name="h_name_menu" value="<?php echo $data['name_menu'] ?>">
                    <input type="hidden" name="h_price_menu" value="<?php echo $data['price_menu'] ?>">
                    <button type="submit" name="add_to_cart"  class="btn btn-primary">ใส่ตะกร้า</button>
                </form>

            </body>
        </html>
        <?php
    }
}?>