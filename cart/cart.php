<?php session_start();
//action.php
if(isset($_POST["action"])) {
 $connect = mysqli_connect("localhost", "root", "", "vegetable");

//fetch product
if($_POST["action"] == "fetch") {
	$query = "SELECT cart.cart_id as cart_id, product.prod_pic as prod_pic, product.prod_ename as prod_ename, product.prod_hname as prod_hname, product.weight as weight, cart.prod_quant as quant, cart.prod_id as prod_id, cart.offer_price as price, cart.offer_disc as disc
FROM
cart INNER JOIN product
ON
cart.prod_id = product.prod_id
WHERE cart.user_id = '".$_SESSION['user_id']."'";
	$result = mysqli_query($connect, $query);
	$price = 0;
	$total = 0;
	$shiping = 0;
	$output = '
				<table summary="Shopping cart">
                  <tr>
                    <th class="goods-page-image">Image</th>
                    <th class="goods-page-description">Description</th>
                    <th class="goods-page-ref-no">Product Id</th>
                    <th class="goods-page-quantity">Quantity</th>
                    <th class="goods-page-price">Unit price</th>
                    <th class="goods-page-total" colspan="2">REMOVE</th>
                  </tr>
			';
	while($row = mysqli_fetch_array($result)) {
		$output .= '
				<tr>
                    <td class="goods-page-image"><img src="data:image/jpeg;base64,'.base64_encode($row['prod_pic'] ).'" height="60" width="75" class="img-thumbnail" /></td>
                    <td class="goods-page-description">'.$row['prod_ename'].' - '.$row['prod_hname'].'</td>
                    <td class="goods-page-ref-no">'.$row["prod_id"].'</td>
                    <td class="goods-page-ref-no" style="width:auto;">
                      <div class="product-quantity" style="width:85%;">
                          <input type="text" value="'.$row['quant'].' X '.$row["weight"].'" min="1" readonly/>
                      </div>
                    </td>
                    <td class="goods-page-price"><strong><span>Rs</span>'.$row["disc"] * $row['quant'].'</strong></td>
                    <td class="del-goods-col"><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["cart_id"].'">Remove</button></td>
                  </tr>
					';
		$price = $price + ($row["disc"] * $row['quant']);
	}
	if ($price > 0) {
		$shiping = 0;
		$total = $price + $shiping;
	}
	$output .= '</table>
	<div class="checkout-total-block">
										<ul>
											<li>
												<em>Sub total</em>
												<strong class="price"><span>Rs</span>'.$price.'</strong>
											</li>
											<li>
												<em>Shipping cost</em>
												<strong class="price"><span>Rs</span>'.$shiping.'</strong>
											</li>
											<li class="checkout-total-price">
												<em>Total</em>
												<strong class="price"><span>Rs</span>'.$total.'</strong>
											</li>
										</ul>
									</div>
	';
	echo $output;
}

//delete product
if($_POST["action"] == "delete") {
	$query = "DELETE FROM cart WHERE cart_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'Product Removed';
	} else {
		echo "try again";
	}
}


}
?>
