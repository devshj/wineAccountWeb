<?
include 'layout/layout.php';
$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?//$layout->CssJsFile("<script>alert('ts');</script>");?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
    <section id="main-content">
	  <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 mt" style="min-height:1000px;"> 
            <!--CONTENT -->
<pre>
1. 최상위 폴더에는 페이지만 저장
2. 서버로직은 API에 몰아 넣기 모듈별로 폴더관리 해주면 더 좋습니다.
3. 파일이름 막 짓지 마세요 의미 있게 사용
4. 개인 작업은 워크스페이스에 자기 폴더 만들어서 사용
5. 템플릿 요소는 Dashio폴더에 있는 템플릿에서 찾아 쓰세요 수정x
6. 레이아웃 맘대로 막 수정X 
7. 페이지 상단에 주석에 어떤 페이지인지 작성
8. http://webtesting0001.dothome.co.kr/erp_system/basic_table.html 마지막 테이블 사용할 것

</pre>
			<!--CONTENT END-->
          </div>
          <!-- /col-lg-12 END -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <?//$layout->JsFile("<script>alert('ts');</script>");?>
  <?$layout->js($js);?>
</body>

</html>
