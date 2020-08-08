<?
//발주 관리
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';

//검색시작
	if(isset($_GET['search_param'])) {
		$searchColumn = $_GET['search_param'];
	}
	if(isset($_GET['search_text'])) {
		$searchText = $_GET['search_text'];
	}
	
	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
	} else {
		$searchSql = '';
	}
//검색 끝

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$query = "SELECT count(*) FROM wine_order ".$searchSql;
	
	$conn->DBQ($query);	
	$conn->DBE(); //쿼리 실행
	$cnt = $conn->DBF();

	$total_row = $cnt['count(*)'];		// db에 저장된 게시물의 레코드 총 갯수 값. 현재 값은 테스트를 위한 값
	$list = 10;							// 화면에 보여지 게시물 갯수
	$block = 8;							// 화면에 보여질 블럭 단위 값[1]~[5]
	$page = new paging($_GET['page'], $list, $block, $total_row);

	if(isset($searchColumn) && isset($searchText)){
		// get값으로 가지고 다닐 변수가 있을시.
		$page->setUrl("search_param=".$searchColumn."&search_text=".$searchText);
	}

	$limit = $page->getVar("limit");	// 가져올 레코드의 시작점을 구하기 위해 값을 가져온다. 내부로직에 의해 계산된 값

	$page->setDisplay("prev_btn", "[이전]"); // [이전]버튼을 [prev] text로 변경
	$page->setDisplay("next_btn", "[다음]"); // 이와 같이 버튼을 이미지로 바꿀수 있음
	$page->setDisplay("full");
	$paging = $page->showPage();

	$query ="SELECT * FROM wine_order ".$searchSql." ORDER BY idx DESC LIMIT $limit, $list"; //변수에 쿼리 저장

	$conn->DBQ($query);	
	$conn->DBE(); //쿼리 실행
	
	$result = $conn->resultRow();

	$ware = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$ware->DBI(); //DB 접속
	$query ="SELECT * FROM wine_warehouse ORDER BY idx DESC LIMIT $limit, $list"; //변수에 쿼리 저장
	$ware->DBQ($query);	
	$ware->DBE(); //쿼리 실행	
	$row_ware = $ware->resultRow();

	


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
	<section id="main-content" style="min-height:1000px;">
		<section class="wrapper">
			<h3><i class="fa fa-angle-right"></i>발주 현황</h3>
			<div class="row mt">
				<div class="col-lg-12">
					 <div class="form-panel">
						<div class=" form">
							<form class="cmxform form-horizontal style-form" id="commentForm" method="get" action="<?=$_SERVER['PHP_SELF']?>">
									 <div class="form-group ">
										<label for="cname" class="control-label col-lg-2">날짜</label>
										<div class="col-lg-10">
										 <div class="input-group input-large" data-date="2014/01/01" data-date-format="yyyy/mm/dd">
											<input type="text" id="datepicker" class="form-control dpd1" name="from" name="in_out_date">
											<span class="input-group-addon"> ~ </span>
											<input type="text" id="datepicker1" class="form-control dpd2" name="to" name= "in_out_Date">
										 </div>
									 </div>
								</div>
								<div class="form-group ">
									<div class="fa-hover col-md-2 col-sm-3">
										<a href="#"  data-toggle="modal" data-target="#myModal_deposit"><i class="fa fa-search" name= "deposit_name"></i> 창고 </a>	  
										<!--팝업시작-->
										<div class="modal fade" id="myModal_deposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel">창고를 선택해주세요.</h4>
													</div>
													<div class="modal-body">
														<div class="row mt">
														  <div class="col-lg-12" style="" id="print"> 
															<section id="no-more-tables">
															  <table class="table table-bordered table-hover table-striped">
																<thead class="cf" style='background-color: #BDBDBD'>
																  <tr>
																	<th>선택</th>
																	<th>창고코드</th>
																	<th>창고명</th>
																	<th class="numeric">담당자명</th>
																  </tr>
																</thead>
																<tbody>
																
																  <?if($row_ware!= 0){while($row = $ware->DBF()){?>
																	<tr>
																	  <td data-title="선택"><input type="checkbox" name="chk_info[]" value="<?echo $row ['idx'];?>"></td>
																	  <td data-title="창고코드"><a href="warehouse_form.php?no=<?echo $row ['idx'];?>">
																	  <?echo $row['ware_code'];?></a></td>
																	  <td data-title="창고명"><a href="warehouse_form.php?no=<?echo $row ['idx'];?>">
																	  <?echo $row['ware_name'];?></a></td>
																	  <td class="numeric" data-title="담당자명"><?echo $row['ware_m'];?></td>
																	</tr>
																<?}
																}else{$empty = "결과가 없습니다."?>
																<?}?>
																</tbody>
															  </table>
															  <?if(isset($empty)){?>
															  <div style="text-align:center;min-height:50px"><?=$empty?></div>
															  <?}?>
															</section>
														  </div>
														  <!-- /col-lg-12 END -->
														</div>													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
													</div>
												</div>
											</div>
										</div>
										<!--팝업끝-->
									</div>
									<div class="col-lg-10">
										<input class="form-control " id="cemail" type="text" name="email" required="">
									</div>
								</div>
								<div class="form-group ">
									<div class="fa-hover col-md-2 col-sm-3">
										<a href="#"  data-toggle="modal" data-target="#myModal_com"><i class="fa fa-search" name= "com_name"></i> 거래처명 </a>	 
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
										<input class="form-control " id="curl" type="url" name="url">
									</div>
								</div>
								<div class="form-group ">
									<div class="fa-hover col-md-2 col-sm-3">
										<a href="#"  data-toggle="modal" data-target="#myModal_pro"><i class="fa fa-search" name= "pro_name"></i> 상품명 </a>	  
										<!--팝업시작-->
										<div class="modal fade" id="myModal_pro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel_pro" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel1">상품명을 선택해주세요. </h4>
													</div>
													<div class="modal-body">
														상품 테이블 넣어주세요.
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
										<input class="form-control " id="curl" type="url" name="url">
									</div>
								</div>
								<div class="row" style="text-align:right">
									<div class="col-lg-12" style=""> 
									   <button type="submit" id="addItemBtn" class="btn btn-primary submit mb-6">검색</button>
									</div>
								</div>
							 </div>
						</form>
						<!-- /form-panel -->
					</div>
				</div>
			<!-- /col-lg-12 -->
			</div>

			<form action="api/orderReg/order_delete.php" method="get">
				<div class="row mt">
					<div class="col-lg-12" style="">
						<button type="button" class="btn btn-default">PDF</button>
						<button type="button" class="btn btn-default">Excel</button>
						<button type="button" class="btn btn-default">Print</button>
					</div>
					<!-- /col-lg-12 END -->
				</div>
		<!-- /row -->
				<div class="row mt" id="txtHint">
					<div class="col-lg-12" style="">
				<!--<div class="content-panel">-->
				<!--<h4><i class="fa fa-angle-right"></i> No More Table</h4>-->
						<section id="no-more-tables">
							<table class="table table-bordered table-hover table-striped">
								<thead class="cf" style='background-color: #BDBDBD'>
									<tr>
									  <th>선택</th>
									  <th>발주 코드</th>
									  <th>상품코드</th>
									  <th>상품명</th>
									  <th class="numeric">총 수량</th>
									  <th class="numeric">단가</th>
									  <th class="numeric">거래처이름</th>
									  <th class="numeric">담당자명</th>
									  <th class="numeric">입력시간</th>
									  <th class="numeric">예정일자</th>
									  <th class="numeric">상태(종결, 진행중)</th>
									  <th class="numeric">비고</th>
									</tr>
								</thead>
								<tbody>
									  <?while($row = $conn->DBF()){?>
									<tr>
									  <td data-title="선택"><input type="checkbox" name="chk_info[]" value="<?echo $row ['idx'];?>"></td>
									  <td data-title="발주 코드"><a href="#"><?echo $row['order_code'];?></a></td>
									  <td data-title="상품 코드"><a href="#"><?echo $row['product_code'];?></a></td>
									  <td data-title="상품명"><a href="#"><?echo $row['product_name'];?></a></td>
									  <td class="numeric" data-title="총수량"><?echo $row['order_cnt'];?></td>
									  <td class="numeric" data-title="단가"><?echo $row['unit_price'];?></td>
									  <td class="numeric" data-title="거래처이름"><?echo $row['com_name'];?></td>
									  <td class="numeric" data-title="담당자명"><?echo $row['m_name'];?></td>
									  <td class="numeric" data-title="입력시간"><?echo $row['input_date'];?></td>
									  <td class="numeric" data-title="예정일자"><?echo $row['due_date'];?></td>
									  <td class="numeric" data-title="상태(종결,진행중)"><?if($row['order_state']!=0){echo "종결";}else{echo "진행중";}?></td>
									  <td class="numeric" data-title="비고"><?echo $row['memo'];?></td>
									</tr>
									<?}?>
								</tbody>
							</table>
						<!--<div style="text-align:center">not result</div>-->
						</section>
					</div>
				<!-- /col-lg-12 END -->
				</div>
			</form>
			<div class="row" style="text-align:center">
			  <div class="col-lg-12" style=""> 
				<!--<ul class="pagination">
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
				  <li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
					  <span aria-hidden="true">&raquo;</span>
					  <span class="sr-only">Next</span>
					</a>
				  </li>
				</ul>-->
				<ul class="pagination">
				<?echo $paging;//하단 페이징 화면 출력?> 
				</ul>
			  </div>
			</div>
		<!-- /row -->
			<div class="row" style="text-align:right">
			  <div class="col-lg-12" style=""> 
				<button type="submit" class="btn btn-default" id="submitBtn">추가</button>
				<button type="submit" class="btn btn-default" id="submitBtn">수정</button>
				<button type="submit" class="btn btn-default" id="submitBtn">삭제</button>
			  </div>
			</div>
			<??>
		</section>
	</section>
	<!--main content end-->
	<?$layout->
		footer($footer);?> </section>
	<?$layout->
		JsFile("
		<script>
				$(document).ready(function(e){
					$('.search-panel .dropdown-menu').find('a').click(function(e) {
						e.preventDefault();
						var param = $(this).attr('href').replace('#','');
						var concept = $(this).text();
						$('.search-panel span#search_concept').text(concept);
						$('.input-group #search_param').val(param);
					});
				});
		</script>
		");?> <?$layout->
	js($js);?>
	</body>
</html>
<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>