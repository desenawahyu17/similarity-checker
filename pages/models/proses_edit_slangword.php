<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/m_slangword.php";
$connection = new Database($host, $user, $pass, $database);
$slangword = new slangword($connection);

$id_slangword = $_POST['id_slangword'];
$data_slangword = $_POST['slangword'];
$kata_asli = $_POST['kata_asli']; 
// var_dump($_POST); die();
try{
    $slangword->edit("UPDATE slangword SET slangword = '$data_slangword', kata_asli = '$kata_asli' WHERE id_slangword = '$id_slangword'");
	echo "<script>window.location='?page=slangword'</script>";
}
catch(exception $e) {
    echo '<pre>';
    var_dump($string);
    echo '</pre>';
}
?>