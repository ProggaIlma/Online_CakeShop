<?php

$response = array();

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		$response['error'] = true;
		$response['message'] = "Error";

		echo json_encode($response);
		exit();
	}

  $name = $dbcon->real_escape_string($_POST['name']);
  $image = $dbcon->real_escape_string($_POST['image']);


    //decode the image
    $decodedImage = base64_decode($image);
  //  echo $decodedImage;
    //upload the image
    if(file_put_contents("images/".$name, $decodedImage)){

    }else{
      
    }


 ?>
