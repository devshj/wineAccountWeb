<?
  require_once '../dbconn.php';

  $conn = new DBC();

  try{
    $conn->DBI();

    $query = "insert into wine_in_out(order_code, product_code, in_out_cate, in_out_cnt, sup_price,
	                                  surtax, sale, proc_price, com_name, store_name, in_out_m, in_out_date, payment_State, in_out_ware) 
	values('".$_POST['order_code']."','".$_POST['product_code']."','".$_POST['in_out_cate']."','".$_POST['in_out_cnt']."'
	      ,'".$_POST['sup_price']."','".$_POST['surtax']."','".$_POST['sale']."','".$_POST['proc_price']."','".$_POST['com_name']."','".$_POST['store_name']."','".$_POST['in_out_m']."'
		  ,'".$_POST['in_out_date']."','".$_POST['payment_State']."','".$_POST['in_out_ware']."')";
	$conn->DBQ($query);
	$conn->DBE();
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>

<script type="text/javascript">alert("추가 되었습니다!");
window.location.href="../../customer.php"</script>
