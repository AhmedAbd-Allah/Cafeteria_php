<?php
session_start();

if((!isset($_SESSION['email']))&& (!isset($_SESSION['password'])))
{
		echo "<script>window.location.href='index.php'</script>";
}
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
$success=0;
include('Order_Class.php');
print_r($_POST);
$Order= new Order();
$Order->insert_order($_POST['user_id'],$_POST['amount'],(int)$_POST['Room'],$_POST['Notes']);

$order_id=$Order->get_latest_order_id($_POST['user_id']);

include('Order_Product_Class.php');
print_r($_POST);
$Order_product=new Order_Product();

foreach ($_POST as $key => $value) {

	if(is_integer($key))
	{
		$Order_product->insert_order_product($order_id,$key,$value);
	}

}
if($_POST['admin']==1)
{
  echo "<script>window.location.href='Home_admin.php'</script>";

}
else
{
  echo "<script>window.location.href='Home_user.php'</script>";
}

?>
