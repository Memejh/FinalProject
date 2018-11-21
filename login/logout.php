<?php 
include '../function/conn.php'; 
//session_start();
//
//unset ( $_SESSION['id_user'] );
//unset ( $_SESSION['email_user'] );
//unset ( $_SESSION['status_user'] );
//session_destroy();
//
//echo "<meta http-equiv='refresh' content='0;URL=../index.php'>"


	session_start();
	session_destroy();
	header("location:../index.php");

?>
