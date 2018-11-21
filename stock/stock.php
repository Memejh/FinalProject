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
            <div class="col-sm-1"></div>
            <div class="col-sm-11"><h2>
                    วัตถุดิบทั้งหมด

                    <a  data-toggle="modal" href="#ads" type="button" class="btn btn-primary">เพิ่มวัตถุดิบ</a>
                    <a data-toggle="modal" href="#adas"  type="button" class="btn btn-primary">เพิ่มจำนวนวัตถุดิบ</button></a>
                    <a data-toggle="modal" href="#dlas"  type="button" class="btn btn-primary">ลบจำนวนวัตถุดิบ</button></a></h2>
            </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#a">เนื้อสัตว์</a></li>
                <li><a data-toggle="tab" href="#b">ผัก</a></li>
                <li><a data-toggle="tab" href="#c">ผลไม้</a></li>
                <li><a data-toggle="tab" href="#d">เครื่องปรุง</a></li>
                <li><a data-toggle="tab" href="#e">อื่น ๆ</a></li>
                <li><a data-toggle="tab" href="#f">เส้น</a></li>
                <li><a data-toggle="tab" href="#g">ข้าว</a></li>
            </ul>
            <div class="tab-content">
                <div id="a" class="tab-pane fade in active">
                    <?php
                    $perpage = 50;
                    $c = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $i = 1;
                        $j = $page * 10 - 10;
                        $c = $i + $j;
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;

                    if (@$_GET["Action"] == "Del") {
                        $strSQL = "DELETE FROM stock";
                        $strSQL .= "WHERE id_stock= '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }
                    $sql = "select * from stock ORDER BY name_stock ASC limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-3">ชื่อวัตถุดิบ</th>
                                        <th class="col-sm-3">จำนวนคงเหลือ</th>
                                        <th class="col-sm-1">หน่วย</th>
                                        <th class="col-sm-2">ลบวัตถุดิบ</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_stock'] == '1') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['name_stock']; ?></td>
                                            <td><?php echo $result['amount_stock']; ?></td>
                                            <td>กรัม</td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_stock"]; ?>';}">ลบ</a></td>


                                        </tr>


                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from stock ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>
                </div>

                <div id="b" class="tab-pane">
                    <?php
                    $perpage = 50;
                    $c = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $i = 1;
                        $j = $page * 10 - 10;
                        $c = $i + $j;
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;

                    if (@$_GET["Action"] == "Del") {
                        $strSQL = "DELETE FROM stock ";
                        $strSQL .= "WHERE id_stock= '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }
                    $sql = "select * from stock ORDER BY name_stock ASC limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-3">ชื่อวัตถุดิบ</th>
                                        <th class="col-sm-3">จำนวนคงเหลือ</th>
                                        <th class="col-sm-1">หน่วย</th>
                                        <th class="col-sm-2">ลบวัตถุดิบ</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_stock'] == '2') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['name_stock']; ?></td>
                                            <td><?php echo $result['amount_stock']; ?></td>
                                            <td>กรัม</td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_stock"]; ?>';}">ลบ</a></td>


                                        </tr>


                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from stock ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>                </div>

                <div id="c" class="tab-pane">
                    <?php
                    $perpage = 50;
                    $c = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $i = 1;
                        $j = $page * 10 - 10;
                        $c = $i + $j;
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;

                    if (@$_GET["Action"] == "Del") {
                        $strSQL = "DELETE FROM stock ";
                        $strSQL .= "WHERE id_stock= '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }
                    $sql = "select * from stock ORDER BY name_stock ASC limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-3">ชื่อวัตถุดิบ</th>
                                        <th class="col-sm-3">จำนวนคงเหลือ</th>
                                        <th class="col-sm-1">หน่วย</th>
                                        <th class="col-sm-2">ลบวัตถุดิบ</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_stock'] == '3') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['name_stock']; ?></td>
                                            <td><?php echo $result['amount_stock']; ?></td>
                                            <td>กรัม</td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_stock"]; ?>';}">ลบ</a></td>


                                        </tr>


                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from stock ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>
                </div>

                <div id="d" class="tab-pane">
                    <?php
                    $perpage = 50;
                    $c = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $i = 1;
                        $j = $page * 10 - 10;
                        $c = $i + $j;
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;

                    if (@$_GET["Action"] == "Del") {
                        $strSQL = "DELETE FROM stock ";
                        $strSQL .= "WHERE id_stock= '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }
                    $sql = "select * from stock ORDER BY name_stock ASC limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-3">ชื่อวัตถุดิบ</th>
                                        <th class="col-sm-3">จำนวนคงเหลือ</th>
                                        <th class="col-sm-1">หน่วย</th>
                                        <th class="col-sm-2">ลบวัตถุดิบ</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_stock'] == '4') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['name_stock']; ?></td>
                                            <td><?php echo $result['amount_stock']; ?></td>
                                            <td>กรัม</td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_stock"]; ?>';}">ลบ</a></td>


                                        </tr>


        <?php
    }
}
?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from stock ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>


                </div>

                <div id="e" class="tab-pane">
                    <?php
                    $perpage = 50;
                    $c = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $i = 1;
                        $j = $page * 10 - 10;
                        $c = $i + $j;
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;

                    if (@$_GET["Action"] == "Del") {
                        $strSQL = "DELETE FROM stock ";
                        $strSQL .= "WHERE id_stock= '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }
                    $sql = "select * from stock ORDER BY name_stock ASC limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-3">ชื่อวัตถุดิบ</th>
                                        <th class="col-sm-3">จำนวนคงเหลือ</th>
                                        <th class="col-sm-1">หน่วย</th>
                                        <th class="col-sm-2">ลบวัตถุดิบ</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_stock'] == '5') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['name_stock']; ?></td>
                                            <td><?php echo $result['amount_stock']; ?></td>
                                            <td>กรัม</td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_stock"]; ?>';}">ลบ</a></td>


                                        </tr>


        <?php
    }
}
?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from stock ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>


                </div>

                <div id="f" class="tab-pane">
                    <?php
                    $perpage = 50;
                    $c = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $i = 1;
                        $j = $page * 10 - 10;
                        $c = $i + $j;
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;

                    if (@$_GET["Action"] == "Del") {
                        $strSQL = "DELETE FROM stock ";
                        $strSQL .= "WHERE id_stock= '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }
                    $sql = "select * from stock ORDER BY name_stock ASC limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-3">ชื่อวัตถุดิบ</th>
                                        <th class="col-sm-3">จำนวนคงเหลือ</th>
                                        <th class="col-sm-1">หน่วย</th>
                                        <th class="col-sm-2">ลบวัตถุดิบ</th>

                                    </tr> 
                                </thead>
                                <tbody>
    <?php
}

while ($result = mysqli_fetch_assoc($query)) {
    if ($result['type_stock'] == '6') {
        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['name_stock']; ?></td>
                                            <td><?php echo $result['amount_stock']; ?></td>
                                            <td>กรัม</td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_stock"]; ?>';}">ลบ</a></td>


                                        </tr>


                            <?php
                        }
                    }
                    ?>
                            </tbody>
                        </table>
                    </form>
<?php
$sql2 = "select * from stock ";
$query2 = mysqli_query($conn, $sql2);
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / $perpage);
?>
                </div>

                <div id="g" class="tab-pane">
                    <?php
                    $perpage = 50;
                    $c = 1;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        $i = 1;
                        $j = $page * 10 - 10;
                        $c = $i + $j;
                    } else {
                        $page = 1;
                    }

                    $start = ($page - 1) * $perpage;

                    if (@$_GET["Action"] == "Del") {
                        $strSQL = "DELETE FROM stock ";
                        $strSQL .= "WHERE id_stock= '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }
                    $sql = "select * from stock ORDER BY name_stock ASC limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-3">ชื่อวัตถุดิบ</th>
                                        <th class="col-sm-3">จำนวนคงเหลือ</th>
                                        <th class="col-sm-1">หน่วย</th>
                                        <th class="col-sm-2">ลบวัตถุดิบ</th>

                                    </tr> 
                                </thead>
                                <tbody>
    <?php
}

