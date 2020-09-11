<?php
$response = array();

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		$response['error'] = true;
		$response['message'] = "Error";

		echo json_encode($response);
		exit();
	}

	require_once (dirname(dirname(__FILE__)) . "/db/Database.php");

  require_once (dirname(dirname(__FILE__)) . "/operations/Select.php");

	$db = new Database();
	$dbcon = $db->db_connect();

	if(!$dbcon){
		$response['error'] = true;
		$response['message'] = "Database Connection Error";

		echo json_encode($response);
		exit();
	}


	$select = new Select($dbcon);

	$result = $select->get_cakeshops();

  $response['shops'] = $result;

	echo json_encode($response);

?>
