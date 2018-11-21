<?php
include '../function/conn.php'; 
session_start();
//$name_user = $_POST['name'];
//$email_user = $_POST['email'];
//$pass_user = $_POST['password'];

	
	if(trim($_POST["rest"]) == "")
	{
		echo "<meta http-equiv='refresh' content='0;URL=../login/error_1.php'>";
		exit();	
	}
        if(trim($_POST["name"]) == "")
	{
		echo "<meta http-equiv='refresh' content='0;URL=../login/error_1.php'>";
		exit();	
	}
	
	if(trim($_POST["email"]) == "")
	{
		echo "<meta http-equiv='refresh' content='0;URL=../login/error_1.php'>";
		exit();	
	}	
		
	if($_POST["password"] != $_POST["ConfirmPassword"])
	{
		echo "<meta http-equiv='refresh' content='0;URL=../login/error_2.php'>";
		exit();
	}
	
	$strSQL = "SELECT * FROM user WHERE email_user = '". ($_POST['email'])."' ";
	$obj = mysqli_query($conn, $strSQL);
	$Result = mysqli_fetch_array($obj ,MYSQLI_ASSOC);
	if($Result)
	{
                echo "<meta http-equiv='refresh' content='0;URL=../login/error_3.php'>";
	}
	else
	{	
		
		$strSQL = "INSERT INTO user (rest_user,name_user,email_user,pass_user,status_user) 
                           VALUES ('".$_POST["rest"]."','".$_POST["name"]."','".$_POST["email"]."','".$_POST["password"]."','".$_POST["status"]."')";
		$obj = mysqli_query($conn, $strSQL);
		
//                $Uid = mysql_insert_id();
		echo "<meta http-equiv='refresh' content='0;URL=../login/complete.php'>";		
//
//		$strTo = $_POST["email"];
//		$strSubject = "Activate Member Account";
//		$strHeader = "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //
//		$strHeader .= "From: Local Restaurant Management System\nReply-To: Local Restaurant Management System";
//		$strMessage = "";
//		$strMessage .= "Welcome : ".$_POST["name"]."<br>";
//		$strMessage .= "=================================<br>";
//		$strMessage .= "Activate account click here.<br>";
//		$strMessage .= "http://lrms.hostmancs.com/login/activate.php?sid=".session_id()."&uid=".$Uid."<br>";
//		$strMessage .= "=================================<br>";
//		$strMessage .= "http://lrms.hostmancs.com<br>";
//
//		$flgSend = mail($strTo,$strSubject,$strMessage,$strHeader); 
	}

//	mysql_close();
        session_write_close();
?>