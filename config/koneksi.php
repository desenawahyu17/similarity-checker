<?php
$host = "localhost";
$user = "root";
$pass =  "";
$database ="plagiarisme";
$koneksi =mysqli_connect($host,$user,$pass,$database);
?>

<?php
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'plagiarisme');
$koneksi =mysqli_connect($host,$user,$pass,$database);
/**
 * $dbconnect : koneksi kedatabase
 */
$dbconnect = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
/**
 * Check Error yang terjadi saat koneksi
 * jika terdapat error maka die() // stop dan tampilkan error
 */
if ($dbconnect->connect_error) {
	die('Database Not Connect. Error : ' . $dbconnect->connect_error);
}