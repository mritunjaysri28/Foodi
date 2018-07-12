<?php
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

class Validate {

	//insert cart
	function addcart($disc, $price) {
		global $conn;
		if ($_SESSION['email']!=NULL && $_SESSION['categary']=="USER" && $_SESSION['status']=="ACTIVE") {
			$sq = 'SELECT prod_stock FROM product where prod_id = :prod_id';
			$sm=$conn->prepare($sq);
			if ( $sm->execute( Array ( ":prod_id"=>$_POST['prod_id'] ) ) ) {
				if($sm->rowCount()>0) {
					$ro=$sm->fetch(PDO::FETCH_OBJ);
					if ($ro->prod_stock >= $_POST['quant']) {
						$sql = 'INSERT INTO cart VALUES (:cart, :user_id, :prod_id, :quant, :disc, :price)';
						$smt = $conn->prepare($sql);
						if ( $smt->execute( array (":cart"=>uniqid("cart0000"), ":user_id"=>$_SESSION['user_id'], ":prod_id"=>$_POST['prod_id'], ":quant"=>$_POST['quant'], ":disc"=>$disc, ":price"=>$price ) ) ) {
							if($smt->rowcount()>0) {
								echo '<script>alert("Product added to cart!")</script>';
							} else {
								echo '<script>alert("try again")</script>';
								}
						} else {
							echo '<script>alert("Some thing went wrong!")</script>';
						}
					} else {
						echo '<script>alert("Order is more then Avilable stock!")</script>';
					}
				} else {
					echo '<script>alert("try again!")</script>';
				}
			} else {
				echo '<script>alert("Some thing went wrong!")</script>';
			}
		} else {
			echo '<script>window.location.href = "Authentication/shop-signin.php";</script>';
		}
	}

	//contact
	function contact() {
		global $conn;
		$name =  $_POST['name'];
		$email = $_POST['email'];
		$mssg = $_POST['mssg'];
		if ( $_SESSION['user_id'] != NULL ) {
			$user = $_SESSION['user_id'];
		} else {
			$user = "VISITOR";
		}
		$smt = $conn->prepare("insert into contact values (:user, :name, :email, :mssg)");
		if ( $smt->execute( array (":user"=>$user, ":name"=>$_POST['name'], ":email"=>$_POST['email'], ":mssg"=>$_POST['mssg']) ) ) {
			if ( $smt->rowcount() > 0 ) {
				$_SESSION['conmail'] = "Form Submited";
				$to = "$mail";
				$subject = "Big Baig";
					$txt = "$output";
					$header = "From: .Foodi.";
					mail($to,$subject,$txt,$header);
			} else {
				$_SESSION['conmail'] = "try again";
			}
		} else {
			$_SESSION['conmail'] = "Some thing went wrong".$user." ".$$_POST['name']." ".$_POST['email']." ".$_POST['mssg'];
		}
	}



}
?>
