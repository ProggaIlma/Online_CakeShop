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

	// begina


	if(!isset($_POST['cakeno']) || !isset($_POST['customerno']) || !isset($_POST['orderdescription'])
|| !isset($_POST['orderdate']) || !isset($_POST['delivarydate']) ){
		$response['error'] = true;

		$response['message'] = "Data Missing!";

		echo json_encode($response);
		exit();
	}

	// get data from url
	$cakeno = $dbcon->real_escape_string($_POST['cakeno']);
	$customerno = $dbcon->real_escape_string($_POST['customerno']);
	$orderdescription = $dbcon->real_escape_string($_POST['orderdescription']);
  $orderdate = $dbcon->real_escape_string($_POST['orderdate']);
  $delivarydate = $dbcon->real_escape_string($_POST['delivarydate']);

                 if($orderdescription==null||$delivarydate==null)
                {
                $response['message']="Please Enter all the required information";
                echo json_encode($response);
                exit();
                }
	$insert = new Insert($dbcon);
	$result = $insert->insert_cakeorder($cakeno,$customerno,$orderdescription,
   $orderdate, $delivarydate);

	$response['error'] = !$result;
	$response['message'] = $result?"Inserted":"Failed";

	echo json_encode($response);

?>
