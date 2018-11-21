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
        <script src="jquery-1.11.1.min.js" type="text/javascript"></script>
        <?php
        head('Local Restaurant Management System');
        headcss();
        menucss();
        js();
        ?> 
    </head>
    <body>


        <?php $seesion = $_SESSION["Status"]; ?>      
        <?php div('container menuXX'); ?>
        <?php
        $navbar->navbarOpen($seesion);


        if (isset($_POST["hdnCmd"])) {
            if ($_POST["hdnCmd"] == "Update") {
                $strSQL = "UPDATE menu SET ";
                $strSQL .= "name_menu = '" . $_POST["namemenu"] . "' ";
                $strSQL .= ",price_menu = '" . $_POST["price"] . "' ";
                $strSQL .= ",type_menu = '" . $_POST["type"] . "' ";

                $strSQL .= "WHERE id_menu = '" . $_POST["hdnEdID"] . "' ";
                $Query = mysqli_query($conn, $strSQL);
                if (!$Query) {
                    echo "Error Update [" . mysqli_error($conn) . "]";
                }
                //header("location:$_SERVER[PHP_SELF]");
                //exit();
            }
        }
        ?>
        <div class="col-sm-12 " style="margin-top:60px">
            <div class="col-sm-1"></div>
            <div class="col-sm-11"><h2>
                    เมนูอาหาร 
                    <a type="button" class="btn btn-primary"  data-toggle="modal" href="#ad">เพิ่มเมนู</a>
                    <a type="button" class="btn btn-primary" data-toggle="modal" href="#ed">แก้ไขเมนู</a>
                    <a href="../menu/printmenu.php" type="button" class="btn btn-primary">พิมพ์เมนู</a>


                </h2>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
            </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#a">ผัด</a></li>
                <li><a data-toggle="tab" href="#b">ต้ม</a></li>
                <li><a data-toggle="tab" href="#c">ทอด</a></li>
                <li><a data-toggle="tab" href="#d">นึ่ง</a></li>
                <li><a data-toggle="tab" href="#e">อาหารเช้า</a></li>
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
                        $strSQL = "DELETE FROM menu ";
                        $strSQL .= "WHERE id_menu = '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }

                    $sql = "select * from menu "
                            . " ORDER BY key_menu ASC"
                            . " limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-1">รหัส</th>
                                        <th class="col-sm-4">ชื่ออาหาร</th>
                                        <th class="col-sm-1">ราคา</th>
                                        <th class="col-sm-2">ส่วนผสม</th>
                                        <th class="col-sm-1">ลบเมนู</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_menu'] == '1') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['key_menu']; ?></td>
                                            <td><?php echo $result['name_menu']; ?></td>
                                            <td><?php echo $result['price_menu']; ?></td>
                                            <td><a href="../menu/mixmenu.php?id=<?php echo $result["id_menu"]; ?>">ดูรายละเอียด</a></td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_menu"]; ?>';}">ลบ</a></td>
                                        </tr>


                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from menu ";
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
                        $strSQL = "DELETE FROM menu ";
                        $strSQL .= "WHERE id_menu = '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }

                    $sql = "select * from menu "
                            . " ORDER BY key_menu ASC"
                            . " limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-1">รหัส</th>
                                        <th class="col-sm-4">ชื่ออาหาร</th>
                                        <th class="col-sm-1">ราคา</th>
                                        <th class="col-sm-2">ส่วนผสม</th>
                                        <th class="col-sm-1">ลบเมนู</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_menu'] == '2') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['key_menu']; ?></td>
                                            <td><?php echo $result['name_menu']; ?></td>
                                            <td><?php echo $result['price_menu']; ?></td>
                                            <td><a href="../menu/mixmenu.php?id=<?php echo $result["id_menu"]; ?>">ดูรายละเอียด</a></td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_menu"]; ?>';}">ลบ</a></td>
                                        </tr>


                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from menu ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>

                </div>

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
                        $strSQL = "DELETE FROM menu ";
                        $strSQL .= "WHERE id_menu = '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }

                    $sql = "select * from menu "
                            . " ORDER BY key_menu ASC"
                            . " limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-1">รหัส</th>
                                        <th class="col-sm-4">ชื่ออาหาร</th>
                                        <th class="col-sm-1">ราคา</th>
                                        <th class="col-sm-2">ส่วนผสม</th>
                                        <th class="col-sm-1">ลบเมนู</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_menu'] == '3') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['key_menu']; ?></td>
                                            <td><?php echo $result['name_menu']; ?></td>
                                            <td><?php echo $result['price_menu']; ?></td>
                                            <td><a href="../menu/mixmenu.php?id=<?php echo $result["id_menu"]; ?>">ดูรายละเอียด</a></td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_menu"]; ?>';}">ลบ</a></td>
                                        </tr>


                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from menu ";
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
                        $strSQL = "DELETE FROM menu ";
                        $strSQL .= "WHERE id_menu = '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }

                    $sql = "select * from menu "
                            . " ORDER BY key_menu ASC"
                            . " limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-1">รหัส</th>
                                        <th class="col-sm-4">ชื่ออาหาร</th>
                                        <th class="col-sm-1">ราคา</th>
                                        <th class="col-sm-2">ส่วนผสม</th>
                                        <th class="col-sm-1">ลบเมนู</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_menu'] == '4') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['key_menu']; ?></td>
                                            <td><?php echo $result['name_menu']; ?></td>
                                            <td><?php echo $result['price_menu']; ?></td>
                                            <td><a href="../menu/mixmenu.php?id=<?php echo $result["id_menu"]; ?>">ดูรายละเอียด</a></td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_menu"]; ?>';}">ลบ</a></td>
                                        </tr>


        <?php
    }
}
?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from menu ";
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
                        $strSQL = "DELETE FROM menu ";
                        $strSQL .= "WHERE id_menu = '" . $_GET["CusID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Delete [" . mysqli_error() . "]";
                        }
                    }

                    $sql = "select * from menu "
                            . " ORDER BY key_menu ASC"
                            . " limit {$start} , {$perpage} ";
                    $query = mysqli_query($conn, $sql);
                    {
                        ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th class="col-sm-1">ลำดับ</th>
                                        <th class="col-sm-1">รหัส</th>
                                        <th class="col-sm-4">ชื่ออาหาร</th>
                                        <th class="col-sm-1">ราคา</th>
                                        <th class="col-sm-2">ส่วนผสม</th>
                                        <th class="col-sm-1">ลบเมนู</th>

                                    </tr> 
                                </thead>
                                <tbody>
                                    <?php
                                }

                                while ($result = mysqli_fetch_assoc($query)) {
                                    if ($result['type_menu'] == '5') {
                                        ?>
                                        <tr> 
                                            <td><?php echo $c++; ?></td>
                                            <td><?php echo $result['key_menu']; ?></td>
                                            <td><?php echo $result['name_menu']; ?></td>
                                            <td><?php echo $result['price_menu']; ?></td>
                                            <td><a href="../menu/mixmenu.php?id=<?php echo $result["id_menu"]; ?>">ดูรายละเอียด</a></td>
                                            <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_menu"]; ?>';}">ลบ</a></td>
                                        </tr>


        <?php
    }
}
?>
                            </tbody>
                        </table>
                    </form>
                    <?php
                    $sql2 = "select * from menu ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>

                </div>
            </div>
        </div>


