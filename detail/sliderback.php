<?php session_start();

 $connect = mysqli_connect("localhost", "root", "", "vegetable");


 if ($_POST['action'] == "delete") {
	 $query = "DELETE FROM slider WHERE slider_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Slider Deleted';
	} else {
		echo "try again";
	}
 } else {
	 //intialize value
	$user_id = uniqid("SLID000");;
	$categ_id = $_POST['slider_title'];
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	$fileinfo = getimagesize($_FILES["image"]["tmp_name"]);
	$filewidth = $fileinfo[0];
	$fileheight = $fileinfo[1];
	if ($filewidth == 1250 && $fileheight == 271) {

		$query = "INSERT INTO slider VALUES ('$user_id', '$categ_id', '$file')";
		if(mysqli_query($connect, $query)) {
			echo 'Slider Sussfully Added<script>location.reload();</script>';
		} else {
			echo "try again";
		}

	} else {
		echo "image size of 1250 * 271";
	}

 }

?>
