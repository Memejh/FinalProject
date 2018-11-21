<?php
include '../function/navbar.php';
$navbar = new navbar();
include '../function/conn.php';
include '../function/style.php';
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
  <body onload="window.print()">


        <?php $seesion = 'menu'; ?>      
        <?php div('container menuXX'); ?>
        <?php $navbar->navbarOpen($seesion) ?>
        <div class="col-sm-12 " style="margin-top:60px">
            <div class="col-sm-1"></div>
            <div class="col-sm-8"><h2>เมนูอาหาร</h></div>
            <div class="col-sm-3"><h2>โต๊ะ</h2></div>
                    
            <div class="col-sm-12"></div>
            
                    
            <div class="col-sm-12">
                <center><h4>
                <input type="checkbox">
                <label>ทานที่ร้าน</label>
                <input type="checkbox">
                <label>กลับบ้าน</label>
                </center></h4>
            </div>
   
       <div class="col-sm-1"></div> 
       <div class="col-sm-10">
            <?php
$perpage = 50;
 $c=1;
 if (isset($_GET['page'])) {
 $page = $_GET['page'];
    $i = 1;
    $j = $page *50 - 50;
    $c = $i + $j;
 } else {
 $page = 1;
 }
 
 $start = ($page - 1) * $perpage;
 
 $sql = "select * from menu limit {$start} , {$perpage} ";
 $query = mysqli_query($conn, $sql);
 {
                ?>
            
                <table class="table table-striped">
                    <thead>
                        <tr>   
                            <th>รหัส</th>
                            <th>ชื่ออาหาร</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>หมายเหตุ</th>
                        </tr>
                    </thead>
                    <tbody>
                                         

                        <?php
                    }
 while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr> 
                            <td><?php echo $result['key_menu'];?></td>
                            <td><?php echo $result['name_menu']; ?></td>
                            <td><?php echo $result['price_menu']; ?></td>
                            <td></td>
                            <td></td>

                        </tr>
                        
                    <?php }
                    ?>
                </tbody>
            </table>
            <?php
            $sql2 = "select * from menu ";
            $query2 = mysqli_query($conn, $sql2);
            $total_record = mysqli_num_rows($query2);
            $total_page = ceil($total_record / $perpage);
            ?>
        </div>
<!--       <div class="col-sm-1"></div>
       
       <div class="col-sm-7"></div>
       <div class="col-sm-5"><h2>รวม</h2></div>-->

    
        </div>

</body>
</html>
