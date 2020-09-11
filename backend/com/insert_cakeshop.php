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

		if(!isset($_POST['shopname']) || !isset($_POST['userno']) || !isset($_POST['shopcontact'])
		|| !isset($_POST['shopaddress'])){
			$response['error'] = true;
			$response['message'] = "Data Missing!";

			echo json_encode($response);
			exit();

		}
               

		// get data from url

		$shopname = $dbcon->real_escape_string($_POST['shopname']);
		$userno = $dbcon->real_escape_string($_POST['userno']);
		$shopcontact = $dbcon->real_escape_string($_POST['shopcontact']);
		$shopaddress = $dbcon->real_escape_string($_POST['shopaddress']);

                 if($shopname==null||$shopcontact==null||$shopaddress==null)
                {
                $response['message']="Please Enter all the required information";
                echo json_encode($response);
                exit();
                }
		$insert = new Insert($dbcon);

		$result = $insert->insert_cakeshop($shopname,$userno,$shopcontact,$shopaddress);

		//$response['error']= !$result;
		//$response['message']=$result?" Successful":" Failed";

		echo "success";

	?>
