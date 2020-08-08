<?
//거래처 관리
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];

		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속
		$query = "SELECT * FROM wine_order WHERE idx = $no";

		$conn->DBQ($query);
		$conn->DBE(); //쿼리 실행
		$result = $conn->DBF();
	}
	
	$layout = new Layout;

?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet"> 
	<script src="//code.jquery.com/jquery.min.js"></script>');?>
<?$layout->head($head);?>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:1000px;">

	  <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i>발주 등록</h3>
		<h4><i class="fa fa-angle-right"></i>기본 정보</h4>
		
    <!--content start-->
		<div class="row mt">
	     <form action="./api/orderReg/order_insert.php" method="post" name="order_form">
		 <input type="hidden" name="type" value="order">
		 <?if(isset($no)){?>
	       <input class=" form-control" name="no" type="hidden" value="<?echo $result['idx']?>">
		 <?}?>
		 <input type="hidden" name="order_code" value="<?echo date("Y-m-d H:i:s");?>">
		 <input type="hidden" name="com_code" value="34875">
		 <input type="hidden" name="order_state" value="1">
		 <input type="hidden" name="order_cate" value="발주">
		 <input type="hidden" name="order_flag" value="1">
		  <div class="col-lg-6" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">

				<div class="form-group ">
                    <label for="num" class="control-label col-lg-2"><font color="red">일자</font></label>
                    <div class="col-lg-10">
                      <input type="text" id="datepicker" class="form-control dpd1" name="input_date">
                    </div>
				</div>
				<div class="form-group">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_com"><font color="red"><i class="fa fa-search"></i>거래처명</font></a>	 
						<!--팝업시작-->
						<div class="modal fade" id="myModal_com" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">거래처명을 선택해주세요.</h4>
									</div>
									<div class="modal-body">
										거래처 테이블 넣어주세요.
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
									</div>
								</div>
							</div>
						</div>
						<!--팝업끝-->
					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="com_name" name="com_name" minlength="2" type="text" required >
                    </div>
				</div>
								
				<div class="form-group ">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_mname"><i class="fa fa-search" name= "mname"></i>담당자</a>	 
						<!--팝업시작-->
						<div class="modal fade" id="myModal_mname" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">담당자를 선택해주세요.</h4>
									</div>
									<div class="modal-body">
										담당자 테이블 넣어주세요.
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
									</div>
								</div>
							</div>
						</div>
						<!--팝업끝-->
					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="m_name" name="m_name" minlength="2" type="text" required >
                    </div>
				</div>
				
			  </div>
			</div>
		  </div>
          <!-- /col-lg-6 END -->
          <div class="col-lg-6" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group ">
                    <label for="address" class="control-label col-lg-2"><font color="red">납기 일자</font></label>
                    <div class="col-lg-10">
                      <input type="text" id="datepicker1" class="form-control dpd2" name= "due_date">
                    </div>
				</div>
				
				<div class="form-group ">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_stock"><font color="red"><i class="fa fa-search"></i>매장명</font></a>	 
						<!--팝업시작-->
						<div class="modal fade" id="myModal_stock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">매장을 선택해주세요.</h4>
									</div>
									<div class="modal-body">
										매장 테이블 넣어주세요.
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
									</div>
								</div>
							</div>
						</div>
						<!--팝업끝-->
					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="store_name" name="store_name" minlength="2" type="text">
                    </div>
				</div>
				
				<div class="form-group ">
                    <div class="control-label col-lg-2">
						<a href="#"  data-toggle="modal" data-target="#myModal_warehouse"><i class="fa fa-search" name= "com_name"></i>창고명</a>	 
						<!--팝업시작-->
						<div class="modal fade" id="myModal_warehouse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">창고를 선택해주세요.</h4>
									</div>
									<div class="modal-body">
										창고 테이블 넣어주세요.
										</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
									</div>
								</div>
							</div>
						</div>
						<!--팝업끝-->
					</div>
                    <div class="col-lg-10">
                      <input class=" form-control" id="ware_code" name="ware_code" minlength="2" type="text">
                    </div>
				</div>
				
				
			  </div>
			</div>
          </div>
          <!-- /col-lg-6 END -->
          <div class="col-lg-12" style="">
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				<div class="form-group ">
                    <label for="comment" class="control-label col-lg-1">비고</label>
                    <div class="col-lg-11">
                      <textarea class="form-control " id="memo" name="memo"></textarea>
                    </div>
				</div>
              </div>
	        </div>
          </div>
        </div>
			<!-- /col-lg-12 -->
		</div>
        <!-- /row -->
		<h4><i class="fa fa-angle-right"></i>상세 정보</h4>
			<div class="row mt" id="txtHint">
			  <div class="col-lg-12" style=""> 
				<!--<div class="content-panel">-->
				  <!--<h4><i class="fa fa-angle-right"></i> No More Table</h4>-->
				  <section id="no-more-tables">
					<table class="table table-bordered table-hover table-striped"  id="order_table">
					  <thead class="cf" style='background-color: #BDBDBD'>
						<tr>
						  <th></th>
						  <th>상품 코드</th>
						  <th class="numeric">상품명</th>
						  <th class="numeric">총 수량</th>
						  <th class="numeric">공급가</th>
						  <th class="numeric">부가세</th>
						  <th class="numeric">할인</th>
						  <th class="numeric">총가격</th>
						</tr>
					  </thead>
					  <tbody id="tbody">
					  	<tr>
							<td><button id="deleteItemBtn[0]" type="button" class="btn btn-danger" onclick="deleteLine(this)"> - </td>
							<td data-title="상품코드"><input type="text" class="form-control" id ="product_code[0]" name="product_code[0]"></td>
							<td data-title="상품명"><input type="text" class="form-control" name="product_name[0]"></td>
							<td data-title="총 수량"><input type="text" class="form-control" name="order_cnt[0]"></td>
							<td data-title="공급가"><input type="text" class="form-control" name="sup_price[0]"></td>
							<td data-title="부가세">
								<select class="form-control" name="surtax[0]" style="font-size:13px;">
									<option value="aplly">적용</option>
									<option value="non_apply">미적용</option>
								</select>
							</td>
							<td data-title="할인"><input type="text" class="form-control" name="sale[0]"></td>
							<td data-title="총 가격"><input type="text" class="form-control" name="all_price[0]" readonly="readonly"></td>
						</tr>
					  </tbody>
					</table>
				  </section>
				<!--</div>-->
				<!-- /content-panel -->
			  </div>
			  <!-- /col-lg-12 END -->
			  <div class="col-lg-12" style="text-align:center">
				<button id="addItemBtn" type="button" class="btn btn-default"> + </button>
			  </div>
			</div>
		
			<!-- /row -->

			<div class="row" style="text-align:right">
			  <div class="col-lg-12" style=""> 
				<button type="submit" class="btn btn-theme" >등록</button>
				<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
			  </div>
			</div>
		<!--<div id="txtHint"><b>Person info will be listed here...</b></div>-->
		</form>
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->JsFile("
	
	<script type='text/javascript' src='lib/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>

	

	<script>
		$( function() {
			jQuery( '#datepicker' ).datepicker();
		} );
		$( function() {
			jQuery( '#datepicker1' ).datepicker();
		} );
	</script>
	
  ");?>

	<script>
		var i = 0;
		$('#addItemBtn').click(function() {
			
			i++;

			var rowItem = '<tr>';
			rowItem += '<td><button id="deleteItemBtn['+i+']" type="button" class="btn btn-danger" onclick="deleteLine(this)"> - </td>'
			rowItem += '<td> <input type="text" class="form-control" id="product_code['+i+']" name="product_code['+i+']" onclick="show_prod(this)" required=""></td>';
			rowItem += '<td> <input type="text" class="form-control" name="product_name['+i+']" onclick="show_prod(this)" required=""></td>';
			rowItem += '<td> <input type="text" class="form-control" name="order_cnt['+i+']" required=""></td>';
			rowItem += '<td> <input type="text" class="form-control" name="sup_price['+i+']" required=""></td>';
			rowItem += '<td> <select class="form-control" name="surtax['+i+']" style="font-size:13px;" required=""><option value="apply">적용</option><option value="non_aplly">미적용</option></select></td>';
			rowItem += '<td> <input type="text" class="form-control" name="sale['+i+']" value="0" required=""></td>';
			rowItem += '<td> <input type="text" class="form-control" name="all_price['+i+']" readonly="readonly" required=""></td></tr>';
			$('#order_table > tbody:last').append(rowItem);
		})

		function deleteLine(obj){
			var tr = $(obj).parent().parent();
			tr.remove();
		}
	</script>

	  <?$layout->js($js);?>

</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
?>
