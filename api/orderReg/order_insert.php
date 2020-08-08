<?
	require_once '../dbconn.php';

		if(isset($_POST['no'])){
			$no = $_REQUEST['no'];
			$query ="UPDATE wine_order
					 SET (order_code  = :order_code,  order_cate = :order_cate, com_code = :com_code, com_name = :com_name, store_name = :store_name,  m_name = :m_name, input_date = :input_date, due_date = :due_date, order_state = :order_state, ware_code = :ware_code, order_flag = :order_flag, memo = :memo WHERE idx = $no";

		}else{
			$query ="INSERT INTO wine_order(order_code, order_cate, com_code, com_name, store_name, m_name, input_date,due_date, order_state, ware_code, order_flag, memo)  
					 VALUES(:order_code, :order_cate, :com_code, :com_name, :store_name, :m_name, :input_date ,:due_date, :order_state, :ware_code, :order_flag, :memo)";


		

			  $sql = "INSERT INTO order_detail(order_code, order_cate, product_code, product_name, unit_price, order_cnt, sup_price, surtax, sale, all_price)  
					 VALUES(:order_code, :order_cate, :product_code, :product_name, :unit_price, :order_cnt, :sup_price, :surtax, :sale, :all_price)";
			
		}
		//	$complete = '<script>location.href="../../orderbook.php";</script>';//완료 후 이동페이지

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속
	

	try{
		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)

		$conn->result->bindParam(':order_code', $order_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':order_cate', $order_cate); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':com_code', $com_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':com_name', $com_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':store_name', $store_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':m_name', $m_name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':input_date', $input_date); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':due_date', $due_date); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':order_state', $order_state); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':ware_code', $ware_code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':order_flag', $order_flag); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정



		// UPDATE a row

		$order_code = $_POST['order_code'];
		$order_cate = $_POST['order_cate'];
		$com_code = $_POST['com_code'];
		$com_name = $_POST['com_name'];
		$m_name = $_POST['m_name'];
		$store_name = $_POST['store_name'];
		$input_date = $_POST['input_date'];
		$due_date = $_POST['due_date'];
		$order_state = $_POST['order_state'];
		$ware_code = $_POST['ware_code'];
		$order_flag = $_POST['order_flag'];
		$memo = $_POST['memo'];

		
		$conn->DBE();


		$product_code = $_POST['product_code'];
		$product_name = $_POST['product_name'];
		$unit_price = $_POST['sup_price'];
		$order_cnt = $_POST['order_cnt'];
		$sup_price = $_POST['sup_price'];
		$surtax = $_POST['surtax'];
		$sale = $_POST['sale'];
		$all_price =  "10";
		
		for($i=0; $i<count($product_code); $i++) {
			$conn->DBQ($sql); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
			$conn->result->bindParam(':order_code', $order_code); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':order_cate', $order_cate); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':product_code', $product_code[$i]); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':product_name', $product_name[$i]); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':unit_price', $unit_price[$i]); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':order_cnt', $order_cnt[$i]); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':sup_price', $sup_price[$i]); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':surtax', $surtax[$i]); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':sale', $sale[$i]); //바인드 변수로 들어갈 변수 지정
			$conn->result->bindParam(':all_price', $all_price); //바인드 변수로 들어갈 변수 지정
			$conn->DBE();
		}
		echo count($product_code);
	


	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
		echo $order_code;
		echo $order_cate;
		echo $product_code;
		echo $product_name;
		echo $unit_price;
		echo $order_cnt;
		echo $sale;
		echo $all_price;
	}

	
?>