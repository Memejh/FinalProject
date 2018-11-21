
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

        $namestock = $_POST["namestock"];
        $amount = $_POST["amount"];
        $unit = $_POST["unit"];
        $type = $_POST["type"];

// เช็คว่ามีข้อมูลนี้อยู่หรือไม่
        $check = "select * from stock  where name_stock = '$namestock' ";
        $result1 = mysqli_query($conn, $check);
        $num = mysqli_num_rows($result1);
        if ($num > 0) {
//ถ้ามี username นี้อยู่ในระบบแล้วให้แจ้งเตือน
            echo "<script>";
            echo "alert(' มีวัตถุดิบนี้แล้ว กรุณากรอกใหม่อีกครั้ง !');";
            echo "window.location='stock.php';";
            echo "</script>";
        } else {
            $sql = "select * from stock "
                    . " INNER JOIN unit ON stock.type_unit = unit.id_unit";
            $query1 = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {
                if ($unit == $result["id_unit"]) {
                    $amo = $result["value"] * $amount;
                    $sql2 = "INSERT INTO stock (name_stock,amount_stock,type_unit,type_stock) 
             VALUES ('$namestock','$amo','$unit','$type')";
                }
            }


//            $sql = "INSERT INTO stock (name_stock,amount_stock,type_unit,type_stock) 
//            VALUES ('$namestock','$amount','$unit','$type')";
//    $sql2 = "INSERT INTO unit (id_unit) 
//            VALUES ('$unit')";

            $query2 = mysqli_query($conn, $sql2);
            // $query = mysqli_query($conn, $sql);

            if ($query2) {
                echo '<br><br><br><center><img src="../img/t.png" style="width="300" height="300""></center>';
                echo '<center><h1 style="color:green;">บันทึกข้อมูลสำเร็จ</h1><center><br><br><br>';
            } else {
                echo '<br><br><br><center><img src="../img/f.png" style="width="300" height="300""></center>';
                echo "<center><h1 style='color:red;'>Database Connect Failed : " . mysqli_connect_error() . '</h1><center><br><br><br>';
            }
        }
        ?>
        <meta http-equiv="refresh" content="2; url=../stock/stock.php" />
        <?php _div(); ?>
    </body>
</html>

