<?
  require_once '../dbconn.php';

  $conn = new DBC();

  try{
    $conn->DBI();

    $query = "insert into wine_order(order_code, product_code, order_cate, order_cnt, unit_price, sup_price, surtax, sale, all_price, com_name, store_name, m_name, input_date, due_date, order_state, ware_code, memo) 
	values('".$_POST['order_code']."','".$_POST['product_code']."','".$_POST['order_cate']."','".$_POST['order_cnt']."','".$_POST['unit_price']."','".$_POST['sup_price']."','".$_POST['surtax']."','".$_POST['sale']."',
	       '".$_POST['all_price']."','".$_POST['com_name']."','".$_POST['store_name']."','".$_POST['m_name']."','".$_POST['input_date']."','".$_POST['due_date']."','".$_POST['order_state']."','".$_POST['ware_code']."',
		   '".$_POST['memo']."')";
	$conn->DBQ($query);
	$conn->DBE();
  }
   catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
  }
?>