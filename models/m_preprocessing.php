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

	public function tampil_slangword($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM slangword";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tampil_stopword($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM stopword";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function tampil_dokumen($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM document";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>