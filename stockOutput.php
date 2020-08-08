<?
// 재고조회
include 'layout/layout.php';
include 'api/dbconn.php';

$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><a href="stockOutput.php"><i class="fa fa-angle-right"></i>출고 현황</a></h3>
		<div class="row mt">
          <div class="col-lg-12" style="">
		          <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">검색필터 </span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#상품코드">제품 코드</a></li>
                      <li><a href="#상품명">제품명</a></li>
                    </ul>
                </div>
                <input type="hidden" name="search_param" value="all" id="search_param">
                <input type="text" class="form-control" name="x" placeholder="검색어를 입력하세요. . .">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="searchButton"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
          </div>
          <!-- /col-lg-12 END -->
        </div>

       <form action="./api/stockReg/stockDelete.php" method="get">
       <!-- /row -->
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
      <div id="printArea">
    		<div class="row mt" id="txtHint">
          <div class="col-lg-12" style="">
              <section id="no-more-tables">
                <table class="table table-bordered table-hover table-striped">
                  <thead class="cf" style='background-color: #BDBDBD'>
                    <tr>
                      <th>선택</th>
                      <th>제품 코드</th>
                      <th>제품명</th>
                      <th class="numeric">날짜</th>
                      <th class="numeric">출고 수량</th>
                      <th class="numeric">출고 단가</th>
                      <th class="numeric">금액</th>
                      <th class="numeric">비고</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?
                      $conn = new DBC();
                      $conn->DBI();
                      $query1 = "SELECT * FROM wine_stock";
                      $conn->DBQ($query1);
                      $conn->DBE();

                      while($row = $conn->DBF())
                      {
                    ?>
                    <tr>
                      <td data-title="선택">
                          <input type="checkbox" id="chk_info[]" name="chk_info[]" value="<?echo $row['idx'];?>"></input>
                      </td>
                      <td data-title="제품코드"><a href="./stockDetail.php?sNo=<?echo $row['product_code'];?>"></a></td>
                      <td class="numeric" data-title="제품명"></td>
                      <td class="numeric" data-title="날짜"></td>
                      <td class="numeric" data-title="출고 수량"></td>
                      <td class="numeric" data-title="출고 단가"></td>
                      <td class="numeric" data-title="금액"></td>
                      <td class="numeric" data-title="비고"></td>
                    </tr>
				           <? } ?>
                  </tbody>

                  <tfoot>
                    <tr>
                      <td colspan="4" style="text-align:center;">합계</td>
                      <td><!--출고 수량 합한 값--></td>
                      <td><!--출고 단가 합한 값--></td>
                      <td><!--전체 금액 합한 값--></td>
                      <td></td>
                    </tr>
                  </tfoot>

                </table>
              </section>
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- row -->
      </div>
      <!-- /printArea -->
    </form>

		<div class="row" style="text-align:center">
          <div class="col-lg-12" style="">
			<!-- <ul class="pagination">
			  <li class="page-item">
				<a class="page-link" href="#" aria-label="Previous">
			      <span aria-hidden="true">&laquo;</span>
				  <span class="sr-only">Previous</span>
			    </a>
			  </li>
			  <li class="page-item"><a class="page-link" href="#">1</a></li>
			  <li class="page-item"><a class="page-link" href="#">2</a></li>
			  <li class="page-item"><a class="page-link" href="#">3</a></li>
			  <li class="page-item"><a class="page-link" href="#">4</a></li>
			  <li class="page-item"><a class="page-link" href="#">5</a></li>
			  <li class="page-item"><a class="page-link" href="#">6</a></li>
			  <li class="page-item"><a class="page-link" href="#">7</a></li>
			  <li class="page-item"><a class="page-link" href="#">8</a></li>
			  <li class="page-item"><a class="page-link" href="#">9</a></li>
			  <li class="page-item">
			    <a class="page-link" href="#" aria-label="Next">
				  <span aria-hidden="true">&raquo;</span>
				  <span class="sr-only">Next</span>
			    </a>
		      </li>
		    </ul> -->
          </div>
		</div>
        <!-- /row -->

      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->JsFile("
  <script>
		var param,concept,value;

		$('.search-panel .dropdown-menu').find('a').click(function() {
			param = $(this).attr('href').replace('#','');
			concept = $(this).text();
			$('.search-panel span#search_concept').text(concept);
			$('.input-group #search_param').val(param);
		});

		$( '#searchButton' ).click(function() {
		  value = $('input[name=x]').val();
		  $.ajax({
		    type: 'POST',
		    url: 'api/stockReg/stockS.php',
		    data:{
			    category: param,
                searchT: value
		    },
		    //async: false,
		    success: function(result){
			    document.getElementById('txtHint').innerHTML = result;
		    },
		    error: function(result){
			    alert('접속이 원할하지 않습니다.');
		    }
		  });
		});
  </script>
  ");?>
  <?$layout->js($js);?>
</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
?>
