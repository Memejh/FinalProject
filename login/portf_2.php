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
     
   <?php    head('Local Restaurant Management System') ;
            headcss();
            menucss();
            js();?> 
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
        

        <form class="form-horizontal" method="post"><b>
              <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">ชื่อร้าน : <?php echo $_SESSION["Restname"]; ?></div>
              <div class="col-sm-2"></div>
              </div>
            
             <div class="form-group">
              <div class="col-sm-2"></div>
                <div class="col-sm-8">ชื่อผู้ใช้ : <?php echo $_SESSION["Name"]; ?></div>
                <div class="col-sm-2"></div>
             </div>
            
             <div class="form-group">
              <div class="col-sm-2"></div>
                <div class="col-sm-8">E-mail : <?php echo $_SESSION["Email"]; ?></div>
              <div class="col-sm-2"></div>
             </div>
          </form>
   
        
    </body>
</html>
