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
		//	$complete = '<script>location.href="../../orderbook.php";</script>';//�Ϸ� �� �̵�������

	$conn = new DBC; //PDO ��ü ���� (��ü�� �����ؾ� DBŬ���� ���(�Լ�) ��� �����մϴ�.)
	$conn->DBI(); //DB ����
	

	try{
		$conn->DBQ($query); //���� ����(�Ű������� ���� �����ؾ� �˴ϴ�.)

		$conn->result->bindParam(':order_code', $order_code); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':order_cate', $order_cate); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':com_code', $com_code); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':com_name', $com_name); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':store_name', $store_name); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':m_name', $m_name); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':input_date', $input_date); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':due_date', $due_date); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':order_state', $order_state); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':ware_code', $ware_code); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':order_flag', $order_flag); //���ε� ������ �� ���� ����
		$conn->result->bindParam(':memo', $memo); //���ε� ������ �� ���� ����



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
			$conn->DBQ($sql); //���� ����(�Ű������� ���� �����ؾ� �˴ϴ�.)
			$conn->result->bindParam(':order_code', $order_code); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':order_cate', $order_cate); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':product_code', $product_code[$i]); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':product_name', $product_name[$i]); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':unit_price', $unit_price[$i]); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':order_cnt', $order_cnt[$i]); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':sup_price', $sup_price[$i]); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':surtax', $surtax[$i]); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':sale', $sale[$i]); //���ε� ������ �� ���� ����
			$conn->result->bindParam(':all_price', $all_price); //���ε� ������ �� ���� ����
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