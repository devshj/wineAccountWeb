<?
//출금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">
<script>

</script>
');?>
<?$layout->head($head);?>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
      <?
      $conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
      $conn->DBI(); //DB 접속

      $dNo = $_GET['dNo'];

      $query1 = "select * from depo_spend where de_sp_code = '".$dNo."'";
      $conn->DBQ($query1);
      $conn->DBE();

      $row1 = $conn->DBF();
      ?>
        <h3><i class="fa fa-angle-right"></i>출금내역 상세보기</h3>
				<div class="row mt">
					<div class="col-lg-4">
            <h4 style="color:blue;"> (  <?echo $row1['de_sp_name'];?>  )</h4>
					</div>
					<!-- col-lg-4 -->
        </div>
        <!-- row -->

        <div class="row mt">
           <div class="col-lg-12" style="">
						 <input type="button" class="btn btn-default" onclick="" value="PDF"></input>
						 <input type="button" class="btn btn-default" onclick="" value="Excel"></input>
						 <input type="button" class="btn btn-default" onclick="print(document.getElementById('printArea').innerHTML)"
						 value="Print"></input>
 		      </div>
           <!-- /col-lg-12 END -->
         </div>
         <!-- /row -->

        <div class="row mt">
          <div class="col-lg-12">
            <table class="table table-bordered table-hover table-striped">
              <thead class="cf" style='background-color: #BDBDBD'>
                <tr>
                  <th>상품코드</th>
                  <th>상품명</th>
                  <th class="numeric">공급가</th>
                  <th class="numeric">수량</th>
                  <th class="numeric">부가세 적용여부</th>
                  <th class="numeric">할인가</th>
                  <th class="numeric">총 가격</th>
                </tr>

                <?
                  $query2 = "select * from depo_spend_detail where de_sp_code = '".$dNo."'";
                  $conn->DBQ($query2);
                  $conn->DBE();

                  while($row2 = $conn->DBF()) {
                ?>

                <tbody>
                  <tr>
                    <td data-title="상품코드"><a href="#"><?echo $row2['product_code'];?></a></td>
                    <td data-title="상품명"><a href="#"><?echo $row2['product_name'];?></a></td>
                    <td class="numeric" data-title="공급가"><?echo $row2['sup_price'];?></td>
                    <td class="numeric" data-title="수량"><?echo $row2['in_out_cnt'];?></td>
                    <td class="numeric" data-title="부가세 적용여부"><font color="blue">
											<?
												if($row2['surtax'] == 1){
													echo '부가세 적용';
												} else if ($row2['surtax'] == 2) {
													echo '부가세 미적용';
												}
											?>
										</font></td>
										<td class="numeric" data-title="총 가격"><?echo $row2['sale'];?></td>
                    <td class="numeric" data-title="총 가격"><?echo $row2['total_price'];?></td>
                  </tr>
                <? } ?>
                </tbody>
              </table>
            </div>
            <!--/col-lg-12 -->
          </div>
					<!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->js($js);?>
</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
