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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
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
    <li><a href="?page=slangword"><i class="fa fa-link"></i><span><em>Slangword</em></span></a></li>
    <li><a href="?page=stopword"><i class="fa fa-language"></i><span><em>Stopword</em></span></a></li>
    <li><a href="?page=preprocessing"><i class="fa fa-file-pdf-o"></i><span><em>Preprocessing</em></span></a></li>
    <li><a href="?page=plagiarisme"><i class="fa fa-book"></i><span><em>Similarity</em></span></a></li>
    <li><a href="?page=grafik"><i class="fa fa-area-chart"></i><span><em>Grafik</em></span></a></li>
</div> 
<div id="page-wrapper">
<?php
    if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
	include "views/dashboard.php";
	} else if(@$_GET['page'] == 'uploaddokumen') {
    include "views/uploaddokumen.php";
  } else if(@$_GET['page'] == 'slangword') {
    include "views/slangword.php";
  } else if(@$_GET['page'] == 'stopword') {
    include "views/stopword.php";
  } else if(@$_GET['page'] == 'preprocessing') {
    include "views/preprocessing.php";
  } else if(@$_GET['page'] == 'plagiarisme') {
    include "views/plagiarisme.php";
  } else if(@$_GET['page'] == 'getpreprocessing') {
    include "views/getpreprocessing.php";
  } else if(@$_GET['page'] == 'grafik') {
    include "views/grafik.php";
  }
?>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="assets/js/style.js"></script>
<script type="text/javascript" src="assets/js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('#datatables').DataTable();
  } );
</script>
</body>
</html>