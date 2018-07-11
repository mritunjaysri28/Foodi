<?php session_start();
//action.php
if(isset($_POST["action"])) {
 $connect = mysqli_connect("localhost", "root", "", "vegetable");

//fetch user
if($_POST["action"] == "fetch") {
	$query = "select `user_id`,`fname`,`lname`,`email`,`contact`,`alter_contact`,`status` from user_details where categary ='".$_POST['categ']."'";
	$result = mysqli_query($connect, $query);

	$output = '
				<table class="table table-bordered table-striped" style="width:auto">
		<tr>
			<th width="auto">User_id</th>
			<th width="auto">Name</th>
			<th width="auto">Email</th>
			<th width="auto">Contact</th>
			<th width="auto">Alternate Contact</th>
			<th width="auto">Status</th>
		</tr>
			';
	while($row = mysqli_fetch_array($result)) {
		$output .= '
                    <tr>
			<td width="auto">'.$row['user_id'].'</td>
			<td width="auto">'.$row['fname'].' '. $row['lname'].'</td>
			<td width="auto">'.$row['email'].'</td>
			<td width="auto">'.$row['contact'].'</td>
			<td width="auto">'.$row['alter_contact'].'</td>
			<td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["user_id"].'">'.$row['status'].'</button></td>
		</tr>
					';
	}

	$output .= '</table>';
	echo $output;
}

//blockk user
if($_POST["action"] == "delete") {
	$query = "select status from user_details where user_id = '".$_POST["image_id"]."'";
	if($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result);
		if ($row['status'] == "ACTIVE" ) {
			$status = "BLOCK";
		} else {
			$status = "ACTIVE";
		}
		$quer = "update user_details set status = '".$status."' where user_id = '".$_POST["image_id"]."'";
		if(mysqli_query($connect, $quer)) {
			echo "Status Change";
		}
	} else {
		echo "try again";
	}
}

//fetch Categary
if($_POST["action"] == "fetchcateg") {
	$query = "SELECT categ_id, `categ_name`, `section` FROM `categary` ORDER BY categ_id DESC";
		$result = mysqli_query($connect, $query);
		$prod = '<table class="table table-bordered table-striped" style="width:auto">
					<tr>
						<th width="auto">Categ_id</th>
						<th width="auto">Categary Name</th>
						<th width="auto">Section</th>
					</tr>
				';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.'<tr>
						<td width="auto">'.$row['categ_id'].'</td>
						<td width="auto">'.$row['categ_name'].'</td>
						<td width="auto">'.$row['section'].'</td>
						<td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["categ_id"].'">REMOVE</button></td>
					</tr>';
		}
		echo $prod.'</table>';
}

//delete Categary
if($_POST["action"] == "categ") {
	$query = "DELETE FROM categary WHERE categ_id = '".$_POST["image_id"]."'";
	if($result = mysqli_query($connect, $query)) {
		$_SESSION['add_categ'] = " ";
		echo "Categary Sussfully removed";
	} else {
		echo "try again";
	}
}


}
?>
