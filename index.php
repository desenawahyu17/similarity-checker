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
	<title>Similarity Checker</title>
</head>
<body>
	<div class="header">
  <a href="#" id="menu-action">
    <i class="fa fa-bars"></i>
    <span>Close</span>
  </a>
  <div class="logo">
    Similarity Checker
  </div>
</div>
<div class="sidebar">
  <ul>
    <li><a href="?page=dashboard"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
    <li><a href="?page=filedokumen"><i class="fa fa-upload"></i><span>Document File</span></a></li>
    <li><a href="?page=preprocessing"><i class="fa fa-file-text"></i><span>Preprocessing</span></a></li>
    <li><a href="?page=similarity"><i class="fa fa-book"></i><span>Similarity</span></a></li>
</div> 
<div id="page-wrapper">
<?php
    if(@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
	include "views/dashboard.php";
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
</body>
</html>