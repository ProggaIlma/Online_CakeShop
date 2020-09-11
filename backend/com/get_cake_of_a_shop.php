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

	// begina

	if(!isset($_POST['shopno'])){
		$response['error'] = true;
		$response['message'] = "Data Missing!";

		echo json_encode($response);
		exit();
	}

	// get data from url
	$shopno = $dbcon->real_escape_string($_POST['shopno']);

	$select = new Select($dbcon);

  $result = $select-> cakes_of_shop($shopno);

  $success = sizeof($result)>0;

  //$response['error'] = !$success;
 // $response['message'] = $success?"Found!":"Not Found!";

  if($success){
    $response['cakes'] = $result;
echo json_encode($response);
  }
else
{echo "error";}
  

?>
