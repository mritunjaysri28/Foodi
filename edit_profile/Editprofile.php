<?php
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

 class Editprofile {

	//Update profile
	function updateProfile() {
		global $conn;
		$sql = 'UPDATE  `vegetable`.`user_details` SET  `fname` = :fname,`lname` = :lname,`email` = :email,`contact` = :contact,`alter_contact` = :alter_contact WHERE CONVERT(  `user_details`.`user_id` USING utf8 ) = :user_id';
		$smt = $conn->prepare($sql);
		if ( $smt->execute( array ( ":fname"=>$_POST['fname'], ":lname"=>$_POST['lname'], ":email"=>$_POST['email'], ":contact"=>$_POST['contact'], ":alter_contact"=>$_POST['alter_contact'], "user_id"=>$_SESSION['user_id'] ) ) ) {
			if($smt->rowcount()>0) {
				$_SESSION['fname'] = $_POST['fname'];
				$_SESSION['lname'] = $_POST['lname'];
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['contact'] = $_POST['contact'];
				$_SESSION['a_contact'] = $_POST['alter_contact'];
				$_SESSION['edit_prof'] = "Profile Updated";
			} else {
				$_SESSION['edit_prof'] = "try again";
			}
		} else {
			$_SESSION['edit_prof'] = "Some thing went wrong!";
		}
	}

	//Update Address
	function updateAddress() {
		global $conn;
		$sql = 'UPDATE  `vegetable`.`user_details` SET  `address` = :address, `distict` = :district, `state` = :state, `pincode` = :pincode WHERE CONVERT(  `user_details`.`user_id` USING utf8 ) = :user_id';
		$smt = $conn->prepare($sql);
		if ( $smt->execute( array ( ":address"=>$_POST['address'], ":district"=>$_POST['district'], ":state"=>$_POST['state'], ":pincode"=>$_POST['pincode'], "user_id"=>$_SESSION['user_id'] ) ) ) {
			if($smt->rowcount()>0) {
				$_SESSION['address'] = $_POST['address'];
				$_SESSION['district'] = $_POST['district'];
				$_SESSION['state'] = $_POST['state'];
				$_SESSION['pincode'] = $_POST['pincode'];
				$_SESSION['edit_addr'] = "Address Updated";
			} else {
				$_SESSION['edit_addr'] = "try again";
			}
		} else {
			$_SESSION['edit_prof'] = "Some thing went wrong!";
		}
	}

	//view email
	function email() {
		global $conn;
		$sql = 'select email from user_data where department not in ("admin")';
		$smt=$conn->prepare( $sql );
		if ( $smt->execute())  {
			while($row=$smt->fetch(PDO::FETCH_OBJ)) {
				if(count($row)>0) {
					?>
					<option value="<?php echo $row->email;?>"><?php echo $row->email;?></option>
					<?php
			  	}
			}
		}
	}

}
?>
