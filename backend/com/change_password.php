<?php
$response = array();

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		$response['error'] = true;
		$response['message'] = "Error";

		echo json_encode($response);
		exit();
	}

	require_once (dirname(dirname(__FILE__)) . "/db/Database.php");
	include_once(dirname(dirname(__FILE__)) . "/operations/Select.php");

	$db = new Database();
	$dbcon=$db->db_connect();

	if(!$dbcon){
		$response['error'] = true;
		$response['message'] = "Database Connection Error";

		echo json_encode($response);
		exit();
	}

  //begina

  if(!isset($_POST['password']) || !isset($_POST['email'])){
    $response['meassage'] = "DATA MISSING!";
    echo json_encode($response);
  }

  //get data from url

  $old_password = $dbcon-> real_escape_string($_POST['password']);
  $email = $dbcon-> real_escape_string($_POST['email']);
  $update = new Update($dbcon);
  $result = $update -> change_password($email, $password);
  $success = $result -> num_rows == 1;
  $response['error'] = !$success;
  $response['message'] = $success?"Found!":"Not Found!";
  if($success){
    $response['password'] = $result->fetch_array(MYSQLI_ASSOC);
  }

  echo json_encode($response);

  ?>
