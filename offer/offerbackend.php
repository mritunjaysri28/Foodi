<?php
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

 class offerbackend {

	//Add Offer
	function addoff() {
		global $conn;
		if ($_POST['start'] < $_POST['end'] ) {
			//intialize value
			$offer_id = uniqid("Off0000");
			$offer_name = $_POST['title'];
			$offer_dis = $_POST['dis'];
			$offer_start = $_POST['start'];
			$offer_end = $_POST['end'];
			$smt = $conn->prepare("INSERT INTO offer VALUES (:offer_id, :offer_name, :offer_dis, :offer_start, :offer_end)");
			if ( $smt->execute( array (":offer_id"=>$offer_id, ":offer_name"=>$offer_name, ":offer_dis"=>$offer_dis, ":offer_start"=>$offer_start, ":offer_end"=>$offer_end) ) ) {
				if ( $smt->rowcount() > 0 ) {
					$_SESSION['offer'] = "Offer Applied";
				} else {
					$_SESSION['offer'] = "try again";
				}
			} else {
				$_SESSION['offer'] = "Some thing went wrong".$user." ".$$_POST['name']." ".$_POST['email']." ".$_POST['mssg'];
			}
		} else {
			$_SESSION['offer'] = "Date is invalid";
		}
	}

}
?>
