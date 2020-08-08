<?
  require_once '../dbconn.php';

  $conn = new DBC();

  if(isset($_POST['date_from'])) {
    $date_from = $_POST['date_from'];
    $date = date('Y-m-d H:i:s');
  }
  if(isset($_POST['manager'])) {
    $manager = $_POST['manager'];
  }
  if(isset($_POST['company'])) {
    $company = $_POST['company'];
  }
  if(isset($_POST['warehouse'])) {
    $warehouse = $_POST['warehouse'];
  }
  if(isset($_POST['store'])) {
    $store = $_POST['store'];
  }
  if(isset($_POST['date_to'])) {
    $store = $_POST['date_to'];
  }
  if(isset($_POST['memo'])) {
    $memo = $_POST['memo'];
  }
  if(isset($_POST['product_code'])) {
    $product_code = $_POST['product_code'];
  }
  if(isset($_POST['product_name'])) {
    $product_name = $_POST['product_name'];
  }
  if(isset($_POST['value'])) {
    $value = $_POST['value'];
  }
  if(isset($_POST['amount'])) {
    $amount = $_POST['amount'];
  }
  if(isset($_POST['supply_price'])) {
    $supply_price = $_POST['supply_price'];
  }
  if(isset($_POST['surtax'])) {
    $surtax = $_POST['surtax'];
  }
  if(isset($_POST['discount'])) {
    $discount = $_POST['discount'];
  }
  if(isset($_POST['total_price'])) {
    $total_price = $_POST['total_price'];
  }

  // for($i=0; $i<count($product_code); $i++){
  //   echo $surtax[$i];
  // }

  $cnt = count($product_code);
  if($cnt == 1)
  {
    $deTitle = $product_name['0'];
  }
  else if ($cnt > 1)
  {
    $deTitle = $product_name['0'] . " " . "외" . " " . $cnt . "건";
  }


  try{
    $conn->DBI();

    $sql = "insert into depo_spend(de_sp_name,de_sp_cate,de_sp_code,de_sp_date,in_out_manager,com_name,store_name,flag,memo)
    values('".$deTitle."','출금','".$date."','".$date_from."','".$manager."','".$company."','".$store."','1','".$memo."')";
    $conn->DBQ($sql);
    $conn->DBE();

    for($i=0; $i<count($product_code); $i++) {

      $sql = "insert into depo_spend_detail(de_sp_cate,de_sp_code,product_code,product_name,in_out_cnt,sup_price,surtax,sale,total_price)
      values('출금','".$date."','".$product_code[$i]."','".$product_name[$i]."','".$amount[$i]."','".$supply_price[$i]."','".$surtax[$i]."','".$discount[$i]."','".$total_price[$i]."')";
      $conn->DBQ($sql);
      $conn->DBE();
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>

<script type="text/javascript">alert("추가 되었습니다!");
window.location.href="../../spend.php"</script>
