<?php
    //session_start();
    //include_once(dirname(__FILE__)."/Utility.php");

    class Select{
      private  $dbcon;

      public function __construct($dbcon){
        //$this->_validateUser();
        $this->dbcon=$dbcon;

      }

      public function verify_user($email, $password){

        $sql = "SELECT * FROM users WHERE email=? AND password=?";

        $stmt = $this->dbcon->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();



        $result = $stmt->get_result();

        return $result;

      }

      public function get_cakeshops(){

        $sql = "SELECT * FROM shop WHERE 1";

        $stmt = $this->dbcon->prepare($sql);

        $stmt->execute();
//var_dump($stmt);
        $databaserowarray = $stmt->get_result();

        $phparray = array();

        while($row=$databaserowarray->fetch_array(MYSQLI_ASSOC)){
          $phparray[] = $row;
        }

        return $phparray;

      }

      public function get_cake(){

        $sql = "SELECT * FROM cake WHERE 1";

        $stmt = $this->dbcon->prepare($sql);

        $stmt->execute();

        $databaserowarray = $stmt->get_result();

        $phparray = array();

        while($row=$databaserowarray->fetch_array(MYSQLI_ASSOC)){
          $phparray[] = $row;
        }

        return $phparray;

      }

      public function cake_info($cakeno){

        $sql = "SELECT * FROM cake WHERE cakeno=?";

        $stmt = $this->dbcon->prepare($sql);
        $stmt->bind_param("i", $cakeno);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;

      }

      public function shop_info($shopno){

        $sql = "SELECT * FROM shop WHERE shopno=?";

        $stmt = $this->dbcon->prepare($sql);
        $stmt->bind_param("i", $shopno);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result;

      }

      public function myshops_info($userno){

        $sql = "SELECT * FROM shop WHERE userno=?";

        $stmt = $this->dbcon->prepare($sql);
        $stmt->bind_param("i", $userno);
        $stmt->execute();

        $result = $stmt->get_result();

        $phparray = array();

        while($row=$result->fetch_array(MYSQLI_ASSOC)){
          $phparray[] = $row;
        }

        return $phparray;
      }

      public function myorders_info($userno){

        $sql = "SELECT * FROM cakeorder WHERE customerno=?";

        $stmt = $this->dbcon->prepare($sql);
        $stmt->bind_param("i",$userno);
        $stmt->execute();

        $result = $stmt->get_result();
        $phparray = array();

        while($row=$result->fetch_array(MYSQLI_ASSOC)){
          $phparray[] = $row;
        }

        return $phparray;

      }

      public function cakes_of_shop($shopno){

        $sql = "SELECT * FROM cake WHERE shopno=?";

        $stmt = $this->dbcon->prepare($sql);
        $stmt->bind_param("i",$shopno);
        $stmt->execute();

        $result = $stmt->get_result();
        $phparray = array();

        while($row=$result->fetch_array(MYSQLI_ASSOC)){
          $phparray[] = $row;
        }

        return $phparray;

      }

    }

?>
