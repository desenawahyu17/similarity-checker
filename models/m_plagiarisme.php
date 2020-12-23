<?php
class plagiarisme{

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function select_plagiarisme($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM plagiarisme";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function delete_plagiarisme($id){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM plagiarisme WHERE id = '$id'") or die($db->error);
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>