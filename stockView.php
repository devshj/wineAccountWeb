<?
// 재고조회
include 'layout/layout.php';
include 'api/dbconn.php';
include 'api/pageClass.php';

$conn = new DBC();
$conn->DBI();

$query1 = "SELECT count(*) FROM wine_stock";
$conn->DBQ($query1);
$conn->DBE(); //쿼리 실행
$cnt = $conn->DBF();

$total_row = $cnt['count(*)'];		// db에 저장된 게시물의 레코드 총 갯수 값. 현재 값은 테스트를 위한 값
$list = 10;							// 화면에 보여지 게시물 갯수
$block = 8;							// 화면에 보여질 블럭 단위 값[1]~[5]
$page = new paging($_GET['page'], $list, $block, $total_row);
$page->setUrl("content=forum");		// get값으로 가지고 다닐 변수가 있을시.
$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

$page->setDisplay("prev_btn", "[이전]"); // [이전]버튼을 [prev] text로 변경
$page->setDisplay("next_btn", "[다음]"); // 이와 같이 버튼을 이미지로 바꿀수 있음
$page->setDisplay("full");
$paging = $page->showPage();

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
        <h3><a href="stockView.php"><i class="fa fa-angle-right"></i>재고 조회</a></h3>
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
            <input type="button" class="btn btn-default" OnClick="print(document.getElementById('printArea').innerHTML)" value="Print" />
		      </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->
    		<div class="row mt" id="txtHint">
          <div class="col-lg-12" style="">
            <section id="no-more-tables">
              <div id = "printArea">
                <table class="table table-bordered table-hover table-striped">
                  <thead class="cf" style='background-color: #BDBDBD'>
                    <tr>
                      <th>제품 코드</th>
                      <th class="numeric">제품명</th>
                      <th class="numeric">현 수량</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?
                      $query2 = "SELECT * FROM wine_stock ORDER BY idx DESC LIMIT $limit, $list";
                      $conn->DBQ($query2);
                      $conn->DBE();

                      while($row = $conn->DBF())
                      {
                    ?>
                    <tr>
                      <td data-title="제품코드"><a href="./stockDetail.php?sNo=<?echo $row['product_code'];?>">
                        <?echo $row['product_code'];?></a></td>
                      <td class="numeric" data-title="제품명"><?echo $row['product_name'];?></td>
                      <td class="numeric" data-title="현 수량"><?echo $row['current_cnt'];?></td>
                    </tr>
                  </tbody>
                   <? } ?>
                </table>
              </div>
              <!-- printArea -->
              </section>
            </div>
            <!-- /col-lg-12 END -->
          </div>
          <!-- row -->
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
        <ul class="pagination">
  			<?echo $paging;//하단 페이징 화면 출력?>
  			</ul>
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
		function print(printArea)
    {
  		win = window.open();
  		self.focus();
  		win.document.open();

  		/*
  			1. div 안의 모든 태그들을 innerHTML을 사용하여 매개변수로 받는다.
  			2. window.open() 을 사용하여 새 팝업창을 띄운다.
  			3. 열린 새 팝업창에 기본 <html><head><body>를 추가한다.
  			4. <body> 안에 매개변수로 받은 printArea를 추가한다.
  			5. window.print() 로 인쇄
  			6. 인쇄 확인이 되면 팝업창은 자동으로 window.close()를 호출하여 닫힘
  		*/
  		win.document.write('<html><'head'><title></title><style>');
  	  win.document.write('body, td {font-falmily: Verdana; font-size: 10pt;}');
  		win.document.write('</style></head><body>');
  	  win.document.write(printArea);
   		win.document.write('</body></html>');
  		win.document.close();
  		win.print();
  		win.close();
    }
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
