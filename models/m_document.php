<?php
class dokumen{

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function tampil($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT nim,uploaddate,file_size,content FROM document";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>