<?php
$response = array();

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		$response['error'] = true;
		$response['message'] = "Error";

		echo json_encode($response);
		exit();
	}

	require_once (dirname(dirname(__FILE__)) . "/db/Database.php");
	include_once(dirname(dirname(__FILE__)) . "/operations/Insert.php");

	$db = new Database();
	$dbcon=$db->db_connect();

	if(!$dbcon){
		$response['error'] = true;
		$response['message'] = "Database Connection Error";

		echo json_encode($response);
		exit();
	}

	//begina

		if(!isset($_POST['orderno']) || !isset($_POST['reviewdate']) || !isset($_POST['rating'])){
			$response['error'] = true;
			$response['message'] = "Data Missing!";

			echo json_encode($response);
			exit();

		}

		// get data from url

		$orderno = $dbcon->real_escape_string($_POST['orderno']);
		$reviewdate = $dbcon->real_escape_string($_POST['reviewdate']);
		$rating = $dbcon->real_escape_string($_POST['rating']);



		$insert = new Insert($dbcon);

		$result = $insert->insert_review($orderno,$reviewdate,$rating);

		// edit response

		echo json_encode($response);

	?>
