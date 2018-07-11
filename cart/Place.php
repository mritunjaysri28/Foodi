<?php
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

 class Place {

	//Payment
	function order() {
		global $conn;
		$count = 0;
		$output = 'Your order is sussfully placed';
		//fetch cart info
		$sql = 'SELECT prod_id, prod_quant, offer_disc, offer_price from cart WHERE user_id = :user_id';
		$smt = $conn->prepare($sql);
		if ( $smt->execute( array ( "user_id"=>$_SESSION['user_id'] ) ) ) {
			while ($row=$smt->fetch(PDO::FETCH_OBJ)) {
				if($smt->rowcount()>0) {
					$user_id = $_SESSION['user_id'];
					$prod_id = $row->prod_id;
					$prod_quant = $row->prod_quant;
					$dis = $row->offer_disc;
					$price = $row->offer_price;

					//fetch product info
					$pro = "SELECT prod_stock, prod_ename, prod_hname, weight FROM product WHERE prod_id = :prod_id";
					$respro = $conn->prepare($pro);
					if ( $respro->execute( array ( "prod_id"=>$prod_id ) ) ) {
						$repro=$respro->fetch(PDO::FETCH_OBJ);
						if ($respro->rowcount()>0) {
							$prod_stock = $repro->prod_stock;
							if ($prod_stock >= $prod_quant) {
								$order = uniqid("ORDER000");
								//prod_order adding
								$ord = 'INSERT INTO `prod_order` VALUES (:order_id, :user_id, :tran, :prod_id, :name, :email, :contact, :acontact, :address, :distrct, :pincode, :state, :country, :quant, :disc, :price, CURDATE(), :time, :status, :medium)';
								$ordsmt=$conn->prepare( $ord );
								if ( $ordsmt->execute( array ( ":order_id"=>$order, ":user_id"=>$_SESSION['user_id'], ":tran"=>"CASH ON DELIVERY", ":prod_id"=>$prod_id, ":name"=>$_POST['name'], ":email"=>$_POST['email'], ":contact"=>$_POST['contact'], ":acontact"=>$_POST['a_contact'], ":address"=>$_POST['address'], ":distrct"=>$_POST['city'], ":pincode"=>$_POST['pincode'], ":state"=>$_POST['state'], ":country"=>$_POST['country'], ":quant"=>$prod_quant, ":disc"=>$dis, ":price"=>$price, ":time"=>$_POST['d_time'], ":status"=>"PENDING", ":medium"=>$_POST['transac'] ) ) ) {
									if($ordsmt->rowcount()>0) {
										$mail = $_POST['email'];
										$count += 1;
										$output = $output.'

												Order_id :- '.$order. '.
												product_name :- '.$repro->prod_ename.' - '.$repro->prod_hname.'.
												Deleviery time :- '.$_POST['d_time']. '.
												Qunatity :- '.$prod_quant.' * '.$repro->weight.'.
												Price (Rs) :- '.$dis. '.
												Status :- PENDING. .';

										//delete from cart
										$cartdel = $conn->prepare("DELETE FROM cart WHERE user_id= :user_id AND prod_id = :prod_id");
										if ( $cartdel->execute( ( array( ":user_id"=>$user_id, ":prod_id"=>$prod_id ) ) ) ) {

											//update stock
											$quant = $prod_stock - $prod_quant;
											$stocksql = 'UPDATE `product` SET `prod_stock` = :quant WHERE CONVERT(`product`.`prod_id` USING utf8) = :prod_id';
											$stock = $conn->prepare($stocksql);
											if ( $stock->execute( array ( ":quant"=>$quant, ":prod_id"=>$prod_id ) ) ) {
												if($stock->rowcount()>0) {
													echo "<script>alert('Order Placed')</script>";
											} else {
												echo "<script>alert('Some thing went wrong in updating product!')</script>";
											}
											//end update stock

										} else {
											echo "<script>alert('Some thing went wrong in removing cart!')</script>";
										}
										//end delete from cart

									} else {
										echo "<script>alert('try again')</script>";
									}
								} else {
									echo "<script>alert('Some thing went wrong in placing prod_order!')</script>";
								}
								//end prod_order adding

							} else {
								echo "<script>alert('Only ".$prod_stock." can be placed in order')</script>";
							}
						} else {
							echo "<script>alert('Product is removed')</script>";
						}
					} else {
						echo "<script>alert('Something wrong in placing data')</script>";
					}
				} else {
					echo "<script>alert('try again')</script>";
				}
			}
		} }else {
			echo "<script>alert('Some thing went wrong!')</script>";
		}
		if($count != 0) {
			$to = $_POST['email'];
			$subject = "Big Baig | Order Successfully Placed";
			$txt = "$output";
			$header = "From: .Foodi.";
			mail($to,$subject,$txt,$header);
			mail("Foodi22@gmail.com",$subject,$txt,$header);
		}
	}
}
?>
