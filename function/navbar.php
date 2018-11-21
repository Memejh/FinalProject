<?php
include '../function/conn.php'; 

class navbar {

    function navbarOpen($status) {
        if ($status == '1') {
            ?>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                        <a class="navbar-brand"><?php echo $_SESSION["Restname"]; ?></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="../menu/menu.php">เมนูอาหาร</a></li>
                            <li><a href="../order/order.php">สั่งอาหาร</a></li>
                            <li><a href="../stock/stock.php?page=1">วัตถุดิบ</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">รายงานการขาย
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../stock/in.php">รายรับ</a></li>
                                    <li><a href="../stock/pay.php">รายจ่าย</a></li>
                                    <li><a href="../stock/graph.php">กราฟเปรียบเทียบ</a></li>
                                </ul>
                            </li>
<!--                            <li><a href="../stock/expstock.php">วัตถุดิบใกล้หมด</a></li>-->
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION["Name"] ?>
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../login/portf.php">ข้อมูลผู้ใช้</a></li>
                                    <li><a class="page-scroll" data-toggle="modal" href="#out">ออกจากระบบ</a></li>
                                </ul>
                            </li>
                        </ul>


                    </div></div>
            </nav> 
           
 
            
           
            
            
            <!--      out -->
            <div class="modal fade" id="out" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            คุณต้องการออกจากระบบหรือไม่?
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                            <a class="btn btn-primary" href="../login/logout.php">ใช่</a>
                        </div>

                    </div>
                </div>
            </div>
            
            
            <?php
        } elseif ($status == '2') {
            ?>
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                        </button>
                        <a class="navbar-brand"><?php echo $_SESSION["Restname"] ?></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><a href="../order/order.php">สั่งอาหาร</a></li>
                            <li><a href="../stock/stock.php?page=1">วัตถุดิบ</a></li>
<!--                            <li><a href="../stock/expstock.php">วัตถุดิบใกล้หมด</a></li>-->
                            
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $_SESSION["Name"] ?>
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../login/portf_2.php">ข้อมูลผู้ใช้</a></li>
                                    <li><a class="page-scroll" data-toggle="modal" href="#out">ออกจากระบบ</a></li>
                                </ul>
                            </li>
                        </ul>


                    </div></div>
            </nav>
            
      
            <!--      out -->
            <div class="modal fade" id="out" tabindex="-1" role="dialog" aria-labelledby="model" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            คุณต้องการออกจากระบบหรือไม่?
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                            <a class="btn btn-primary" href="../login/logout.php">ใช่</a>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
    }

}
?>
    