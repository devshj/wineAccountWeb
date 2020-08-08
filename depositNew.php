<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>
<script>
	// function chkValue()
	// {
	// 	var date = document.depoform.date_from.value.replace(/\s|　/gi, '');
	// 	var manager = document.depoform.manager.value.replace(/\s|　/gi, '');
	// 	var company = document.depoform.company.value.replace(/\s|　/gi, '');
	// 	var warehouse = document.depoform.warehouse.value.replace(/\s|　/gi, '');
	// 	var store = document.depoform.store.value.replace(/\s|　/gi, '');
	//
	// 	if(date == ''){
	// 		alert('이 입력란을 작성하세요.')
	// 		documet.date_form.focus();
	// 		return false;
	// 	}
	// 	else if(manager == ''){
	// 		document.manager.focus();
	// 		return false;
	// 	}
	// 	else if(company == ''){
	// 		document.company.focus();
	// 		return false;
	// 	}
	// 	else if(warehouse == ''){
	// 		document.warehouse.focus();
	// 		return false;
	// 	}
	// 	else if(store == ''){
	// 		document.store.focus();
	// 		return false;
	// 	}
	// }

	function call()
	{
		for(var i=0; i<200; i++)
		{
			if(document.getElementById('supply_price['+i+']').value && document.getElementById('amount['+i+']').value && document.getElementById('discount['+i+']').value)
			{
				document.getElementById('total_price['+i+']').value = (parseInt(document.getElementById('supply_price['+i+']').value) *
				parseInt(document.getElementById('amount['+i+']').value) - parseInt(document.getElementById('discount['+i+']').value))
				+ ((parseInt(document.getElementById('supply_price['+i+']').value) * parseInt(document.getElementById('amount['+i+']').value)
				- parseInt(document.getElementById('discount['+i+']').value))/10);
			}
		}
	}
	// function call(){
	// 	for(var i=0; i<200; i++)
	// 		{
	// 			var surArr = new Array();
	//
	// 			if(document.getElementById('surtax['+i+']') == 1)
	// 			{
	// 				surArr[i] = 1;
	// 				document.write(surArr[i]);
	// 			}
	// 			else if(document.getElementById('surtax['+i+']') == 2)
	// 			{
	// 				surArr[i] = 2;
	// 				document.write(surArr[i]);
	// 			}
	// 	}
		// for(var i=0; i<200; i++){
		// 	var surArr = new Array();
		// 	if(document.getElementById('#surtax[i]').value == 1)
		// 	{
		// 		surArr[i] = 1;
		// 	}
		// 	else if(document.getElementById('#surtax[i]').value == 2)
		// 	{
		// 		surArr[i] = 2;
		// 	}
		//
		//
		// 	if(document.getElementById('#supply_price[i]').value && document.getElementById('#amount[i]').value && document.getElementById('#discount[i]').value)
		// 	{
		// 		document.getElementById('#total_price[i]').value = (parseInt(document.getElementById('#supply_price[i]').value) * parseInt(document.getElementById('#amount[i]').value) - parseInt(document.getElementById('#discount[i]').value));
		// 	}
		// }
	// }
</script>

