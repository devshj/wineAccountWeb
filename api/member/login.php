<?
if($_POST['id'] == 1 && $_POST['pass'] == 1){
	echo '<script>location.href="../../dashBoard.php";</script>';
}else if(isset($_POST['emp'])){
	$emp = $_POST['emp'];
	echo "emp is dev ~ing({$emp})";
	//echo '<script>alert("emp is dev ~ing({$emp})");history.back();;</script>';
}else{
	echo '<script>alert("This is incorrect information");history.back();;</script>';
}
?>