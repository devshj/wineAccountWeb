<?
  require_once '../dbconn.php';

  $idx = $_POST['c_idx'];

  $conn = new DBC();

  try{
    $conn->DBI();

  //   $query = "UPDATE wine_customer SET cust_name='".$_POST['cname']."', phone_num='".$_POST['cphone']."', cust_age='".$_POST['cage']."'
	// where idx='".$POST['cidx']."'";

    $query = "UPDATE wine_customer SET cust_name='".$_POST['c_name']."',phone_num='".$_POST['c_phone']."',cust_age='".$_POST['c_age']."' where idx='".$idx."'";

    // $sql = mq("update a_ticketReviews set a_nick='".$_POST['a_nick']."',a_ticketTitle='".$_POST['a_ticketTitle']."',a_ticketContent='".$_POST['a_ticketContent']."' where a_ticketNo='".$idx."'");

  	$conn->DBQ($query);
  	$conn->DBE();

  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>

<script type="text/javascript">alert("수정 되었습니다.");

window.location.href="../../customer.php"</script>
