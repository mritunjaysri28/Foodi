<?php session_start();
//action.php
if(isset($_POST["action"])) {
$connect = mysqli_connect("localhost", "root", "", "vegetable");

function menu($connect, $query) {
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)) {
		echo '<li class="list-group-item dropdown clearfix">	<a href="#" class="delete" id="'.$row["categ_id"].'" idname="'.$row["categ_name"].'">'.$row['categ_name'].'</a>	</li>';
	}
}
//brand detais call
function brand($connect, $query) {
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)) {
		echo '<img src="data:image/jpeg;base64,'.base64_encode($row['brand_pic']).'" alt="'.$row['brand_name'].'" style="margin-left:1%;">';
	}
}

//offer call
function offer($connect, $query) {
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)) {
		echo '<img src="data:image/jpeg;base64,'.base64_encode($row['brand_pic']).'" alt="'.$row['brand_name'].'" style="margin-left:1%;">';
	}
}

function show($connect, $query) {
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)) {
		if(count($row)>0) {
			echo '
			<li class="col-md-4 product-men" style="height:20%;">
				<div class="men-thumb-item crop" style="border:1px soild black;">
					<img src="data:image/jpeg;base64,'.base64_encode($row['prod_pic'] ).'"alt="'.$row['prod_ename'].' - '.$row['prod_hname'].' 1'.$row['weight'].'">
					<div class="men-cart-pro">
						<div class="inner-men-cart-pro">
							<a href="shop-item.php?image_id='.$row["prod_id"].'&&off=" class="link-product-add-cart">QUICK View</a>
						</div>
					</div>
				</div>
				<div class="item-info-product ">
					<h4>
						'.$row['prod_ename'].'<br>'.$row['prod_hname'].'<br><a style="text-transform: lowercase;">'.$row['weight'].'</a>
					</h4>
					<div class="info-product-price">
						<span class="item_price" style="color:red">₹'.$row['prod_price'].'</span>
						<del>₹'.($row['prod_price']-(($row['prod_disc']/100)*$row['prod_price'])) .'</del>
					</div>
					<br>
					<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
						<a href="shop-item.php?image_id='.$row["prod_id"].'&&off=" ><input type="submit" name="submit" value="ADD ORDER" class="button" /></a>
					</div>
				</div>
			</li>
			';
		}
	}
}
//categary
if($_POST["action"] == "CATEG") {
	$query = "SELECT categ_id, `categ_name` FROM `categary` where section = '".$_POST["image"]."'";
	$result = mysqli_query($connect, $query);
	echo menu($connect, $query);
}
//product show
if ($_POST['action'] == "PROD") {
	$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, weight, `prod_price`,`prod_disc`,`prod_id` FROM `product` WHERE categ_id LIKE '".$_POST['image']."%' AND prod_stock > 0 ORDER BY prod_id DESC LIMIT ".$_POST['start'].", ".$_POST['last']."";
	echo show($connect, $query);
}

//brand
if ($_POST['action'] == "brand") {
	$query = "SELECT brand_pic,brand_name FROM `brand` ORDER BY brand_id DESC";
	echo brand($connect, $query);
}
//details
if($_POST["action"] == "offer") {
	$query = "SELECT
product.prod_pic as prod_pic, product.prod_ename as prod_ename, product.prod_hname as prod_hname, product.weight as weight, product.prod_id as prod_id, offer_prod.offer_dis as prod_disc, offer_prod.offer_price as prod_price
FROM
product RIGHT JOIN offer_prod
ON
product.prod_id = offer_prod.prod_id
WHERE
offer_prod.offer_id = '".$_POST["image"]."' LIMIT ".$_POST['start'].", ".$_POST['last']."";
	$result = mysqli_query($connect, $query);
	echo show($connect, $query);
}
}
?>
