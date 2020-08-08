<?
//재고 수불부
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

      $bNo = $_GET['sNo'];
      $query1 = "select * from wine_product where product_code = '".$bNo."'";
      $conn->DBQ($query1);
      $conn->DBE();

      $row = $conn->DBF();
      ?>
        <h3><i class="fa fa-angle-right"></i>재고 수불부</h3>
				<div class="row mt">
					<div class="col-lg-4">
            <h4> 제품명 : (  <?echo $row['product_code'];?>  )</h4>
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

				 <!-- morris -->
				 <div class="panel-body">
                  <div id="hero-graph" class="graph" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
										<svg height="342" version="1.1" width="455" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">
											<desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc>
											<defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
											<text x="42.953125" y="306" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text>
											<path fill="none" stroke="#aaaaaa" d="M55.453125,306.5H430" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
											<text x="42.953125" y="235.75" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">1,000</tspan></text>
											<path fill="none" stroke="#aaaaaa" d="M55.453125,235.5H430" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
											<text x="42.953125" y="165.5" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2,000</tspan></text>
											<path fill="none" stroke="#aaaaaa" d="M55.453125,165.5H430" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
											<text x="42.953125" y="95.24999999999997" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="3.9999999999999716" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">3,000</tspan></text>
											<path fill="none" stroke="#aaaaaa" d="M55.453125,95.5H430" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="42.953125" y="25" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">4,000</tspan></text>
											<path fill="none" stroke="#aaaaaa" d="M55.453125,25.5H430" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
											<text x="386.6595758928571" y="318.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text>
											<text x="321.5597619047619" y="318.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text>
											<text x="256.4599479166667" y="318.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2009</tspan></text>
											<text x="191.18177827380953" y="318.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2008</tspan></text><text x="126.08196428571428" y="318.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2007</tspan></text>
											<text x="60.98215029761905" y="318.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 12px sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,8)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2006</tspan></text>
											<path fill="none" stroke="#ed5565" d="M185.65275297619047,262.445C201.97229538690476,261.37368749999996,234.61138020833332,258.6521727086183,250.9309226190476,258.15975C267.2058761160714,257.6686727086183,299.755783110119,258.33537499999994,316.03073660714284,258.51099999999997C332.3056901041666,258.686625,364.8555970982143,258.74761126373625,381.13055059523805,259.56475C385.1435528273809,259.7662362637363,393.16955729166665,262.3075879120879,397.1825595238095,262.5855C401.2847395833333,262.8695879120879,409.48909970238094,262.1815625,413.59127976190473,261.81275C417.6934598214285,261.4439375,425.8978199404762,260.1794375,430,259.635" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
											<path fill="none" stroke="#4ecdc4" d="M55.453125,74.94774999999998C71.7280784970238,75.72049999999999,104.27798549107143,77.48553124999997,120.55293898809524,78.03874999999996C136.82789248511904,78.59196874999996,169.37779947916667,78.58426863885086,185.65275297619047,79.37349999999998C201.97229538690476,80.16489363885087,234.61138020833332,83.87762055403554,250.9309226190476,84.36124999999998C267.2058761160714,84.84355805403555,299.755783110119,84.03634374999999,316.03073660714284,83.23724999999999C332.3056901041666,82.43815624999999,364.8555970982143,79.34918269230766,381.13055059523805,77.96849999999998C385.1435528273809,77.62805769230766,393.16955729166665,77.26464903846153,397.1825595238095,76.35274999999999C401.2847395833333,75.42058653846152,409.48909970238094,71.80406249999997,413.59127976190473,70.59224999999998C417.6934598214285,69.38043749999997,425.8978199404762,67.64174999999997,430,66.65824999999998"
											stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
											<circle cx="185.65275297619047" cy="262.445" r="4" fill="#ed5565" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="250.9309226190476" cy="258.15975" r="4" fill="#ed5565" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="316.03073660714284" cy="258.51099999999997" r="4" fill="#ed5565" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="381.13055059523805" cy="259.56475" r="4" fill="#ed5565" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="397.1825595238095" cy="262.5855" r="4" fill="#ed5565" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="413.59127976190473" cy="261.81275" r="4" fill="#ed5565" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="430" cy="259.635" r="7" fill="#ed5565" stroke="#ffffff"
											stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="55.453125" cy="74.94774999999998" r="4" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="120.55293898809524" cy="78.03874999999996" r="4" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="185.65275297619047" cy="79.37349999999998" r="4" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="250.9309226190476" cy="84.36124999999998" r="4" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="316.03073660714284" cy="83.23724999999999" r="4" fill="#4ecdc4" stroke="#ffffff"
											stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle><circle cx="381.13055059523805" cy="77.96849999999998" r="4" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="397.1825595238095" cy="76.35274999999999" r="4" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="413.59127976190473" cy="70.59224999999998" r="4" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
											<circle cx="430" cy="66.65824999999998" r="7" fill="#4ecdc4" stroke="#ffffff" stroke-width="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></circle>
										</svg>
										<div class="morris-hover morris-default-style" style="left: 0px; top: 2px;">
											<div class="morris-hover-row-label">
												<font style="vertical-align: inherit;">
												<font style="vertical-align: inherit;">2011 년 3/4 분기</font>
											</font>
										</div>
										<div class="morris-hover-point" style="color: #689bc3">
											<font style="vertical-align: inherit;">
												<font style="vertical-align: inherit;">라이센스 수 : 3,407</font>
										</font>
									</div>
								<div class="morris-hover-point" style="color: #a2b3bf">
									<font style="vertical-align: inherit;">
										<font style="vertical-align: inherit;"> 길에서 떨어져서 : 660 </font>
									</font>
								</div>
							</div>
						</div>
          </div>


						 </div>
						 <!-- col-lg-8 end -->
					 </div>
					 <!-- row end -->
				 </div>
				 <!-- morris end -->
			<div id="printArea">
        <div class="row mt">
          <div class="col-lg-12">
            <table class="table table-bordered table-hover table-striped">
              <thead class="cf" style='background-color: #BDBDBD'>
                <tr>
                  <th class="numeric">날짜</th>
                  <th class="numeric">구분</th>
                  <th class="numeric">거래처</th>
                  <th class="numeric">창고</th>
                  <th class="numeric">입/출고단가</th>
                  <th class="numeric">입고 수량</th>
                  <th class="numeric">출고 수량</th>
                  <th class="numeric">재고 수량</th>
                  <th class="numeric">합계 금액</th>
                  <th class="numeric">비고</th>
                </tr>

                <tbody>
                  <tr>
                    <td class="numeric" data-title="날짜"></td>
                    <td class="numeric" data-title="구분"></td>
                    <td class="numeric" data-title="거래처"></td>
                    <td class="numeric" data-title="창고"></td>
                    <td class="numeric" data-title="입/출고단가"></td>
                    <td class="numeric" data-title="입고 수량"></td>
                    <td class="numeric" data-title="출고 수량"></td>
                    <td class="numeric" data-title="재고 수량"></td>
                    <td class="numeric" data-title="합계 금액"></td>
                    <td class="numeric" data-title="비고"></td>
                  </tr>
                </tbody>

                <tfoot>
                  <tr>
                    <td colspan="5" style="text-align:center;">합계</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!--/col-lg-12 -->
          </div>
					<!-- /row -->
				</div>
				<!-- /printArea -->
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
