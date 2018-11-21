<?php
session_start();
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
        <?php $seesion = $_SESSION["Status"]; ?>
        <?php div('container menuXX'); ?>
        <?php
        @$nameU = $_POST["nameU"];
        @$nameR = $_POST["nameR"];
        @$email = $_POST["email"];
        $activate = $_POST["activate"];
        @$oldpass = $_POST["oldpass"];
        @$newpass = $_POST["newpass"];
        @$connewpass = $_POST["connewpass"];

        if ($activate == 1) {
            $sql = " UPDATE user SET  rest_user = '$nameR', name_user = '$nameU' ,email_user = '$email' WHERE id_user= '" . $_SESSION["UserID"] . "'";
            $querys = mysqli_query($conn, $sql);

            if ($querys) {
                $_SESSION["Name"] = $nameU;
                $_SESSION["Restname"] = $nameR;
                $_SESSION["Email"] = $email;
                echo '<br><br><br><center><img src="../img/t.png" style="width="300" height="300""></center>';
                echo '<center><h1 style="color:green;">แก้ไขข้อมูลสำเร็จ</h1><center><br><br><br>';
            } else {
                echo '<br><br><br><center><img src="../img/f.png" style="width="300" height="300""></center>';
                echo "<center><h1 style='color:red;'>Database Connect Failed : " . mysqli_connect_error() . '</h1><center><br><br><br>';
            }
        } elseif ($activate == 2) {
            $passSQL = "SELECT * FROM user WHERE id_user = " . $_SESSION["UserID"] . "";
            $qryPass = mysqli_query($conn, $passSQL);
            while ($result = mysqli_fetch_assoc($qryPass)) {
                if ($result['pass_user'] == $oldpass) {
                    if ($newpass == $connewpass) {
                        $sql = " UPDATE user SET  pass_user = '$newpass' WHERE id_user= '" . $_SESSION["UserID"] . "'";
                        $querys = mysqli_query($conn, $sql);
                        if ($querys) {
                            echo '<br><br><br><center><img src="../img/t.png" style="width="300" height="300""></center>';
                            echo '<center><h1 style="color:green;">แก้ไขข้อมูลสำเร็จ</h1><center><br><br><br>';
                        } else {
                            echo '<br><br><br><center><img src="../img/f.png" style="width="300" height="300""></center>';
                            echo '<center><h1 style="color:green;">ข้อมูลไม่ถูกต้อง กรุณากรอกข้อมูลใหม่</h1><center><br><br><br>';
                        }
                    }
                } else {
                    echo '<br><br><br><center><img src="../img/f.png" style="width="300" height="300""></center>';
                    echo "<center><h1 style='color:red;'>Database Connect Failed : " . mysqli_connect_error() . '</h1><center><br><br><br>';
                }
            }
        }
        ?>
        <meta http-equiv="refresh" content="2; url=../login/portf.php">