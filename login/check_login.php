<?php

include '../function/conn.php';
session_start();
$email_user = $_POST['email'];
$pass_user = $_POST['password'];
//echo $email_user . " " . $pass_user . " ";
//$sql = "SELECT * FROM user WHERE email_user = '" . $email_user . "' 
//and pass_user = '" . $pass_user . "'";
//$objq = mysqli_query($conn, $sql);
$query = mysqli_query($conn, "SELECT * FROM user WHERE pass_user='$pass_user' AND email_user='$email_user'");
$result = mysqli_fetch_array($query);
//echo $result["id_user"];
if (!$result) {
   echo "<meta http-equiv='refresh' content='0;URL=../login/error.php'>";
} else {
    $_SESSION["UserID"] = $result["id_user"];
    $_SESSION["Status"] = $result["status_user"];
    $_SESSION["Restname"] = $result["rest_user"];
    $_SESSION["Name"] = $result["name_user"];
    $_SESSION["Email"] = $result["email_user"];
    $_SESSION["Pass"] = $result["pass_user"];
    


    session_write_close();
    //Admin
    if ($result["status_user"] == "1") {
       echo "<meta http-equiv='refresh' content='0;URL=../menu/menu.php'>";
    //User
    } elseif ($result["status_user"] == "2") {
    
        //  echo 'USER';
        //  echo $_SESSION["Status"];
// header("location:user_page.php");
       echo "<meta http-equiv='refresh' content='0;URL=../menu/menu.php'>";
    }
}
?>

