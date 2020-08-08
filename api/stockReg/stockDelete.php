<?
  require_once '../dbconn.php';

  if(isset($_GET['chk_info'])){
    $chk = $_GET['chk_info'];
  }

  $conn = new DBC();

  try{
    $conn->DBI();

    for($i=0; $i<count($chk); $i++){
      $query1 = "delete from wine_stock where idx = $chk[$i]";
      $conn->DBQ($query1);
      $conn->DBE();
    }
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
?>

<script type="text/javascript">alert("삭제 되었습니다!");
window.location.href="../../stockView.php"</script>
