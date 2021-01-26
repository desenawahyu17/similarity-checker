<?php
class dokumen{

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function select_dokumen($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM document";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function select_id($id){
		$db	= $this->mysqli->conn;
		$sql = "SELECT location FROM document WHERE id = '$id'";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function delete_dokumen($id){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM document WHERE id = '$id'") or die($db->error);
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>