<?php
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

class Validate {

	//regiester
	function reg($dept) {
		global $conn;
		$id = uniqid("USER000");
		$sql = 'INSERT INTO `user_details` VALUES (:id, :fname, :lname, :email, :pwd, :contact, :alter_contact, :address, :distict, :state, :country, :pincode, :categ, :pic, :status, :otp, :time)';
		$smt=$conn->prepare( $sql );
		if ( $smt->execute( array ( ":id"=>$id, ":fname"=>$_POST['fname'], ":lname"=>$_POST['lname'], ":email"=>$_POST['email'], ":pwd"=>md5($_POST['pwd']), ":contact"=>$_POST['contact'], ":alter_contact"=>$_POST['a_contact'], ":address"=>$_POST['address'], ":distict"=>$_POST['city'], ":state"=>$_POST['state'], ":country"=>$_POST['country'], ":pincode"=>$_POST['pincode'], ":categ"=>$dept, ":pic"=>$id, ":status"=>"ACTIVE", ":otp"=>rand(100000,999999), ":time"=>date("Y-m-d H:i:s") ) ) ){
			if($smt->rowcount()>0) {
				$mail = $_POST['email'];
				if ($dept == "USER") {
					header("location:shop-signin.php");
					$to = "$mail";
					$subject = "Welcome | Foodi.com";
					$txt = "Welcome to Foodi.com your Regestration is Successfull";
					$header = "From: .Foodi.";
					mail($to,$subject,$txt,$header);
				} else {
					header("location:shop-merchent-signin.php");
					$to = "$mail";
					$subject = "Welcome | Foodi";
					$txt = "Welcome to Vegetable shop your Regestration is Successfull";
					$header = "From: .$mail." . "\r\n".
							"CC:$mail";
					mail($to,$subject,$txt,$header);
				}
			} else {
				$_SESSION['reg'] = "try again";
			}
		}else {
			$_SESSION['reg'] = "Some thing went wrong!";
		}
	}

	//login
	function login($dept) {
		global $conn;
		$sql = 'SELECT user_id, fname, lname, email, password, contact, alter_contact, address, distict, state, country, pincode, profile_pic, categary, status FROM `user_details` where email = :email and password = :pwd and categary = :cat and status = :status';
		$smt=$conn->prepare($sql);
		if ( $smt->execute( Array ( ":email"=>$_POST['email'], ":pwd"=>md5($_POST['pwd']), ":cat"=>$dept ,":status"=>"ACTIVE" ) ) ) {
			if($smt->rowCount()>0) {
				$row=$smt->fetch(PDO::FETCH_OBJ);
				$_SESSION['user_id'] = $row->user_id;
				$_SESSION['fname'] = $row->fname;
				$_SESSION['lname'] = $row->lname;
				$_SESSION['email'] = $row->email;
				$_SESSION['contact'] = $row->contact;
				$_SESSION['a_contact'] = $row->alter_contact;
				$_SESSION['address'] = $row->address;
				$_SESSION['distict'] = $row->distict;
				$_SESSION['state'] = $row->state;
				$_SESSION['country'] = $row->country;
				$_SESSION['pincode'] = $row->pincode;
				$_SESSION['pic'] = $row->profile_pic;
				$_SESSION['categary'] = $row->categary;
				$_SESSION['status'] = $row->status;
				if ($_SESSION['categary'] == "MERCHENT") {
					header("location:../Merchent/shop-merchent-profile.php");
				} else if ($_SESSION['categary'] == "ADMIN") {
				    echo "<script>window.location.href = '../admin/shop-admin-profile.php';</script>";
				} else if ($_SESSION['categary'] == "USER") {
				    echo "<script>window.location.href = '../Customer/shop-Myaccount.php';</script>";
				} else {
					echo '<script>alert("Invalid User!")</script>';
				}
			} else {
				echo '<script>alert("Check your user name and password!")</script>';
			}
		} else {
			echo '<script>alert("Some thing went wrong!")</script>';
		}
	}

	//verify email
	function check($dept) {
		$name = !empty($_POST['name'])?$_POST['name']:'';
		$email = !empty($_POST['email'])?$_POST['email']:'';
		$message = !empty($_POST['message'])?$_POST['message']:'';
		global $conn;
		$sql = 'SELECT email FROM `user_details` where email = :email and status = :status';
		$smt=$conn->prepare($sql);
		if ( $smt->execute( Array ( ":email"=>$_POST['email'],":status"=>"ACTIVE" ) ) ) {
			if($smt->rowCount()>0) {
				$row = $smt->fetch(PDO::FETCH_OBJ);
				$mail = $row->email;
				$otp = rand(100000,999999);
				$s = 'UPDATE `user_details` SET `OTP` = :otp, `senttime` = NOW() WHERE `email` = :email';
				$sm=$conn->prepare($s);
				if ( $sm->execute( array ( ":otp"=>$otp, ":email"=>$mail ) ) ) {
					if($sm->rowcount()>0) {
						$to = "$mail";
						$subject = "OTP | Foodi";
						$txt = "OTP: $otp";
						$header = "From: .Foodi.";
						if (mail($to,$subject,$txt,$header)){
							echo '<script>alert("OTP send to your regestered mail!");</script>';
							$url = "change.php?fir=".$mail;
							echo "<script>window.location.href = '$url';</script>";
						} else {
							echo '<script>alert("OTP not sent | try after some time!")</script>';
						}
					} else {
						echo '<script>alert("try after some time!")</script>';
					}
				} else {
					echo '<script>alert("OTP not created!")</script>';
				}
			} else {
				echo '<script>alert("Not an Regetered mail!")</script>';
			}
		} else {
			echo '<script>alert("Some thing went wrong!")</script>';
		}
	}

	//uppdate password
	function change($email) {
		$name = !empty($_POST['name'])?$_POST['name']:'';
		$email = !empty($_POST['email'])?$_POST['email']:'';
		$message = !empty($_POST['message'])?$_POST['message']:'';
			global $conn;
			$sql = 'SELECT email FROM `user_details` where email = :email and status = :status and OTP = :otp and NOW() <= DATE_ADD(senttime, INTERVAL 10 MINUTE)';
			$smt=$conn->prepare($sql);
			if ( $smt->execute( Array ( ":email"=>'mritunjaysri28@gmail.com', ":status"=>"ACTIVE", ":otp"=>'317629' ) ) ) {
				if($smt->rowCount()>0) {
					$row=$smt->fetch(PDO::FETCH_OBJ);
					//update password
					$sm=$conn->prepare( "update user_details set password=:pass where email=:email" );
					if ( $sm->execute( array ( ":pass"=>md5($_POST['pwd']), ":email"=>$email ) ) ) {
						if($sm->rowcount()>0) {echo '<script>alert("d")</script>';
							header("location:shop-signin.php");
						} else {
							echo '<script> alert("Password not Updated | try again!") </script>';
						}
					} else {
						echo '<script>alert("try again!")</script>';
					}
				} else {
					echo '<script>alert("OTP not match!")</script>';
				}
			} else {
				echo '<script>alert("OTP EXPIRE!!")</script>';
			}
	}
}
?>
