<html lang="th">
    
 <?php  include './style.php';
        include './function/conn.php'; 
        include './function/style.php'; 
 
 ?>
<head>
<?php 
head('Local Restaurant Management System') ;
headcssindex();
headjs();
?>
</head>

<body>
    
<!--    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            </div>
        </div>
    </nav>-->

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Local Restaurant <br> Management System</h1>
                <hr class="light">
                <p>ระบบการจัดการคลังวัตถุดิบร้านอาหารตามสั่งขนาดเล็ก</p>
                <a style="font-size: 28px;" class="btn btn-default btn-xl page-scroll" data-toggle="modal" href="#login"><b>เข้าสู่ระบบ</b></a><br><br>
                <a class="btn btn-default" data-toggle="modal" href="#regis"><b>สมัครสมาชิก</b></a>
            </div>

        </div>
    </header>



<!--          login-->
            <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

              <div class="modal-header">
               <h2 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบ</h2>
            
             </div>
           
                        <div class="modal-body">
                             <div class="form-group">
                                 <form action="./login/check_login.php" method="post">
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Email address" >
              
            </div>
              
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" >

            </div>
              <button class="btn btn-primary btn-block" type="submit">เข้าสู่ระบบ</button>
               

          </form>
                   </div>
                        </div>

                    </div>
                </div>
            </div>


<!--          regis-->
            <div class="modal fade" id="regis" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

              <div class="modal-header">
               <h2 class="modal-title" id="exampleModalLabel">สมัครสมาชิก</h2>
            
             </div>
           
                        <div class="modal-body">
                             <div class="form-group">
                                 <form action="./login/save_register.php" method="post">
            <div class="form-group">
              <div class="form-row">
                  <label for="rest">ชื่อร้านอาหาร</label>
                  <input type="text" class="form-control" name="rest" id="name" placeholder="กรุณากรอกชื่อร้าน">
       
                
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
                  <input name="status" type="hidden" value="1">
              </div>
            </div> 
               <button class="btn btn-primary btn-block" type="submit">สมัครสมาชิก</button>

          </form>
        </div>
      </div>
           

                    </div>
                </div>
            </div>





















    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>
  

</body>

</html>
