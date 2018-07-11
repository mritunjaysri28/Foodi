<?php session_start();
//action.php
if(isset($_POST["action"])) {
 $connect = mysqli_connect("localhost", "root", "", "vegetable");

//fetch product
if($_POST["action"] == "fetch") {
	$query = "SELECT details, value FROM  details ORDER BY details DESC";
	//$query = "SELECT * FROM tbl_sample";
	$result = mysqli_query($connect, $query);
	$output = '
				<table class="table table-bordered table-striped" style="width:100%;">
				<tr>
					<th width="auto">Detail</th>
					<th width="auto">Value</th>
				</tr>
			';
	while($row = mysqli_fetch_array($result)) {
		$output .= '
						<tr>
							<td width="auto">'.$row["details"].'</td>
							<td width="auto" class="prod_price" data-id1="'.$row["details"].'" contenteditable>'.$row["value"].'</td>
						</tr>
					';
	}
	$output .= '</table>';
	echo $output;
}

//fetch product
if($_POST["action"] == "update") {
	$id = $_POST["id"];
	$text = $_POST["text"];
	$sql = 'UPDATE details SET value = "'.$text.'" WHERE details = "'.$id.'"';
	if(mysqli_query($connect, $sql)) {
		echo "Details Updated";
	} else {
		echo "try again";
	}
}

//fetch slider
if($_POST["action"] == "slider") {
	$query = "SELECT details, value FROM  details ORDER BY details DESC";
	//$query = "SELECT * FROM tbl_sample";
	$result = mysqli_query($connect, $query);
	$output = '
				<table class="table table-bordered table-striped" style="width:100%;">
				<tr>
					<th width="auto">Detail</th>
					<th width="auto">Value</th>
				</tr>
			';
	while($row = mysqli_fetch_array($result)) {
		$output .= '
						<tr>
							<td width="auto">'.$row["details"].'</td>
							<td width="auto" class="prod_price" data-id1="'.$row["details"].'" contenteditable>'.$row["value"].'</td>
						</tr>
					';
	}
	$output .= '</table>';
	echo $output;
}

}
?>
