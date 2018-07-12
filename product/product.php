<?php session_start();
//action.php
if(isset($_POST["action"])) {
 $connect = mysqli_connect("localhost", "root", "", "vegetable");

//fetch product
if($_POST["action"] == "fetch") {
	$query = "SELECT prod_id, prod_ename, prod_hname, weight, prod_price, prod_disc, prod_stock, prod_desc FROM  product ORDER BY prod_id DESC";
	$result = mysqli_query($connect, $query);
	$output = '
				<table class="table table-bordered table-striped" style="width:100%;">
				<tr>
					<th width="auto">product_id</th>
					<th width="auto">product_name</th>
					<th width="auto">price</th>
					<th width="auto">Discount ( % )</th>
					<th width="auto">Stock</th>
					<th width="auto">Description</th>
					<th width="auto">DELETE</th>
				</tr>
			';
	while($row = mysqli_fetch_array($result)) {
		$output .= '
						<tr>
							<td>'.$row["prod_id"].'</td>
							<td width="auto">'.$row["prod_ename"].' - '.$row["prod_hname"].' '.$row["weight"].'</td>
							<td width="auto" class="prod_price" data-id1="'.$row["prod_id"].'" contenteditable>'.$row["prod_price"].'</td>
							<td width="auto" class="prod_disc" data-id2="'.$row["prod_id"].'" contenteditable>'.$row["prod_disc"].'</td>
							<td width="auto" class="prod_stock" data-id3="'.$row["prod_id"].'" contenteditable>'.$row["prod_stock"].'</td>
							<td width="30%" class="prod_desc" style="word-break:break-all;" data-id4="'.$row["prod_id"].'" contenteditable>'.$row["prod_desc"].'</td>
							<td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["prod_id"].'">Remove</button></td>
						</tr>
					';
	}
	$output .= '</table>';
	echo $output;
}

//insert product
if($_POST["action"] == "insert") {

	//intialize value
	$user_id = $_SESSION['user_id'];
	$categ_id = $_POST['categ'];
	$prod_id = uniqid("PROD000");
	$prod_ename = $_POST['prod_name_eng'];
	$prod_hname = $_POST['prod_name_hin'];
	$prod_weight = $_POST['weight'];
	$prod_price = $_POST['prod_price'];
	$prod_disc = $_POST['prod_disc'];
	$prod_stock = $_POST['prod_stock'];
	$prod_desc = $_POST['prod_desc'];
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
	$query = "INSERT INTO product VALUES ('$user_id', '$categ_id', '$prod_id', '$prod_ename', '$prod_hname', '$prod_weight', $prod_price, $prod_disc, $prod_stock, '$prod_desc', '$file')";
	if(mysqli_query($connect, $query)) {
		echo 'Product Sussfully Added';
	} else {
		echo "try again";
	}
}

//delete product
if($_POST["action"] == "delete") {
	$query = "DELETE FROM product WHERE prod_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Product Deleted';
	} else {
		echo "try again";
	}
}



}
?>
