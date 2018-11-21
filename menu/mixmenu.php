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
        <?php
        div('container menuXX');

        $strid = null;

        if (isset($_GET["id"])) {
            $strid = $_GET["id"];
        }
        ?>
        <div class="col-sm-12 " style="margin-top:60px">
            <div class="col-sm-1"></div>
            <div class="col-sm-11"><h2>
                    ส่วนผสม
                    <b><?php
                        $sql = "select * from menu WHERE id_menu = " . $strid . "";
                        $query = mysqli_query($conn, $sql);
                        while ($result = mysqli_fetch_assoc($query)) {
                            echo $result['name_menu'];
                        }
                        ?></b>

                    <a type="button" class="btn btn-primary" data-toggle="modal" href="#mix">เพิ่มส่วนผสม</a>
                </h2><hr>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-11">

                <?php
////*** Add Condition ***//
//                if ($_POST["hdnCmd"] == "Add") {
//                    $strSQL = "INSERT INTO customer ";
//                    $strSQL .= "(CustomerID,Name,Email,CountryCode,Budget,Used) ";
//                    $strSQL .= "VALUES ";
//                    $strSQL .= "('" . $_POST["txtAddCustomerID"] . "','" . $_POST["txtAddName"] . "' ";
//                    $strSQL .= ",'" . $_POST["txtAddEmail"] . "' ";
//                    $strSQL .= ",'" . $_POST["txtAddCountryCode"] . "','" . $_POST["txtAddBudget"] . "' ";
//                    $strSQL .= ",'" . $_POST["txtAddUsed"] . "') ";
//                    $objQuery = mysql_query($strSQL);
//                    if (!$objQuery) {
//                        echo "Error Save [" . mysql_error() . "]";
//                    }
//                    //header("location:$_SERVER[PHP_SELF]");
//                    //exit();
//                }
//*** Update Condition ***//

                if (isset($_POST["hdnCmd"])) {
                    if ($_POST["hdnCmd"] == "Update") {
                        $strSQL = "UPDATE admixture SET ";
                        //  $strSQL .= "id_stock_adm = '" . $_POST["hdnEdID"] . "' ";
                        $strSQL .= "num_stock = '" . $_POST["txtEditNumber"] . "' ";
                        $strSQL .= ",id_unit_adm = '" . $_POST["txtEditUnit"] . "' ";
                        $strSQL .= "WHERE id_admixture = '" . $_POST["hdnEdID"] . "' ";
                        $Query = mysqli_query($conn, $strSQL);
                        if (!$Query) {
                            echo "Error Update [" . mysqli_error($conn) . "]";
                        }
                        //header("location:$_SERVER[PHP_SELF]");
                        //exit();
                    }
                }

//*** Delete Condition ***//
                if (@$_GET["Action"] == "Del") {
                    $strSQL = "DELETE FROM admixture ";
                    $strSQL .= "WHERE id_admixture = '" . $_GET["CusID"] . "' ";
                    $Query = mysqli_query($conn, $strSQL);
                    if (!$Query) {
                        echo "Error Delete [" . mysqli_error() . "]";
                    }
                }

                $strSQL = "SELECT * FROM ((admixture INNER JOIN menu ON admixture.id_menu_adm = menu.id_menu)"
                        . " INNER JOIN stock ON admixture.id_stock_adm = stock.id_stock)"
                        . " INNER JOIN unit ON admixture.id_unit_adm = unit.id_unit"
                        . " WHERE id_menu_adm = '" . $strid . "'";
                $Query = mysqli_query($conn, $strSQL);
                ?>
                <form name="frmMain" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $strid; ?>">
                    <input type="hidden" name="hdnCmd" value="">
                    <table  class="table table-striped">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อวัตถุดิบ</th>
                                <th class="col-sm-2">จำนวน</th>
                                <th class="col-sm-2">หน่วย</th>
                                <th class="col-sm-1">แก้ไข</th>
                                <th class="col-sm-1">ลบ</th>
                            </tr>
                        </thead>
                        <?php
                        $c = 1;
                        while ($Result = mysqli_fetch_array($Query)) {
                            ?>
                            <?php
                            if ($Result["id_admixture"] == @$_GET["CusID"] and @ $_GET["Action"] == "Edit") {
                                ?>
                                <tr>
                                    <td><?php echo $c++; ?>
                                        <input type="hidden" name="hdnEdID"value="<?php echo $Result["id_admixture"]; ?>">
                                    </td>
                                    <td><?php echo $Result["name_stock"]; ?></td>
                                    <td><input class="form-control" type="number" name="txtEditNumber" value="<?php echo $Result["num_stock"]; ?>"></td>
                                    <td><select name="txtEditUnit" id="type" class="form-control">
                                            <?php
                                            $sql = "SELECT * FROM unit";
                                            $result = mysqli_query($conn, $sql);
                                            while ($data = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $data["id_unit"] . "'>" . $data[name_unit] . "</option>";
                                            }
                                            ?>
                                        </select></td>
                                    <td><input class="btn btn-info" name="btnAdd" type="button" id="btnUpdate" value="บันทึก" OnClick="frmMain.hdnCmd.value = 'Update';frmMain.submit();">
                                    </td>
                                    <td><input class="btn btn-default" name="btnAdd" type="button" id="btnCancel" value="ยกเลิก" OnClick="window.location = '<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $strid; ?>';">
                                    </td>
                                </tr>

                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td><b><?php echo $c++; ?></b></td>
                                    <td><?php echo $Result["name_stock"]; ?></td>
                                    <td><?php echo $Result["num_stock"]; ?></td>
                                    <td><?php echo $Result["name_unit"]; ?></td>
                                    <td><a class="btn btn-success" href="<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $strid; ?>&Action=Edit&CusID=<?php echo $Result["id_admixture"]; ?>">แก้ไข</a></td>
                                    <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?id=<?php echo $strid; ?>&Action=Del&CusID=<?php echo $Result["id_admixture"]; ?>';}">ลบ</a></td>
                                </tr>

                                <?php
                            }
                            ?>
                            <?php
                        }
                        ?>
                    </table>
                </form>

                <!--    mix -->
                <div class="modal fade" id="mix" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">ส่วนผสม</h2>

                            </div>
                            <form class="form-horizontal" method="post" action="../menu/check_addmix.php">
                                <div class="modal-body">


                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="namestock">ชื่อเมนู :</label>
                                        <div class="col-sm-6"> 
                                                <?php
                                                $sql = "SELECT * FROM menu where id_menu = '$strid'";
                                                $result = mysqli_query($conn, $sql);
                                                while ($data = mysqli_fetch_assoc($result)) {
                                                    echo $data["name_menu"];
                                                    echo ' <input name="namemenu" type="hidden" value="'.$data["id_menu"].'">';
                                                }
                                                ?>
                                           
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="namestock">ชื่อส่วนผสม :</label>
                                        <div class="col-sm-6"> 
                                            <select name="namestock" id="type" class="form-control">
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
                                                    echo "<option value=" . $data["id_unit"] . ">$data[name_unit]</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                                    <button class="btn btn-primary ">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>