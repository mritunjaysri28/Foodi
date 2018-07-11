<?php session_start();
//print_invoice.php

 require_once 'pdf.php';
$connect = mysqli_connect("localhost", "root", "", "vegetable");
$output = '';
 $u = $_SESSION['user_id'];
 $p = $_GET['image_id'];
 $o = $_GET['ord'];

$query = "SELECT order_name, order_address, order_id, d_date, medium FROM prod_order WHERE prod_id = '".$p."' AND user_id = '".$u."'";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)) {
	$output = '
				<table width="100%" border="1" cellpadding="5" cellspacing="0">
					<tr>
						<td colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="100%" cellpadding="5">
								<tr>
									<td width="65%">
										To,<br />
										<b>RECEIVER (BILL TO)</b><br />
										Name : '.$row['order_name'].'<br />
										Billing Address : '.$row['order_address'].'<br />
									</td>
									<td width="35%">
										Reverse Charge<br />
										Invoice No. : '.$row['order_id'].'<br />
										Invoice Date : '.$row['d_date'].'<br />
										Payment status : '.$row['medium'].'<br />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<br />
				';

}

$query = "SELECT
		product.prod_ename as prod_ename, product.weight as weight, prod_order.`prod_quant`as prod_quant, prod_order.`price` as prod_price, prod_order.`disc`as prod_disc
		FROM
		prod_order INNER JOIN product
		ON
		prod_order.prod_id = product.prod_id
		WHERE
		prod_order.prod_id = '".$p."' AND prod_order.user_id = '".$u."' AND order_id = '".$o."'";
$result = mysqli_query($connect, $query);
while($row = mysqli_fetch_array($result)) {
	$output = $output.'
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
					<tr>
						<th>Product Name</th>
						<th>Quantity</th>
						<th>Gross Amount</th>
						<th>Discount Amount</th>
						<th>Total</th>
					</tr>
				<tr>
					<td>'.$row['prod_ename'].'</td>
					<td>'.$row['prod_quant'].' X '.$row['weight'].'</td>
					<td>'.$row['prod_price'].'</td>
					<td>'.$row['prod_disc'].'</td>
					<td>'.($row['prod_price'] - $row['prod_disc']).'</td>
				</tr>
				<tr>
					<td align="right" colspan="4"><b>Total</b></td>
					<td align="right"><b>'.($row['prod_price'] - $row['prod_disc']).'</b></td>
				</tr>
			</table>
			';
}
 $pdf = new Pdf();
 $file_name = 'Invoice-'.$row["order_no"].'.pdf';
 $pdf->loadHtml($output);echo $file_name;
 $pdf->render();
 $pdf->stream('file_name.pdf');
 //$output = $pdf->output();



?>
