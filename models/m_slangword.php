<?php
class Slangword{

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function select_slangword($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM slangword";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function edit($sql) {
		$db = $this->mysqli->conn;
		$db->query($sql) or die($db->error);
	}

	public function tambah($slangword, $kata_asli){
		$db = $this->mysqli->conn;
		$db->query("INSERT INTO slangword VALUES ('', '$slangword', '$kata_asli')") or die($db->error);
	}

	public function hapus($id_slangword){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM slangword WHERE id_slangword = '$id_slangword'") or die($db->error);
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>