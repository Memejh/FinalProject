
<?php
include '../function/conn.php';
include '../function/style.php';
include '../style.php';
?>
<html>
    <head>

        <?php
        head('ตามสั่ง System');
        headcss();
        menucss();
        js();
        ?> 
    </head>
    <body>
        <?php div('container menuXX'); ?>
        <?php
        include '../function/conn.php';

        $namemenu = $_POST["namemenu"];
        $namestock = $_POST["namestock"];
        $amount = $_POST["amount"];
        $unit = $_POST["unit"];

       
        
        $sql = "INSERT INTO admixture (id_menu_adm,id_stock_adm,num_stock,id_unit_adm) 
            VALUES ('$namemenu','$namestock','$amount','$unit')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '<br><br><br><center><img src="../img/t.png" style="width="300" height="300""></center>';
            echo '<center><h1 style="color:green;">บันทึกข้อมูลสำเร็จ</h1><center><br><br><br>';
        } else {
            echo '<br><br><br><center><img src="../img/f.png" style="width="300" height="300""></center>';
            echo "<center><h1 style='color:red;'>Database Connect Failed : " . mysqli_connect_error() . '</h1><center><br><br><br>';
        }
        ?>
        <meta http-equiv="refresh" content="2; url=../menu/mixmenu.php?id=<?php echo $namemenu;?>">
        <?php _div(); ?>
    </body>
</html>

