<?php
    class Update{
        private  $dbcon=null;
				private  $logged_in=false;

				public function __construct($dbcon){

					$this->dbcon=$dbcon;

				}

        public function change_password($email, $old_password, $new_password)
        {
          $sql = "Update user
          SET password = '?'
          WHERE (email = '?' AND password = '?')";

          $stmt = $this->dbcon->prepare($sql);
    			$stmt->bind_param("sss", $new_password, $email, $old_password);
    			$stmt->execute();

    			return $stmt->affected_rows==1;
        }

        public function update_cake($cakedescription,$cakeprice,$stock,$cakeno){
          $sql = "Update cake
          SET cakedescription = ?, cakeprice=?, stock=?
          WHERE (cakeno = ?)";

          $stmt = $this->dbcon->prepare($sql);
          $stmt->bind_param("siii", $cakedescription,$cakeprice,$stock,$cakeno);
          $stmt->execute();

          return $stmt->affected_rows==1;
        }

        public function update_shop($shopno,$shopname,$shopcontact,$shopaddress){
          $sql = "Update shop
          SET shopname = ?, shopcontact=?, shopaddress=?
          WHERE (shopno = ?)";

          $stmt = $this->dbcon->prepare($sql);
          $stmt->bind_param("sssi",$shopname,$shopcontact,$shopaddress,$shopno);
          $stmt->execute();
          var_dump($stmt);

          return $stmt->affected_rows==1;
        }


}
?>
