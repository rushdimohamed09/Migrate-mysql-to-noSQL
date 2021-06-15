<?php
include("connections.php");

function select($table, $lim_st, $lim_end){
	global $conn;
	$stmt = $conn->prepare("SELECT id FROM $table order by id ASC LIMIT ?, ?");
	$stmt->bind_param("ii", $lim_st, $lim_end);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows === 0) {return false;}else{
		while($row = $result->fetch_assoc()) {
			if(isset($row['id'])){
				update_data_as_json($table, $row['id'], select_data_as_json($table, $row['id']));
			}
		}
	}
	$stmt->close();
}

function select_data_as_json($table, $id) {
	global $conn;
	$data=array();
	$arr = [];
	
	$col_list="col_1, col_2, col_3, col_4, col_5";//the table column list that need to be in JSON object 
	$stmt = $conn->prepare("SELECT $col_list FROM $table WHERE id=?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	while($row = $result->fetch_assoc()) {
		$res = array_filter($row);// if there is any null values remove them
		$arr[] = $res;
	}
	if(isset($arr)){
		$a=str_replace('[','',json_encode($arr));
		$a=str_replace(']','',$a);
	}
	$stmt->close();
	return ($a);
}

function update_data_as_json($table, $id, $data) {
	global $conn;
	$stmt = $conn->prepare("UPDATE $table SET all_data = ? WHERE all_data IS null AND id = ?");
	$stmt->bind_param("si", $data, $id);
	$stmt->execute();
	echo ($stmt->affected_rows === 0) ? 'No rows updated<br>': 'updated<br> ';
	$stmt->close();
}
?>