<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content" style="min-height:800px;">
	  <section class="wrapper">
        <h3><a href="depositNew.php"><i class="fa fa-angle-right"></i>입금 추가</a></h3>
					<form action="./api/depositReg/depositInsert.php" class="form-horizontal style-form" method="post" name="depoform" id="depoform">
						<div class="row mt">
							<div class="col-lg-6">
								<div class="form-panel">
									<div class="cmxform form-horizontal style-form">

										<!-- <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-append date dpYears">
											<input type="text" id="datepicker1" name="from" readonly="readonly" placeholder="금액이 입금되는 날짜를 선택해주세요." value="" size="16" class="form-control">
												<span class="input-group-btn add-on">
													<button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
												</span>
									</div> -->

										<!-- 일자 -->
										<div class="form-group">
											<label for="date" class="control-label col-lg-2"><font color="red"> 일자 </font></label>
											<div class="col-lg-10">
												<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="" class="input-append date dpYears">
													<input type="text" id="datepicker" name="date_from" readonly="readonly" placeholder="금액이 입금되는 날짜를 선택해주세요." value="" class="form-control" required="">
												</div>
											</div>
									</div>

										<!-- 담당자 -->
										<div class="form-group">
											<label for="date" class="control-label col-lg-2"><font color="red">담당자</font></label>
											<div class="col-lg-10">
												<input class="form-control" id="cmanager" type="text" name="manager" required="">
											</div>
									</div>

										<!-- 거래처 -->
										<div class="form-group">
											<div class="fa-hover col-md-2 col-sm-3">
												<a href="#"  data-toggle="modal" data-target="#myModal_com"><i class="fa fa-search" name= "com_name"></i> 거래처 </a>

												<!-- pop-up -->
												<div class="modal fade" id="myModal_com" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_com" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title" id="myModalLabel">거래처를 선택해주세요.</h4>
															</div>
															<div class="modal-body">
																거래처 테이블을 넣어주세요
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
															</div>
														</div>
													</div>
												</div>
												<!-- /pop-up -->
										</div>

										<div class="col-lg-10">
											<input class="form-control" id="ccompany" type="text" name="company" required="">
										</div>
									</div>

							</div>
						</div>
						<!-- /form-panel -->
					</div>
					<!-- /col-lg-6 -->

					<div class="col-lg-6">
						<div class="form-panel">
							<div class="cmxform form-horizontal style-form">

								<!-- 창고 -->
								<div class="form-group">
									<div class="fa-hover col-md-2 col-sm-3">
										<a href="#" data-toggle="modal" data-target="#myModal_deposit"><i class="fa fa-search" name= "deposit_name"></i> 출하창고 </a>

										<!-- pop-up -->
										<div class="modal fade" id="myModal_deposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel">창고를 선택해주세요.</h4>
													</div>
													<div class="modal-body">
														창고 테이블을 넣어주세요.
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
													</div>
												</div>
											</div>
										</div>
										<!-- /pop-up -->
								</div>

								<div class="col-lg-10">
									<input class="form-control" id="cwarehouse" type="text" name="warehouse" required="">
								</div>
							</div>

							<!-- 매장명 -->
							<div class="form-group">
								<label for="date" class="control-label col-lg-2"> 매장명 </label>
								<div class="col-lg-10">
									<input class="form-control" id="cwarehouse" type="text" name="store" required="">
								</div>
						</div>

						<!-- 비고 -->
						<div class="form-group">
							<label for="comment" class="control-label col-lg-2">비고</label>
							<div class="col-lg-10">
								<input class="form-control" id="cwarehouse" type="text" name="memo">
							</div>
						</div>

							</div>
						</div>
					</div>
					<!-- /col-lg-6 -->

				</div>
				<!-- /row-mt -->

				<div class="row mt" id="txtHint">
				  <div class="col-lg-12" style="">
					  <section id="no-more-tables">
						<table class="table table-bordered table-hover table-striped" id="order_table">
						  <thead class="cf" style="background-color: #BDBDBD;" >
							<tr>
								<th class="numeric"></th>
							  <th class="numeric">상품코드</th>
								<th class="numeric">상품명</th>
							  <th class="numeric">공급가</th>
							  <th class="numeric">수량</th>
							  <th class="numeric">부가세</th>
							  <th class="numeric">할인</th>
							  <th class="numeric">총 가격</th>
							</tr>
						  </thead>

						  <tbody id="tbody">
								<tr>
									<td data-title=""><button id="deleteItemBtn[0]" type="button" class="btn btn-danger" onclick="deleteLine(this)"> - </td>
									<td data-title="상품코드">
										<div class="input-group">
											<input type="text" class="form-control" id="product_code[0]" name="product_code[0]" required="" value="">
											<span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span>
										</div>
									</td>

									<td data-title="상품명">
										<div class="input-group">
											<input type="text" class="form-control" id="product_name[0]" name="product_name[0]" required="" value="">
											<span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span>
										</div>
									</td>

									<td data-title="공급가"><input type="text" class="form-control" id="supply_price[0]" name="supply_price[0]" onchange="call()" required="" value=""></td>
									<td data-title="수량"><input type="text" class="form-control" id="amount[0]" name="amount[0]" onchange="call()" required="" value=""></td>
									<td data-title="부가세">
										<select class="form-control" id="surtax[0]" name="surtax[0]" style="font-size:13px;">
											<option value="1">부가세 적용</option>
											<option value="2">부가세 미적용</option>
										</select>
									</td>
									<td data-title="할인"><input type="text" class="form-control" id="discount[0]" name="discount[0]" value="0" onchange="call()" required="" value=""></td>
									<td data-title="총 가격"><input type="text" class="form-control" id="total_price[0]" name="total_price[0]" readonly="readonly" required="" value=""></td>
								</tr>
						  </tbody>
						</table>
				  </section>
			  </div>
				  <!-- /col-lg-12 END -->

					<div class="col-lg-12" style="text-align:center">
						<button id="addItemBtn" type="button" class="btn btn-default"> + </button>
					</div>
				</div>
				<!-- /row -->

			<div class="row mt" style="text-align:right">
				<div class="col-lg-12">
					<button class="btn btn-theme" type="submit">등록</button>
					<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
				</div>
			</div>

				</form>
	    </section>
		</section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
	<?$layout->JsFile("
	<script type='text/javascript' src='lib/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>

	<script>
		$( function () {
			jQuery( '#datepicker' ).datepicker();
		} );
		$( function() {
		 	jQuery( '#datepicker1' ).datepicker();
		} );
	</script>
  ");?>
  <?$layout->js($js);?>

	<script>
		var i = 0;
		$('#addItemBtn').click(function() {
			i++;

			var rowItem = '<tr>';
			rowItem += '<td data-title=""> <button id="deleteItemBtn['+i+']" type="button" class="btn btn-danger" onclick="deleteLine(this)"> - </td>'
			rowItem += '<td data-title="상품코드"> <div class="input-group"><input type="text" class="form-control" id="product_code['+i+']" name="product_code['+i+']" value="" required=""><span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span></div></td>';
			rowItem += '<td data-title="상품명"> <div class="input-group"><input type="text" class="form-control" id="product_name['+i+']" name="product_name['+i+']" value="" required=""><span class="input-group-addon info"><a href="#" data-toggle="modal" data-target="#myModal_deposit"><span class="glyphicon glyphicon-asterisk"></span></a></span></div></td>';
			rowItem += '<td data-title="공급가"> <input type="text" class="form-control" id="supply_price['+i+']" name="supply_price['+i+']" onkeyup="call()" value="" required=""></td>';
			rowItem += '<td data-title="수량"> <input type="text" class="form-control" id="amount['+i+']" name="amount['+i+']" onkeyup="call()" value="" required=""></td>';
			rowItem += '<td data-title="부가세"> <select class="form-control" id="surtax['+i+']" name="surtax['+i+']" style="font-size:13px;" onkeyup="call()" value="" required=""><option value="1">부가세 적용</option><option value="2">부가세 미적용</option></select></td>';
			rowItem += '<td data-title="할인"> <input type="text" class="form-control" id="discount['+i+']" name="discount['+i+']" value="0" onkeyup="call()" value="" required=""></td>';
			rowItem += '<td data-title="총 가격"> <input type="text" class="form-control" id="total_price['+i+']" name="total_price['+i+']" readonly="readonly" value="" required=""></td>';
			$('#order_table > tbody:last').append(rowItem);
		})

		function deleteLine(obj){
			var tr = $(obj).parent().parent();
			tr.remove();
		}
	</script>
</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
