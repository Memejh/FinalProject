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
                    ข้อมูลผู้ใช้
                    <hr>
                    </div>
                    </div>  

                    <form class="form-horizontal" method="post" ><b>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">ชื่อร้าน : <?php echo $_SESSION["Restname"]; ?></div>
                                <div class="col-sm-2"></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">ชื่อผู้ใช้ : <?php echo $_SESSION["Name"]; ?> 
                                </div>
                                <div class="col-sm-2"></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">E-mail : <?php echo $_SESSION["Email"]; ?></div>
                                <div class="col-sm-2"></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <a data-toggle="modal" href="#edname" type="button" class="btn btn-success">แก้ไขข้อมูล</a>
                                <a data-toggle="modal" href="#edpass" type="button" class="btn btn-success">เปลี่ยนรหัสผ่าน</a></div>
                            <div class="col-sm-2"></div>
                        </b>
                    </form>

                    <div class="form-group">
                        <div class="col-sm-1"></div>   
                        <label class="control-label col-sm-11"><h3><b>รายชื่อพนักงาน 
                                    <a  data-toggle="modal" href="#aduser" type="button" class="btn btn-primary">เพิ่มสมาชิก</a></b></h3></label> 
                    </div>

                    <div class="form-group"> 
                       
                        <div class="col-sm-12"> 

                            <?php
                            if (isset($_POST["hdnCmd"])) {
                                if ($_POST["hdnCmd"] == "Update") {
                                    $strSQL = "UPDATE user SET ";
                                    //  $strSQL .= "id_stock_adm = '" . $_POST["hdnEdID"] . "' ";
                                    $strSQL .= "name_user = '" . $_POST["name_user"] . "' ";
                                    $strSQL .= ",email_user = '" . $_POST["email_user"] . "' ";
                                    $strSQL .= "WHERE id_user = '" . $_POST["hdnEdID"] . "' ";
                                    $Query = mysqli_query($conn, $strSQL);
                                    if (!$Query) {
                                        echo "Error Update [" . mysqli_error($conn) . "]";
                                    }
                                }
                            }
                            if (@$_GET["Action"] == "Del") {
                                $strSQL = "DELETE FROM user ";
                                $strSQL .= "WHERE id_user = '" . $_GET["CusID"] . "' ";
                                $Query = mysqli_query($conn, $strSQL);
                                if (!$Query) {
                                    echo "Error Delete [" . mysqli_error() . "]";
                                }
                            }

                            $sql = "select * from user";
                            $query = mysqli_query($conn, $sql); {
                                ?>
                                <form name="frmMain" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <input type="hidden" name="hdnCmd" value="">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-sm-1">ลำดับ</th>
                                                <th class="col-sm-3">ชื่อพนักงาน</th>
                                                <th class="col-sm-4">E-mail</th>
                                                <th class="col-sm-4">Password</th>
                                                <th class="col-sm-1">แก้ไข</th>
                                                <th class="col-sm-1">ลบ</th>
                                            </tr> 
                                        </thead>    
                                        <?php
                                    }
                                    $c = 1;
                                    while ($result = mysqli_fetch_assoc($query)) {
                                        if ($result['status_user'] == '2') {
                                            if ($result["id_user"] == @$_GET["CusID"] and @ $_GET["Action"] == "Edit") {
                                                ?>
                                                <tr>
                                                    <td><?php echo $c++; ?>
                                                        <input type="hidden" name="hdnEdID"value="<?php echo $result["id_user"]; ?>">
                                                    </td>
                                                    <td><input class="form-control" type="text" name="name_user" value="<?php echo $result["name_user"]; ?>"></td>
                                                    <td><input class="form-control" type="email" name="email_user" value="<?php echo $result["email_user"]; ?>"></td>
                                                    <td><input class="form-control" type="password" name="password_user" value="<?php echo $result["pass_user"]; ?>"></td>
                                                    <td><input class="btn btn-info" name="btnAdd" type="button" id="btnUpdate" value="บันทึก" OnClick="frmMain.hdnCmd.value = 'Update';frmMain.submit();">
                                                    </td>
                                                    <td><input class="btn btn-default" name="btnAdd" type="button" id="btnCancel" value="ยกเลิก" OnClick="window.location = '<?php echo $_SERVER["PHP_SELF"]; ?>';">
                                                    </td>
                                                </tr>
                                                <?php
                                            } else {
                                                ?>
                                                <tr> 
                                                    <td><?php echo $c++; ?></td>
                                                    <td><?php echo $result['name_user']; ?></td>
                                                    <td><?php echo $result['email_user']; ?></td>
                                                    <td>- - - - -</td>
                                                    <td><a class="btn btn-success" href="<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Edit&CusID=<?php echo $result["id_user"]; ?>">แก้ไข</a></td>
                                                    <td><a class="btn btn-primary" href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='<?php echo $_SERVER["PHP_SELF"]; ?>?Action=Del&CusID=<?php echo $result["id_user"]; ?>';}">ลบ</a></td>
                                                </tr>


                                                <?php
                                            }
                                        }
                                    }
                                    ?>

                                </table>
                            </form>
                        </div>
                        
                    </div>
                    <!--      edname -->
                    <form action="activate.php" method="POST">
                        <div class="modal fade" id="edname" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input name="nameR" type="text" class="form-control" id="namead" value="<?php echo $_SESSION["Restname"]; ?>" required="">
                                            <input type="hidden" name="activate" value="1">
                                        </div>
                                        <div class="form-group">
                                            <input name="nameU" type="text" class="form-control" id="namead" value="<?php echo $_SESSION["Name"]; ?>" required="">
                                        </div>
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control" id="namead" value="<?php echo $_SESSION["Email"]; ?>" required="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                                        <button class="btn btn-primary ">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--      edpass -->
                    <div class="modal fade" id="edpass" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                        <form action="activate.php" method="POST">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">เปลี่ยนรหัสผ่าน</h4>
                                        <input type="hidden" name="activate" value="2">
                                    </div>
                                    <div class="modal-body">
                                        <label>กรอกรหัสผ่านเดิม</label>
                                        <div class="form-group">
                                            <input name="oldpass" type="password" class="form-control" id="price" placeholder="กรอกรหัสผ่านเดิม" required="">
                                        </div>
                                        <label>กรอกรหัสผ่านใหม่</label>
                                        <div class="form-group">
                                            <input name="newpass" type="password" class="form-control" id="price" placeholder="กรอกรหัสผ่านใหม่" required="">
                                        </div>
                                        <div class="form-group">
                                            <input name="connewpass" type="password" class="form-control" id="price" placeholder="กรอกรหัสผ่านใหม่อีกครั้ง" required="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                                        <button class="btn btn-primary ">บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--    aduser -->
                    <div class="modal fade" id="aduser" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel">เพิ่มพนักงาน</h2>
                                </div>
                                <form action="../login/save_register_1.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <label for="rest">ชื่อร้านอาหาร</label>
                                                <input type="text" class="form-control" name="rest" id="name" value="<?php echo $_SESSION["Restname"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <label for="rest">ชื่อผู้ใช้</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="กรุณากรอกชื่อผู้ใช้">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" >Email address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="กรุณากรอก Email address" >
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <label for="password" >Password</label>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="กรุณากรอก Password" >

                                                <label for="ConfirmPassword" >Confirm password</label>
                                                <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPasswordsword" placeholder="กรุณากรอก Confirm password" >
                                                <input name="status" type="hidden" value="2">
                                            </div>
                                        </div> 


                                    </div> <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">กลับ</button>
                                        <button class="btn btn-primary ">บันทึก</button>
                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>

                    <!--      del -->
                    <div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    คุณแน่ใจหรอว่าจะลบ?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                                    <a class="btn btn-primary" href="../login/check_delportf_2.php">ใช่</a>
                                </div>

                            </div>
                        </div>
                    </div>


                    </body>
                    </html>
