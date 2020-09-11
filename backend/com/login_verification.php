<?php
$response = array();

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		$response['error'] = true;
		$response['message'] = "Error";

		//echo json_encode($response);
		exit();
	}

	require_once (dirname(dirname(__FILE__)) . "/db/Database.php");
	include_once(dirname(dirname(__FILE__)) . "/operations/Select.php");

	$db = new Database();
	$dbcon=$db->db_connect();

	if(!$dbcon){
		$response['error'] = true;
		$response['message'] = "Database Connection Error";

		//echo json_encode($response);
		exit();
	}

	// begina

	if(!isset($_POST['email']) || !isset($_POST['password'])){
		$response['error'] = true;
		$response['message'] = "Data Missing!";

		//echo json_encode($response);
		exit();
	}

	// get data from url

	$email = $dbcon->real_escape_string($_POST['email']);
	$password = $dbcon->real_escape_string($_POST['password']);

	$select = new Select($dbcon);

	$result = $select->verify_user($email, $password);

	$success = $result->num_rows==1;

	//$response['error'] = !$success;
	//$response['message'] = $success?"Login Successful!":"Login Failed!";
        $r=array();
	if($success){
		$r[]= $result->fetch_array(MYSQLI_ASSOC);
$response['userinfo']=$r;
echo json_encode($response);
	}

	else 
{
   echo "error";
}

?>
