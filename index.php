<?php
  ob_start();
  require_once('config/koneksi.php');
  require_once('models/database.php');
  $connection = new Database($host, $user, $pass, $database);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/sweetalert2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/dataTables/datatables.min.css">
	<title>Similarity Checker</title>
</head>
<body>
	<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span><em>Close</em></span>
  </a>
  <div class="logo">
   Tugas Akhir - Text Mining - Similarity Checker
  </div>
</div>
<div class="sidebar">
  <ul>
    <li><a href="?page=dashboard"><i class="fa fa-tachometer"></i><span>Beranda</span></a></li>
    <li><a href="?page=uploaddokumen"><i class="fa fa-upload"></i><span><em>Upload Document</em></span></a></li>
    <li><a href="?page=filedokumen"><i class="fa fa-file-pdf-o"></i><span><em>Document File</em></span></a></li>
    <li><a href="?page=preprocessing"><i class="fa fa-file-text"></i><span><em>Preprocessing</em></span></a></li>
    <li><a href="?page=similarity"><i class="fa fa-book"></i><span><em>Similarity</em></span></a></li>
</div> 
<div id="page-wrapper">
<?php
    if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
	include "views/dashboard.php";
	} else if(@$_GET['page'] == 'uploaddokumen') {
    include "views/uploaddokumen.php";
  } else if(@$_GET['page'] == 'filedokumen') {
    include "views/filedokumen.php";
  } else if(@$_GET['page'] == 'preprocessing') {
    include "views/preprocessing.php";
  } else if(@$_GET['page'] == 'similarity') {
    include "views/similarity.php";
  }
?>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/style.js"></script>
<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="assets/DataTables/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#datatables').DataTable();
  } );
</script>
</body>
</html>