<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/m_stopword.php";
$connection = new Database($host, $user, $pass, $database);
$stopword = new stopword($connection);

$id_stopword = $_POST['id_stopword'];
$data_stopword = $_POST['stopword'];
// var_dump($_POST); die();
try{
    $stopword->edit("UPDATE stopword SET stopword = '$data_stopword' WHERE id_stopword = '$id_stopword'");
	echo "<script>window.location='?page=stopword'</script>";
}
catch(exception $e) {
    echo '<pre>';
    var_dump($string);
    echo '</pre>';
}
?>