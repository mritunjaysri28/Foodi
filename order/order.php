<?php session_start();
//action.php
if(isset($_POST["action"])) {
 $connect = mysqli_connect("localhost", "root", "", "vegetable");

//fetch product
if($_POST["action"] == "fetch") {
	$query = "SELECT prod_order.order_id as order_id, product.prod_pic as prod_pic, product.prod_ename as prod_ename, product.prod_hname as prod_hname, product.weight as weight, prod_order.d_time as trans_id, prod_order.prod_quant as quant, prod_order.prod_id as prod_id, prod_order.price as price, prod_order.disc as disc, prod_order.status as status
FROM
prod_order INNER JOIN product
ON
prod_order.prod_id = product.prod_id
WHERE
prod_order.user_id = '".$_SESSION['user_id']."'
ORDER BY prod_order.order_id DESC";

	$result = mysqli_query($connect, $query);
	echo '
				<table class="table table-bordered table-striped" style="width:auto">
				<tr>
					<th width="auto">Order_id</th>
					<th width="auto">product</th>
					<th width="auto">product_name</th>
					<th width="auto">Deleviery time</th>
					<th width="auto">Qunatity</th>
					<th width="auto">Price (Rs)</th>
					<th width="auto">Status</th>
					<th width="auto">Cancel</th>
					<th width="auto">Review</th>
					<th width="auto">Invoice</th>
				</tr>
			';
	while($row = mysqli_fetch_array($result)) {
		echo '
						<tr>
							<td width="auto" class="prod_price">'.$row["order_id"].'</td>
							<td width="auto"> <img src="data:image/jpeg;base64,'.base64_encode($row['prod_pic'] ).'" height="60" width="75" class="img-thumbnail" /> </td>
							<td width="auto">'.$row['prod_ename'].' - '.$row['prod_hname'].'</td>
							<td width="auto">'.$row["trans_id"].'</td>
							<td width="auto">'.$row["quant"].' X '.$row["weight"].'</td>
							<td width="auto">'.$row['disc'].'</td>
							<td width="auto">'.$row["status"].'</td>';?>
							<?php if ($row['status'] == "DELEVERED") {
								echo '<td>--</td>';
								echo '<td width="auto"><button type="button" name="delete" style="background-color:#2196F3" class="btn btn-danger bt-xs delete" id="'.$row["prod_id"].'">Review</button></td>';
								echo '<td width="auto"><a href="../invoice/invoice.php?image_id='.$row["prod_id"].'&&ord='.$row["order_id"].'" target="blank">Invoice</a></td>';
							} else if ($row['status'] == "CANCELLED") {
								echo '<td>--</td>';
								echo '<td>--</td>';
								echo '<td>--</td>';
							} else {
								echo '<td width="auto"><button type="button" name="update" style="background-color:#2196F3" class="btn btn-danger bt-xs update" id="'.$row["order_id"].'">Cancel</button></td>';
								echo '<td>--</td>';
								echo '<td>--</td>';
							}
						echo '</tr>';
	}
	echo '</table>';
}

//status product
if($_POST["action"] == "status") {
	$query = "update prod_order set status = '".$_POST['text']."' WHERE order_id = '".$_POST["id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Status Changed';
	} else {
		echo "try again";
	}
}

//Cancel product
if($_POST["action"] == "update") {
	$query = "update prod_order set status = 'CANCELLED' WHERE order_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Status Changed';
	} else {
		echo "try again";
	}
}

}
?>