while ($result = mysqli_fetch_assoc($query)) {
    if ($result['type_stock'] == '7') {
        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['name_stock']; ?></td>
                                            <td><?php echo $result['amount_stock']; ?></td>
                                            <td>กรัม</td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_stock"]; ?>';}">ลบ</a></td>


                                        </tr>


                            <?php
                        }
                    }
                    ?>
                            </tbody>
                        </table>
                    </form>
<?php
$sql2 = "select * from stock ";
$query2 = mysqli_query($conn, $sql2);
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / $perpage);
?>
                </div>
            </div>



<?php _div(); ?>




            <!--    ads -->
            <div class="modal fade" id="ads" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">เพิ่มวัตถุดิบ</h2>

                        </div>
                        <form class="form-horizontal" method="post" action="../stock/check_addstock.php">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="namestock">ชื่อวัตถุดิบ :</label>
                                    <div class="col-sm-9">
                                        <input name="namestock" type="text" class="form-control" id="namestock" placeholder="กรอกชื่อวัตถุดิบ" required="">
                                        <input name="amount" type="hidden" value="0">
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="type">จำนวน :</label>
                                    <div class="col-sm-4">
                                        <input name="amount" type="number" class="form-control" id="price" placeholder="กรอกจำนวน" required="">
                                    </div>

                                </div>

                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="type">หน่วย :</label>
                                    <div class="col-sm-4"> 
                                        <select name="unit" id="type" class="form-control">
                                            <option value="">กรุณาเลือก</option>
