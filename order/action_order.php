<?php session_start();
//action.php
if(isset($_POST["action"])) {
 $connect = mysqli_connect("localhost", "root", "", "vegetable");

//fetch product
if($_POST["action"] == "fetch") {
	$query = "SELECT prod_order.order_id as order_id, product.prod_ename as prod_ename, product.prod_hname as prod_hname, product.weight as weight, prod_order.d_time as time, prod_order.prod_quant as quant, prod_order.price as price, prod_order.disc as disc, prod_order.status as status, prod_order.order_contact as contact, prod_order.order_acontact as acontact, prod_order.order_address as address, prod_order.order_pincode as pincode
FROM
prod_order INNER JOIN product
ON
prod_order.prod_id = product.prod_id
ORDER BY prod_order.status DESC";

	$result = mysqli_query($connect, $query);
	$output = '
				<table class="table table-bordered table-striped" style="width:auto">
				<tr>
					<th width="auto">Order_id</th>
					<th width="auto">Product_name</th>
					<th width="auto">Delivery Time</th>
					<th width="auto">Qunatity</th>
					<th width="auto">Unit Price (₹)</th>
					<th width="auto">Contact</th>
					<th width="auto">Alternate Contact</th>
					<th width="auto">Address</th>
					<th width="auto">Pincode</th>
					<th width="auto">Status</th>
				</tr>
			';
	while($row = mysqli_fetch_array($result)) {
		$output .= '
						<tr>
							<td width="auto" class="prod_price">'.$row["order_id"].'</td>
							<td width="auto">'.$row['prod_ename'].' - '.$row['prod_hname'].'</td>
							<td width="auto">'.$row["time"].'</td>
							<td width="auto">'.$row["quant"].' X '.$row["weight"].'</td>
							<td width="auto">'.($row["price"]).'</td>
							<td width="auto">'.$row["contact"].'</td>
							<td width="auto">'.$row["acontact"].'</td>
							<td width="auto">'.$row["address"].'</td>
							<td width="auto">'.$row["pincode"].'</td>
							<td width="auto" class="prod_stock">'.$row["status"].'</td>';?>
							<?php if ($row['status'] == "CANCELLED" || $row['status'] == "DELEVERED") {
							} else {
								if ($row['status'] != "Out for Delivery") {
									$output = $output.'<td><button type="button" name="update" style="background-color:#331F00" class="btn btn-danger bt-xs update" id="'.$row["order_id"].'">Confirm</button></td>';
								} else {
									$output = $output.'<td><button type="button" name="delevered" style="background-color:#163317" class="btn btn-danger bt-xs delevered" id="'.$row["order_id"].'">Delivered</button></td>';
								}
								$output = $output.'<td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["order_id"].'">Cancel</button></td>';
							}
						$output = $output.'</tr>';
	}
	$output .= '</table>';
	echo $output;
}

//update order
if($_POST["action"] == "update" ) {

	$quer = "SELECT prod_order.order_email as order_email, product.prod_ename as prod_ename, prod_order.prod_quant as prod_quant, product.weight as weight
FROM
product INNER JOIN prod_order
ON
product.prod_id = Prod_order.prod_id
WHERE
prod_order.order_id = '".$_POST["image_id"]."'";
	$resul = mysqli_query($connect, $quer);
	while($ro = mysqli_fetch_array($resul)) {
		$mail = $ro['order_email'];
		$prod_name = $ro['prod_ename'];
		$prod_quant = $ro['prod_quant'].' '.$ro['weight'];
	}
	$query = "update prod_order set status = 'Out for Delivery' WHERE order_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Status Changed';
		$to = "$mail";
		$subject = "Welcome | Vegetable Shop";
		$txt = "Your order
				.$prod_name. .$prod_quant.
				confirmed and out for delevery";
		$header = "From: .$mail." . "\r\n".
								"CC:Foodi@gmail.com";
		mail($to,$subject,$txt,$header);
		mail("Foodi@gmail.com",$subject,$txt,$header);
	} else {
		echo "try again";
	}
}

//delever order
if($_POST["action"] == "delevered" ) {

	$quer = "SELECT prod_order.order_email as order_email, product.prod_ename as prod_ename, prod_order.prod_quant as prod_quant, product.weight as weight
FROM
product INNER JOIN prod_order
ON
product.prod_id = Prod_order.prod_id
WHERE
prod_order.order_id = '".$_POST["image_id"]."'";
	$resul = mysqli_query($connect, $quer);
	while($ro = mysqli_fetch_array($resul)) {
		$mail = $ro['order_email'];
		$prod_name = $ro['prod_ename'];
		$prod_quant = $ro['prod_quant'].' '.$ro['weight'];
	}

	$query = "update prod_order set status = 'DELEVERED' WHERE order_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Status Changed';
		$to = "$mail";
		$subject = "Welcome | Vegetable Shop";
		$txt = "Your order
				.$prod_name. .$prod_quant.
				successfully deleverd";
		$header = "From: .$mail." . "\r\n".
								"CC:Foodi@gmail.com";
		mail($to,$subject,$txt,$header);
		mail("Foodi@gmail.com",$subject,$txt,$header);
	} else {
		echo "try again";
	}
}

//delete order
if($_POST["action"] == "delete") {

		$quer = "SELECT prod_order.order_email as order_email, product.prod_ename as prod_ename, prod_order.prod_quant as prod_quant, product.weight as weight
FROM
product INNER JOIN prod_order
ON
product.prod_id = Prod_order.prod_id
WHERE
prod_order.order_id = '".$_POST["image_id"]."'";
	$resul = mysqli_query($connect, $quer);
	while($ro = mysqli_fetch_array($resul)) {
		$mail = $ro['order_email'];
		$prod_name = $ro['prod_ename'];
		$prod_quant = $ro['prod_quant'].' '.$ro['weight'];
	}

	$query = "update prod_order set status = 'CANCELLED' WHERE order_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Order Cancelled';
		$to = "$mail";
		$subject = "Welcome | Vegetable Shop";
		$txt = "Your order
				.$prod_name. .$prod_quant.
				been cancelled.";
		$header = "From: .$mail." . "\r\n".
								"CC:Foodi@gmail.com";
		mail($to,$subject,$txt,$header);
		mail("Foodi@gmail.com",$subject,$txt,$header);
	} else {
		echo "try again";
	}
}
}
?>
