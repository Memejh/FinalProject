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
        $typeac = $_POST["typeac"];
        $name = $_POST["name"];
        $amount = $_POST["amount"];
        $unit = $_POST["unit"];
        $price = $_POST["price"];
        $date = $_POST["date"];
        $time = $_POST["time"];

        if ($typeac == 1) {
            $sql = "INSERT INTO expenditure (e_namestock,e_price,e_number,e_unit,e_date,e_time) 
		VALUES ('$name','$price','$amount','$unit','$date','$time')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $sql = "select * from stock "
                        . " INNER JOIN expenditure ON stock.id_stock = expenditure.e_namestock"
                        . " INNER JOIN unit ON expenditure.e_unit = unit.id_unit"
                        . " WHERE id_stock = $name";
                $query = mysqli_query($conn, $sql);
                while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                    if ($unit == $result["id_unit"]) {
                        $amo = $result["value"] * $amount;
                        $c = $result["amount_stock"] + $amo;
                        $sql = "UPDATE stock SET 
                                amount_stock = '$c'
                                WHERE id_stock = $name";
                    }
                }
                $query2 = mysqli_query($conn, $sql);

                if ($query2) {
                    echo '<br><br><br><center><img src="../img/t.png" style="width="300" height="300""></center>';
                    echo '<center><h1 style="color:green;">บันทึกข้อมูลสำเร็จ</h1><center><br><br><br>';
                } else {
                    echo '<br><br><br><center><img src="../img/f.png"  style="width="300" height="300""></center>';
                    echo "<center><h1 style='color:red;'>Database Connect Failed : " . mysqli_connect_error() . '</h1><center><br><br><br>';
                }
            }
        } elseif ($typeac == 2) {
            $sql = "select * from stock "
                    . " INNER JOIN expenditure ON stock.id_stock = expenditure.e_namestock"
                    . " INNER JOIN unit ON expenditure.e_unit = unit.id_unit"
                    . " WHERE id_stock = $name";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                if ($unit == $result["id_unit"]) {
                    $amo = $result["value"] * $amount;
                    $c = $result["amount_stock"] - $amo;
                    $sql = "UPDATE stock SET 
                                amount_stock = '$c'
                                WHERE id_stock = $name";
                }
            }
            $query2 = mysqli_query($conn, $sql);

            if ($query2) {
                echo '<br><br><br><center><img src="../img/t.png" style="width="300" height="300""></center>';
                echo '<center><h1 style="color:green;">บันทึกข้อมูลสำเร็จ</h1><center><br><br><br>';
            } else {
                echo '<br><br><br><center><img src="../img/f.png"  style="width="300" height="300""></center>';
                echo "<center><h1 style='color:red;'>Database Connect Failed : " . mysqli_connect_error() . '</h1><center><br><br><br>';
            }
        }
        ?>
        <meta http-equiv="refresh" content="2; url=../stock/stock.php?page=1" />
<?php _div(); ?>
    </body>
</html>
