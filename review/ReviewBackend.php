<?php
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

class ReviewBackend {

	//add review
	function addReview($id) {
		global $conn;
		$smt = $conn->prepare("insert into review values (:user_id, :prod_id, :review, :time)");
		if ( $smt->execute( array (":user_id"=>$_SESSION['user_id'], ":prod_id"=>$id, ":review"=>$_POST['rev'], ":time"=>date("y/m/d")." ".date("h:i:sa")) ) ) {
			if ( $smt->rowcount() > 0 ) {
				$_SESSION['review'] = "Review Submited";
			} else {
				$_SESSION['review'] = "try again";
			}
		} else {
			$_SESSION['review'] = "Some thing went wrong";
		}
	}

}
?>