<?php
$sql = "SELECT * FROM unit";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
    echo "<option value=" . $data[id_unit] . ">$data[name_unit]</option>";
}
?>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="type">ประเภท :</label>
                                    <div class="col-sm-4"> 
                                        <select class="form-control" id="type" name="type">
                                            <option value="">กรุณาเลือก</option>
                                            <option value="1">เนื้อสัตว์</option>
                                            <option value="2">ผัก</option>
                                            <option value="3">ผลไม้</option>
                                            <option value="4">เครื่องปรุง</option>
                                            <option value="5">อื่น ๆ</option>
                                            <option value="6">เส้น</option>
                                            <option value="7">ข้าว</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="namestock">ราคา :</label>
                                    <div class="col-sm-4">
                                        <input name="price" type="number" class="form-control" id="price" placeholder="กรอกราคา">
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="date">วันที่ :</label>
                                    <div class="col-sm-2"> 
                                        <input type="hidden" name="date" value="<?php echo date('d/m/y'); ?> "><?php echo date('d/m/y'); ?>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="date">เวลา :</label>
                                    <div class="col-sm-2"> 
                                        <input type="hidden" name="date" value="<?php
                                        date_default_timezone_set('Asia/Bangkok');
                                        echo time('H:i:s');
?> "><?php echo date('H:i:s'); ?>
                                    </div>
                                </div>

                            </div>            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                                <button class="btn btn-primary ">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!--    adas -->
            <div class="modal fade" id="adas" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">เพิ่มจำนวนวัตถุดิบ</h2>

                        </div>
                        <form class="form-horizontal" method="post" action="check_addamount.php">
                            <div class="modal-body">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="namestock">ชื่อวัตถุดิบ :</label>
                                    <div class="col-sm-6"> 
                                        <select name="name" id="type" class="form-control">
                                            <option value="">กรุณาเลือกวัตถุดิบ</option>
<?php
$sql = "SELECT * FROM stock";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $data["id_stock"] . "'>$data[name_stock]</option>";
}
?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="amount">จำนวน :</label>
                                    <div class="col-sm-4">
                                        <input name="typeac" type="hidden" value="1">
                                        <input name="amount" type="number" class="form-control" id="namestock" placeholder="กรอกจำนวน" required>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="type">หน่วย :</label>
                                    <div class="col-sm-4"> 
                                        <select name="unit" class="form-control">
                                            <option value="">กรุณาเลือก</option>
<?php
$sql = "SELECT * FROM unit";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
 echo "<option value='" . $data["id_unit"] . "'>$data[name_unit]</option>";
}
?>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="price">ราคา :</label>
                                    <div class="col-sm-4">
                                        <input name="price" type="number" class="form-control" id="price" placeholder="กรอกราคา" required>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="date">วันที่ :</label>
                                    <div class="col-sm-2"> 
                                        <input type="hidden" name="date" value="<?php echo date('y/m/d'); ?> "><?php echo date('d/m/y'); ?>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="date">เวลา :</label>
                                    <div class="col-sm-2"> 
                                        <input type="hidden" name="time" value="<?php
                                        date_default_timezone_set('Asia/Bangkok');
                                        echo date('H:i:s');
?> ">
<?php echo date('H:i:s'); ?>
                                    </div>
                                </div>


                            </div><div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                                <button class="btn btn-primary ">บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <div class="modal fade" id="dlas" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h2 class="modal-title" id="exampleModalLabel">ลบจำนวนวัตถุดิบ</h2>

                        </div>
                        <form class="form-horizontal" method="post" action="check_addamount.php"> 
                            <div class="modal-body">


                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="namestock">ชื่อวัตถุดิบ :</label>
                                    <div class="col-sm-6"> 
                                        <select name="name" id="type" class="form-control">
                                            <option value="">กรุณาเลือกวัตถุดิบ</option>
<?php
$sql = "SELECT * FROM stock";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $data["id_stock"] . "'>$data[name_stock]</option>";
}
?>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="amount">จำนวน :</label>
                                    <div class="col-sm-4">
                                        <input name="typeac" type="hidden" value="2">
                                        <input name="price" type="hidden" value="">
                                        <input name="amount" type="number" class="form-control" placeholder="กรอกจำนวน" required>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="type">หน่วย :</label>
                                    <div class="col-sm-4"> 
                                        <select name="unit" id="type" class="form-control">
                                            <option value="">กรุณาเลือก</option>
<?php
$sql = "SELECT * FROM unit";
$result = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($result)) {
    echo "<option value='" . $data["id_unit"] . "'>$data[name_unit]</option>";
}
?>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="date">วันที่ :</label>
                                    <div class="col-sm-2"> 
                                        <input type="hidden" name="date" value="<?php echo date('y/m/d'); ?> "><?php echo date('d/m/y'); ?>
                                    </div>
                                </div>
                                <div class="form-group"> 
                                    <label class="control-label col-sm-3" for="date">เวลา :</label>
                                    <div class="col-sm-2"> 
                                        <input type="hidden" name="time" value="
<?php
date_default_timezone_set('Asia/Bangkok');
echo time('H:i:s');
?> "><?php echo date('H:i:s'); ?>
                                    </div>
                                </div>


                            </div><div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                                <button class="btn btn-primary ">บันทึก</button>
                            </div>



                        </form>
                    </div>
                </div>
            </div>



    </body>
</html>
