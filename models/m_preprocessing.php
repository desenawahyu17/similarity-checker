<?php
class preprocessing{

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function tampil($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT nim,uploaddate,title,file_size,content FROM preprocessing";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>