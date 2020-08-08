<?
  require_once '../dbconn.php';

  $conn = new DBC();

  if(isset($_GET['chk_info'])){
    $chk = $_GET['chk_info'];

    try{
      $conn->DBI();

      for($i=0; $i<count($chk); $i++){
        $query1 = "delete from depo_spend where idx = $chk[$i]";
        $conn->DBQ($query1);
        $conn->DBE();
      }
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  } else { ?>
    <script>window.location.href="../../deposit.php"</script>
  <? } ?>

<script type="text/javascript">alert("삭제 되었습니다!");
window.location.href="../../deposit.php"</script>
