<?php
$con=mysqli_connect("localhost","root","anything","main_cakeshop");
$shopno=$_POST['shopno'];
$response=array();
$r=array();
$query="SELECT cake.cakedescription,cake.cakeno FROM cake INNER JOIN cakeorder ON cake.cakeno=cakeorder.cakeno WHERE cake.shopno=$shopno";
if($result=mysqli_query($con,$query))

{
while($row=mysqli_fetch_assoc($result)){

$r[]=$row;

}
$response['cakes']=$r;

    echo json_encode($response);
}
else
{
    echo "not successful";
}
?>
