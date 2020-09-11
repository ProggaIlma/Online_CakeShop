<?php

class Insert {

	private  $dbcon=null;

	public function __construct($dbcon){
		$this->dbcon=$dbcon;
	}

	public function insert_cakeshop($shopname,$userno,$shopcontact,$shopaddress){

			$sql = "INSERT INTO shop (shopname, userno, shopcontact, shopaddress) VALUES (?,?,?,?)";

			$stmt = $this->dbcon->prepare($sql);
			$stmt->bind_param("siss", $shopname,$userno,$shopcontact,$shopaddress);
			$stmt->execute();

			return $stmt->affected_rows==1;
	}

	public function insert_registration($username,$email,$password,$contact,$address){

			$sql = "INSERT INTO users (username,email,password,contact,address) VALUES (?,?,?,?,?)";

			$stmt = $this->dbcon->prepare($sql);
			$stmt->bind_param("sssss", $username,$email,$password,$contact,$address);
			$stmt->execute();
			//var_dump($stmt);

			return $stmt->affected_rows==1;
	}

	public function insert_review($orderno,$reviewdate,$rating){

			$sql = "INSERT INTO review (orderno,reviewdate,rating) VALUES (?,?,?,)";

			$stmt = $this->dbcon->prepare($sql);
			$stmt->bind_param("sss", $orderno,$reviewdate,$ratings);
			$stmt->execute();

			return $stmt->affected_rows==1;
	}

	public function insert_cake($cakedescription,$cakeprice,$stock,$shopno){

			$sql = "INSERT INTO cake (cakedescription,cakeprice,stock,shopno) VALUES (?,?,?,?)";

			$stmt = $this->dbcon->prepare($sql);
			$stmt->bind_param("siii", $cakedescription,$cakeprice,$stock,$shopno);
			$stmt->execute();
			

			return $stmt->insert_id;
	}

	public function insert_cakeorder($cakeno,$customerno,$orderdescription,
   $orderdate, $delivarydate){

			$sql = "INSERT INTO cakeorder (cakeno,customerno,orderdescription,orderdate,
			delivarydate) VALUES (?,?,?,?,?)";

			$stmt = $this->dbcon->prepare($sql);
			$stmt->bind_param("iisss", $cakeno,$customerno,$orderdescription,$orderdate, $delivarydate);
			$stmt->execute();

			return $stmt->affected_rows==1;
	}

}

  ?>
