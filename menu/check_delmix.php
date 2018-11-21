<html>
<head>

        <?php
        head('Local Restaurant Management System');
        headcss();
        menucss();
        js();
        ?> 
    </head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$strCustomerID = $_GET["id_stock"];
         $sql = "DELETE * FROM (((menu inner join admixture on menu.id_menu = admixture.id_menu_adm)"
                            . "inner join stock on admixture.id_stock_adm = stock.id_stock )"
                            . "inner join unit on admixture.id_unit_adm = unit.id_unit)"
                            . "WHERE id_menu_adm= " . $strid . " ";
                    $query = mysqli_query($conn, $sql);
	

	if(mysqli_affected_rows($conn)) {
		 echo "Record delete successfully";
	}

	mysqli_close($conn);
?>
</body>
</html>