<?php _div(); ?>

        <!--    ad -->
        <div class="modal fade" id="ad" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">เพิ่มเมนู</h2>

                    </div>
                    <form class="form-horizontal" method="post" action="check_addmenu.php">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="keymenu">รหัสเมนู :</label>
                                <div class="col-sm-9">
                                    <input name="addmenu" type="hidden" value="1">
                                    <input name="keymenu" type="text" class="form-control" id="namemenu" placeholder="รหัสเมนู" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="namemenu">ชื่อเมนู :</label>
                                <div class="col-sm-9">
                                    <input name="namemenu" type="text" class="form-control" id="namemenu" placeholder="กรอกชื่อเมนู" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="price">ราคา :</label>
                                <div class="col-sm-4"> 
                                    <input name="price" type="number" class="form-control" id="price" placeholder="กรอกราคา" required="">
                                </div>
                            </div>

                            <div class="form-group"> 
                                <label class="control-label col-sm-3" for="type">ประเภท :</label>
                                <div class="col-sm-4"> 
                                    <select class="form-control" id="type" name="type">
                                        <option value="">กรุณาเลือก</option>
                                        <option value="1">ผัด</option>
                                        <option value="2">ต้ม</option>
                                        <option value="3">ทอด</option>
                                        <option value="4">นึ่ง</option>
                                        <option value="5">อาหารเช้า</option>
                                        <?php
                                        $sql = "SELECT * FROM type";
                                        $result = mysqli_query($conn, $sql);
                                        while ($data = mysqli_fetch_assoc($result)) {
                                            echo "<option>$data[name_type]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                            <button id="btnSubmit" class="btn btn-primary ">บันทึก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!--    ed -->
        <div class="modal fade" id="ed" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel">แก้ไขเมนู</h2>
                    </div>
                    <form class="form-horizontal" method="post" action="check_addmenu.php">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="namemenu">ชื่อเมนูอาหาร :</label>
                                <input name="addmenu" type="hidden" value="2">
                                <input type="hidden" name="idmenu"value="<?php echo $Result["id_menu"]; ?>">
                                <div class="col-sm-6"> 
                                    <select name="namemenu" id="type" class="form-control">
                                        <option value="">กรุณาเลือกเมนูอาหาร</option>
                                        <?php
                                        $sql = "SELECT * FROM menu";
                                        $result = mysqli_query($conn, $sql);
                                        while ($data = mysqli_fetch_assoc($result)) {
                                            echo "<option value='" . $data["id_menu"] . "'>$data[name_menu]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="price">ราคา :</label>
                                <div class="col-sm-3"> 
                                    <input name="price" type="number" class="form-control" id="price" placeholder="ราคา" required="">
                                </div>
                            </div>
                            <div class="form-group"> 
                                <label class="control-label col-sm-3" for="type">ประเภท :</label>
                                <div class="col-sm-4"> 
                                    <select class="form-control" id="type" name="type">
                                        <option value="1">ผัด</option>
                                        <option value="2">ต้ม</option>
                                        <option value="3">ทอด</option>
                                        <option value="4">นึ่ง</option>
                                        <option value="5">อาหารเช้า</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                            <button id="btnSubmit" class="btn btn-primary ">บันทึก</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </body>
</html>
