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

	if(!isset($_POST['shopno']) || !isset($_POST['shopname']) || !isset($_POST['shopcontact'])
|| !isset($_POST['shopaddress']) ) {
		$response['error'] = true;
		$response['message'] = "Data Missing!";

		echo json_encode($response);
		exit();
	}

	// get data from url
	$shopno = $dbcon->real_escape_string($_POST['shopno']);
	$shopname = $dbcon->real_escape_string($_POST['shopname']);
  $shopcontact = $dbcon->real_escape_string($_POST['shopcontact']);
  $shopaddress = $dbcon->real_escape_string($_POST['shopaddress']);

	$update = new Update($dbcon);

	$result = $update->update_shop($shopno,$shopname,$shopcontact,$shopaddress);

	$response['error'] = !$result;
	$response['message'] = $result?"Updated":"Failed";

	echo json_encode($response);

?>
