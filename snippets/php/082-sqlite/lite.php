<?php

class Lite
{
	private $path = "";
	private $db = null;

	function __construct($path)
	{
		$this->path = $path;
	}

	function open()
	{
		if($this->db !== null){
			return;
		}

		$this->db = new SQLite3($this->path);
	}

	function close()
	{
		if($this->db === null){
			return;
		}
		$this->db->close();
		$this->db = null;
	}

	function tableCreate($tableName, $columns = [])
	{

		$columnList = implode(', ', $columns);

		$query = "CREATE TABLE IF NOT EXISTS $tableName (
		    id INTEGER PRIMARY KEY AUTOINCREMENT, 
		    $columnList
		)";

		$this->exec($query);
	}

	function exec($query, $columns = [])
	{
		if($this->db === null){
			return;
		}

		$stmt = $this->db->prepare($query);

		foreach ($columns as $key => $value) {
			$stmt->bindValue($key, $value, SQLITE3_TEXT);
		}

		$result = $stmt->execute();

		if (!$result) {
			throw new Exception("SQLite Error: " . $db->lastErrorMsg());
		}

		return $result;
	}

	function query($query, $columns = [])
	{

		if($this->db === null){
			return;
		}

		$stmt = $this->exec($query, $columns);

		$data = [];

		while ($row = $stmt->fetchArray(SQLITE3_ASSOC)) {	
			$data[] = $row;
		}

		return $data;
	}

	function lastId() {
		if($this->db === null){
			return null;
		}

		return $this->db->lastInsertRowID();
	}

	function insert($tableName, $columns = [])
	{

		if($this->db === null){
			return;
		}

		$data = [];
		$columnNames = [];
		$columnPlaceholders = [];
		foreach ($columns as $key => $value) {
			$data["$key"] = $value;
			$columnNames[] = "$key";
			$columnPlaceholders[] = ":$key";
		}

		$columnNamesString = implode(" , ", $columnNames);
		$columnPlaceholdersString = implode(" , ", $columnPlaceholders);

		$query = "INSERT INTO $tableName ($columnNamesString) VALUES ($columnPlaceholdersString)";

		return $this->exec($query, $data);
	}

	function delete($tableName, $id = null)
	{
		if($id === null){
			return;
		}

		return $this->query("DELETE FROM $tableName WHERE id = :id", [
			'id'=>$id, 
		]);
	}

	function select($tableName, $columns = [])
	{
		if($this->db === null){
			return;
		}

		$data = [];
		$whereConditions = [];
		foreach ($columns as $key => $value) {
			$whereConditions[] = "$key = :$key";
			$data["$key"] = $value;
		}

		$whereConditionsString = implode(" AND ", $whereConditions);

		if($whereConditionsString === ""){
			$whereConditionsString = "true";
		}

		$query = "SELECT * FROM $tableName where $whereConditionsString";

		return $this->query($query, $data);
	}
}
