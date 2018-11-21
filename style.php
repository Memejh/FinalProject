<?php

function headcss(){
    echo ' 
    <link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/creative.css" rel="stylesheet">
<link href="../css/main.css" rel="stylesheet">';
}

function headjs(){
    echo '  <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>';
}

function js(){
    echo '  <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- Theme JavaScript -->
    <script src="../js/creative.min.js"></script>';
}

function headcssindex(){
       echo ' 
    <link href="css/bootstrap.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
<link href="css/creative.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
';
}

function head($tittle){echo' <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>'.$tittle.'</title>';}
 function menucss(){echo '<link href="../css/menu.css" rel="stylesheet">';}
