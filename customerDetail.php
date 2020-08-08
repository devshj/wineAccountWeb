<?
//재고 수불부
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
      <?

      $conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
      $conn->DBI(); //DB 접속

      $pNo = $_GET['pNo'];
      $query = "select * from wine_customer where idx = '".$pNo."'";
      $conn->DBQ($query);
      $conn->DBE();
      $row = $conn->DBF();
      ?>
        <h3><i class="fa fa-angle-right"></i>고객 수정</h3>
						<div class="row mt">
							<div class="col-lg-12">
								<div class="form-panel">
									<form action="./api/customerReg/customerModifyOk.php" class="form-horizontal style-form" method="post">

										<input type="hidden" value="<? echo $row['idx'];?>" name="c_idx"></input>
										<!-- form-group 고객 -->
										<div class="form-group ">
											<div class="fa-hover col-md-2 col-sm-3">
											<a> 고객 명 </a>
											</div>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="v_name" name="c_name" value="<? echo $row['cust_name']; ?>"></input>
											</div>
												</div>
										<!-- form-group 번호 -->

<?
if(isset($pNo)){
	$phone = $row['phone_num'];
	$frontNum = mb_substr($phone,0, $cnt1 = mb_strpos($phone,'-'));
	$midNum = mb_substr($phone, mb_strpos($phone,'-',$cnt1)+1, $cnt2 = mb_strpos($phone,'-',$cnt1)+1);
	$midNum = str_replace('-','',$midNum);
	$finalNum = mb_substr($phone,mb_strpos($phone,'-',$cnt1+$cnt2)+1);
}
?>
				<div class="form-group">
                    <label for="phone" class="control-label col-lg-2"><font color="red">휴대폰번호</font></label>
                    <div class="col-lg-10">
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					  <select class="form-control" name="txtMobile1" id="phone" required>
						  <option value="">::선택::</option>
						  <option value="010"
						  <?if(isset($pNo)){if($frontNum == "010"){echo "selected";}}?>>010</option>
						  <option value="011"
						  <?if(isset($pNo)){if($frontNum == "011"){echo "selected";}}?>>011</option>
						  <option value="016"
						  <?if(isset($pNo)){if($frontNum == "016"){echo "selected";}}?>>016</option>
						  <option value="017"
						  <?if(isset($pNo)){if($frontNum == "017"){echo "selected";}}?>>017</option>
						  <option value="019"
						  <?if(isset($pNo)){if($frontNum == "019"){echo "selected";}}?>>019</option>
					  </select>
					  </div>
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					    <input class="form-control" name="txtMobile2" size="4" required
						pattern="^[0-9]*$" title="숫자를 입력해 주세요"
						<?if(isset($midNum)){echo "value={$midNum}";}?>>
					  </div>
					  <div class="col-lg-4" style="padding-left:0px;padding-right:0px">
					    <input class="form-control" name="txtMobile3" size="4" required
						pattern="^[0-9]*$" title="숫자를 입력해 주세요"
						<?if(isset($finalNum)){echo "value={$finalNum}";}?>>
					  </div>
                    </div>
				</div>


											<!-- form-group 나이 -->
											<div class="form-group ">
												<div class="fa-hover col-md-2 col-sm-3">
												<a> 나이 </a>
												</div>
												<div class="col-lg-10">
													<input type="text" class="form-control" id="v_age" name="c_age" required
													pattern="^[0-9]*$" title="숫자를 입력해 주세요" value="<? echo $row['cust_age']; ?>"></input>
												</div>
													</div>
												<!-- form-group 번호 -->
										<!-- form-group -->
										<div class="row" style="text-align:right">
										  <div class="col-lg-12" style="">
											<button type="submit" class="btn btn-theme04" id="saveButton" onclick="chkValue()">고객정보수정</button>
											</div>
										</div>
									</form>
								</div>
							


								<!-- form-panel -->
							</div>
							<!-- col-lg-12 -->
						</div>


<!-- col-lg-4 -->
        </div>
        <!-- row -->

		<form action="customerModify.php" method="get">
			<input type="hidden" name="pNo" value="<?echo $row['idx'];?>"></input>

			<div class="row mt">
			  <div class="col-lg-12" style="">
			  </div>
			  <!-- /col-lg-12 END -->
			</div>
			<!-- /row -->
			<h4><i class="fa fa-angle-right"></i>고객 상세구매 목록</h4>
			<div class="row mt" id="txtHint">
			  <div class="col-lg-12" style="">
				<section id="no-more-tables">
				  <table class="table table-bordered table-hover table-striped">
					<thead class="cf" style='background-color: #BDBDBD'>
					  <tr>
						<th class="numeric">구매일</th>
						<th class="numeric">상품코드</th>
						<th class="numeric">제품명</th>
						<th class="numeric">수량</th>
					  </tr>
					</thead>
					<tbody>
					  <?

						$query1 = "select * from wine_customer_detail where phone_num = '".$row['phone_num']."'";
						$conn->DBQ($query1);
						$conn->DBE();
					    while($row1 = $conn->DBF())
					    {
					  ?>
						<tr>
						  <td class="numeric" data-title="구매일"><?echo $row1['pur_date'];?></td>
						  <td class="numeric" data-title="상품코드"><?echo $row1['product_code'];?></td>
						  <td class="numeric" data-title="제품명"><?echo $row1['product_name'];?></td>
						  <td class="numeric" data-title="수량"><?echo $row1['in_out_cnt'];?></td>

						</tr>
					<?}?>
					</tbody>
				  </table>
				</section>
			  </div>
			  <!-- /col-lg-12 END -->
			</div>
        <!-- /row -->

	    </form>


        <!-- /row -->

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

      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <?$layout->js($js);?>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
