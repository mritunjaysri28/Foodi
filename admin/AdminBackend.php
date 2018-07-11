<?php
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

 class AdminBackend {

	//Add Categary
	function addCategary() {
		global $conn;
		if ( $_POST['section'] == 'Vegetable' ) {
			$id = uniqid("VEGE0000");
		} else if ( $_POST['section'] == 'Fruit' ) {
			$id = uniqid("FRUI0000");
		} else if ( $_POST['section'] == 'Kids' ) {
			$id = uniqid("KIDS0000");
		} else if ( $_POST['section'] == 'Persnal' ) {
			$id = uniqid("PER0000");
		} else if ( $_POST['section'] == 'Home' ) {
			$id = uniqid("HOM0000");
		} else if ( $_POST['section'] == 'Grocery' ) {
			$id = uniqid("GROC0000");
		} else if ( $_POST['section'] == 'Patanjali' ) {
			$id = uniqid("PATAN0000");
		} else {
			$id = '';
		}
		$sql = 'INSERT INTO `categary` (`categ_id`, `categ_name`, `section`) VALUES (:cate_id, :cate_name, :section);';
		$smt = $conn->prepare($sql);
		if ( $smt->execute( array ( ":cate_id"=>$id, ":cate_name"=>$_POST['categary'], ":section"=>$_POST['section'] ) ) ) {
			if($smt->rowcount()>0) {
				$_SESSION['add_categ'] = "Categary Sucssfully Added";
			} else {
				$_SESSION['add_categ'] = "try again";
			}
		} else {
			$_SESSION['add_categ'] = "Some thing went wrong!";
		}
	}
}
?>
