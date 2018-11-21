<?php
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
        

       
        <?php div('container menuXX') ;?>

<!--         <div class="col-sm-12 " style="margin-top:60px">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"><center><img src="../img/t.png" alt=""  width="300" height="300"/></center></div>
                  <div class="col-sm-4"></div>
                
                </div>
        -->
            <div class="col-sm-12 " style="margin-top:60px">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"><h2 style="color:red;"><center>ข้อมูลผิดพลาด</center></h2><hr></div>
                  <div class="col-sm-4"></div>
                </div>
        
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <a class="btn btn-primary btn-block" type="submit" href="javascript:history.back()">ตกลง</a>
<!--            <a class="btn btn-primary btn-block" href="login.php">สมัครสมาชิก</a>-->

</div>
          <div class="col-sm-5"></div>
     
 </tbody>
 </table>

 <nav>
 <ul class="pagination">
 
 </ul>
 </nav>
    </body>
</html>