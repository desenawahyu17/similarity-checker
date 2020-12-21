<?php
class Stopword{

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function select_stopword($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM stopword";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function edit($sql) {
		$db = $this->mysqli->conn;
		$db->query($sql) or die($db->error);
	}

	public function tambah($stopword){
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO stopword VALUES ('', '$stopword')") or die($db->error);
	}

	public function hapus($id_stopword){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM stopword WHERE id_stopword = '$id_stopword'") or die($db->error);
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>