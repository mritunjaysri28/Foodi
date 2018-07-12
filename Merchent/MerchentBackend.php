<?php session_start();
 $dbname="vegetable";
 $host="localhost";
 $user="root";
 $pass="";
 global $conn;
 $conn=new PDO("mysql:host=$host;dbname=$dbname","$user","$pass");

 class AdminBackend {

	//change profie pic
	function profilePic() {
		//set file path
		$target_dir = "../profile_pic/";

		//change file name
		$pos = strpos(basename($_FILES["fileToUpload"]["name"]),".");
		$len = strlen(basename($_FILES["fileToUpload"]["name"]));
		$ext = substr(basename($_FILES["fileToUpload"]["name"]),$pos); //file extention
		$name = chop(basename($_FILES["fileToUpload"]["name"]),$ext);//filename
		$a = $_SESSION['user_id'].$ext;

		$target_file = $target_dir . basename($a);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo '<script>alert("File is an image - " . $check["mime"] . ".")</script>';
				$uploadOk = 1;
			} else {
				echo '<script>alert("File is not an image.")</script>';
				$uploadOk = 0;
			}
		}

		// Allow certain file formats
		if($imageFileType != "jpg") {
			echo '<script>alert("Sorry, only JPG")</script>';
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo '<script>alert("Sorry, your file was not uploaded.")</script>';
			// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				if ($_SESSION['pic'] != $_SESSION['user_id'].$ext) {
					//Update Profile Pic Name in Databasse
					global $conn;
					$sql = 'UPDATE  `vegetable`.`user_details` SET  `profile_pic` = :pic WHERE CONVERT(  `user_details`.`user_id` USING utf8 ) = :user_id';
					$smt = $conn->prepare($sql);
					if ( $smt->execute( array ( ":pic"=>$_SESSION['user_id'].$ext, "user_id"=>$_SESSION['user_id'] ) ) ) {
						if($smt->rowcount()>0) {
							$_SESSION['pic'] = $_SESSION['user_id'].$ext."devil";
						} else {
							echo '<script> alert("try again") </script>';
						}
					} else {
						echo '<script>alert("Some thing went wrong!")</script>';
					}
				}
				$_SESSION['pic'] = $_SESSION['user_id'].$ext;
			} else {
				echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
			}
		}
	}

	//Add Categary
	function addCategary() {
		global $conn;
		$sql = 'INSERT INTO `vegetable`.`categary` (`categ_id`, `categ_name`) VALUES (:cate_id, :cate_name);';
		$smt = $conn->prepare($sql);
		if ( $smt->execute( array ( ":cate_id"=>uniqid("categ0000"), ":cate_name"=>$_POST['categary'] ) ) ) {
			if($smt->rowcount()>0) {
				$_SESSION['add_categ'] = "Categary Sucssfully Added";
			} else {
				$_SESSION['add_categ'] = "try again";
			}
		} else {
			$_SESSION['add_categ'] = "Some thing went wrong!";
		}
	}

	function change() {
		global $conn;
		$smt=$conn->prepare( "update user_data set password=:pass where email=:email" );
		if ( $smt->execute( array ( ":pass"=>md5($_GET['pwd']), ":email"=>$GET['email'] ) ) ) {
			if($smt->rowcount()>0) {
				echo '<script> alert("Password Change") </script>';

			} else {
				echo '<script> alert("try again") </script>';
			}
		}else {
			echo '<script>alert("Some thing went wrong!")</script>';
		}
	}





















































		//view feedback
	function viewfeed() {
		global $conn;
		$sql = 'select fname, lname, uname from user_data where DEPARTMENT=:dept';
		$smt=$conn->prepare( $sql );
		if ( $smt->execute( array ( ":dept"=>"Faculty" ) ) ) {
			while($row=$smt->fetch(PDO::FETCH_OBJ)) {
				if(count($row)>0) {
					$name = $row->fname." ".$row->lname;
					$uname = $row->uname;
					 $sq = 'select batchcode from batch where faculty =:fac';
						$sm=$conn->prepare( $sq );
						if ( $sm->execute( array ( ":fac"=>$uname ) ) ) {
							while($ro=$sm->fetch(PDO::FETCH_OBJ)) {
								if(count($row)>0) { $batch=$ro->batchcode;
									$s = 'select batchcode, sum(feedback) as feed from reg_course where batchcode=:batch group by batchcode';
									$e = $conn->prepare($s);
									if ( $e->execute(array(":batch"=>$batch))) {
										if($e->rowCount()>0) {
											$r=$e->fetch(PDO::FETCH_OBJ); $w = preg_split('#(?=[a-z])(?<=\d)#i', $batch);
?>
											<tr>
												<td align="center"><?php echo $name;?></td>
												<td align="center"><?php echo $w[1].$w[0];?></td>
												<td align="center"><?php echo $r->feed;?></td>
											</tr>
							<?php	}
								}
							}
						}
					}
				}
			}
		}
	}


}
?>
