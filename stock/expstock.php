<?php
session_start();
include '../function/navbar.php'; $navbar = new navbar();
include '../function/conn.php'; 
include '../function/style.php'; 
include '../style.php'; 
 ?>
<html>
    <head>
  
   <?php  
   
   
   head('Local Restaurant Management System') ;
            headcss();
            menucss();
            js();?> 
    </head>
    <body>
        
        
     <?php  $seesion = $_SESSION["Status"] ;  ?>
       
        <?php div('container menuXX') ;?>
        <?php $navbar->navbarOpen($seesion) ?>
            <div class="col-sm-12 " style="margin-top:60px">
                <div class="col-sm-1"></div>
                <div class="col-sm-10"><h2>วัตถุดิบใกล้หมด</h2><hr></div>
                </div>
        <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    
                 

 
 <nav>
 <ul class="pagination">
 
 </ul>
 </nav>
 </div>

                    
         
        <?php _div();  ?>

    </body>
</html>