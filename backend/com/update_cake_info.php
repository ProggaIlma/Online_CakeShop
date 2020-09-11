<?php
$response = array();

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		$response['error'] = true;
		$response['message'] = "Error";

		echo json_encode($response);
		exit();
	}
	require_once (dirname(dirname(__FILE__)) . "/db/Database.php");
	include_once(dirname(dirname(__FILE__)) . "/operations/Update.php");

	$db = new Database();
	$dbcon=$db->db_connect();

	if(!$dbcon){
		$response['error'] = true;
		$response['message'] = "Database Connection Error";

		echo json_encode($response);
		exit();
	}

	// begina

	if(!isset($_POST['cakedescription']) || !isset($_POST['cakeprice']) || !isset($_POST['stock'])
|| !isset($_POST['cakeno']) ) {
		$response['error'] = true;
		$response['message'] = "Data Missing!";

		echo json_encode($response);
		exit();
	}

	// get data from url
	$cakedescription = $dbcon->real_escape_string($_POST['cakedescription']);
	$cakeprice = $dbcon->real_escape_string($_POST['cakeprice']);
  $stock = $dbcon->real_escape_string($_POST['stock']);
  $cakeno = $dbcon->real_escape_string($_POST['cakeno']);

	$update = new Update($dbcon);

	$result = $update->update_cake($cakedescription,$cakeprice,$stock,$cakeno);

	$response['error'] = !$result;
	$response['message'] = $result?"Updated":"Failed";

	echo json_encode($response);

?>
