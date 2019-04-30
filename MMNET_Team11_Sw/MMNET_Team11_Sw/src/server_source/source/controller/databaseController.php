<?php 

class Database {
	private $host;// = "localhost";
	private $db;// = "museum";
	private $userName;// = "root";
	private $pass;// = "root";
	
	function __construct() {
		$string = file_get_contents("../configure.json");
		$json_obj = json_decode($string, true);
		foreach ($json_obj as $key => $val) {
		    $this->host = $val['host'];
			$this->db = $val['db'];
			$this->userName = $val['userName'];
			$this->pass = $val['pass'];
		}
	}
	
	private function connect(){
		$con = mysqli_connect($this->host,$this->userName, $this->pass, $this->db);
		if(mysqli_connect_errno()){
			return mysqli_connect_error();
		}
		return $con;
	}
	
	public function getAll($query){
		$con = $this->connect();
		if(!$con){
			return $con;
		} else {
			$data = FALSE;
			$result = mysqli_query($con, $query);
			if(!$result){
				return $result;
			}
			while($row = mysqli_fetch_row($result)){
				$data = $row;
			}
			return $data;
		} 
	}
	public function getRowCount($query){
		$con = mysqli_connect($this->host,$this->userName, $this->pass, $this->db);
		if(mysqli_connect_errno()){
			return mysqli_connect_error();
		} else {
			
			$result = mysqli_query($con, $query);
			if(!$result){
				return $result;
			}
			while($row=mysqli_fetch_array($result)){
				echo "row count". $result;
				$numrows = $numrows + 1;
			}
			return $numrows;
		}
		return 0;
	}
	public function getDataForGallery($query){
		$con = mysqli_connect($this->host,$this->userName, $this->pass, $this->db);
		if(mysqli_connect_errno()){
			return mysqli_connect_error();
		} else {
			
			$result = mysqli_query($con, $query);
			if(!$result){
				return $result;
			}
			else {
				$i=0;
				$data = array();
				while ($row = mysqli_fetch_array($result)){
					$data[$i]["id"] = $row["artifact_id"];
					$data[$i]["name"] = $row["name"];
					$data[$i]["path"] = $row["high"];
					$data[$i]["desc"] = $row["description"];
					$i=$i+1;
				}
				return $data;
			}
		}
	}
	public function getDataForUpdate($query){
		$con = $this->connect();
		if(!$con){
			return $con;
		} else {
			$result = mysqli_query($con, $query);
			if(!$result){
				return $result;
			}
			$i=0;
			$data = array();
			while ($row = mysqli_fetch_array($result)){
				$data[$i]["id"] = $row["artifact_id"];
				$data[$i]["name"] = $row["name"];
				$data[$i]["path"] = $row["high"];
				$data[$i]["hpath"] = $row["high"];
				$data[$i]["lpath"] = $row["low"];
				$data[$i]["desc"] = $row["description"];
				$i=$i+1;
			}
			return $data;
		}
	}
	public function login($query){
		$con = $this->connect();
		if(!$con){
			return $con;
		} else {
			$result = mysqli_query($con, $query);
			if(!$result){
				return $result;
			}
			while($row = mysqli_fetch_row($result)){
				return $row[0];
			}
		} 
		return $con;
	}
	public function get_current_id($tableName){
		$query = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '". $this->db ."' AND TABLE_NAME = '". $tableName. "'";
		$con = $this->connect();
		$result_set = array();
		if(!$con){
			return $con;
		} else {
			$result = mysqli_query($con, $query);
			if(!$result){
				return $result;
			}
			$i=0;
			while($row=mysqli_fetch_array($result)){
				$result_set[$i] = $row[0] - 1;
				$i++;
			}
			return $result_set;
		} 
	}
	public function add($insertQuery){
		$con = mysqli_connect($this->host,$this->userName, $this->pass, $this->db);
		if(mysqli_connect_errno()){
			return mysqli_connect_error();
		}
		
		$status = mysqli_query($con, $insertQuery);
		if(!$status){
			return $status;
		}
		
		return true;
	}
	public function update($update_query){
		$con = $this->connect();
		if(!$con){
			return $con;
		}
		$status = mysqli_query($con, $update_query);
		if(!$status){
			return $status;
		}
		return true;
	}
	public function delete($delete_query){
		$con = $this->connect();
		if(!$con){
			return $con;
		}
		$status = mysqli_query($con, $delete_query);
		if(!$status){
			return $status;
		}
		return true;
	}
}
?>