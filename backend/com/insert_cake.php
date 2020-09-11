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

		//echo json_encode($response);
		exit();
	}

	// begina


	if(!isset($_POST['cakedescription']) || !isset($_POST['cakeprice']) || !isset($_POST['stock'])
|| !isset($_POST['shopno']) || !isset($_POST['image'])  ){
		$response['error'] = true;
		$response['message'] = "Data Missing!";

		echo json_encode($response);
		exit();
	}

	// get data from url

	$cakedescription = $dbcon->real_escape_string($_POST['cakedescription']);
	$cakeprice = $dbcon->real_escape_string($_POST['cakeprice']);
  $stock = $dbcon->real_escape_string($_POST['stock']);
  $shopno = $dbcon->real_escape_string($_POST['shopno']);
	$image = $_POST['image'];

	$insert = new Insert($dbcon);

	$cakeno = $insert->insert_cake($cakedescription,$cakeprice,$stock,$shopno);
	$result = $cakeno>0;
	$response['error'] = !$result;
	$response['message'] = $result?"Inserted":"Failed";

	if($result){
		$decodedImage = base64_decode($image);
   //echo $decodedImage;
    //upload the image

		$target = "uploads";
		if(!file_exists($target)){
			mkdir($target, 0777, true);
			//echo "mkdir";
		}
		$target = $target."/".$shopno."_".$cakeno.".jpg";
//echo $target;
    if(file_put_contents($target, $decodedImage)){
			echo "success";
    }else{
			echo "failed to put image";
    }
	}

	echo json_encode($response);

?>
