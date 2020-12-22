<?php
class preprocessing{

	private $mysqli;

	function __construct($conn){
		$this->mysqli = $conn;
	}

	public function select_preprocessing($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM preprocessing";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function select_slangword($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM slangword";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function select_stopword($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM stopword";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function select_dokumen($id = null){
		$db	= $this->mysqli->conn;
		$sql = "SELECT * FROM document";
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}

	public function simpan_preprocessing($id, $nim, $uploaddate, $file_size, $content){
		$db	= $this->mysqli->conn;
		$db->query("INSERT IGNORE preprocessing (id, nim, uploaddate, file_size, content) VALUE ('$id', '$nim', '$uploaddate', '$file_size', '$content')") or die($db->error);
	}

	public function hapus($id){
		$db = $this->mysqli->conn;
		$db->query("DELETE FROM preprocessing WHERE id = '$id'") or die($db->error);
	}

	function __destruct() {
		$db = $this->mysqli->conn;
		$db->close();
	}
}
?>