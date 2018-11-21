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
        <div class="col-sm-12 " style="margin-top:60px">
            <div class="col-sm-1"></div>
            <div class="col-sm-10"><h2>สั่งอาหาร</h2><hr></div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-9"> 

            <?php
            $sql = "SELECT * FROM menu "
                    . " ORDER BY key_menu ASC";
            $query = mysqli_query($conn, $sql);
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-sm-1">ลำดับ</th>
                        <th class="col-sm-1">รหัส</th>
                        <th class="col-sm-4">ชื่ออาหาร</th>
                        <th class="col-sm-1">ราคา</th>
                        <th class="col-sm-2">สั่ง</th>
                    </tr> 
                </thead>
                <tbody>
                    <?php
                    $c = 1;
                    while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr> 
                            
                            <td><?php echo $c++; ?></td>
                            <td><?php echo $result['key_menu']; ?></td>
                            <td><?php echo $result['name_menu']; ?></td>
                            <td><?php echo $result['price_menu']; ?></td>
                           <td><a href="view.php?id=<?php echo $result['id_menu']; ?>"><button type="button" class="btn btn-success" >สั่ง</button></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        mysqli_close($conn);
        ?>

    </body> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/jquery.filtertable.min.js"></script>
    <script>
        $(document).ready(function () {
            $('table').filterTable(); // apply filterTable to all tables on this page
        });
    </script>
</html>
