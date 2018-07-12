<?php session_start();
//action.php
if(isset($_POST["action"])) {
$connect = mysqli_connect("localhost", "root", "", "vegetable");

//display product
function show($result) {
	echo '<ul class="product-carousel" id="infinitScroll" producttotal="37" totalpage="1" filter="" limit="50" sort="pd.name" order="ASC" page="2" path="30">';
	$count = 0;
	while($row = mysqli_fetch_array($result)) {
		$count += 1;
		echo '
					<li style="margin-top:2%; background-color:white;">
						<div class="prod-thumb">
							<img src="data:image/jpeg;base64,'.base64_encode($row['prod_pic'] ).'" height="100%" width="70%" alt="'.$row['prod_ename'].' - '.$row['prod_hname'].' 1'.$row['weight'].'" />
						</div>
						<div style="align:center; word-break:break-all;">
						<br>
							<center><h6>'.$row['prod_ename'].'<br> '.$row['prod_hname'].' <br> '.$row['weight'].'</h6></center>
						</div>
						<div style="align:center;">
							<center><span class="price-new ondr-rate"></span>
							<span class="price-old mrp-rate">₹<span class="WebRupee"></span>'.$row['prod_price'].'</span>
							<span class="price-new ondr-rate">₹<span class="WebRupee"></span>'.($row['prod_price']-(($row['prod_disc']/100)*$row['prod_price'])) .'</span></center>
						<br>
						<center><div style=""><h6><a href="shop-item.php?image_id='.$row["prod_id"].'&&off="><button class="btn btn-primary" id="'.$row["prod_id"].'" style="width:auto; text-align:center;">ADD ORDER</button></a></h6></center></div>
						</div>
					</li>
				';
	}
	if ($count == 0) {
		//echo '<button type="button" class="btn btn-info" style="margin-top:3%;">Product will came soon....</button>';
	}
	echo '</ul>';
}

//fetch product
if($_POST["action"] == "show_product") {
	$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, lcase(weight) as weight, `prod_price`,`prod_disc`,`prod_id` FROM `product` WHERE prod_stock > 0 ORDER BY prod_id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";
	$result = mysqli_query($connect, $query);
	show($result);
}



//one categary (VEGE or FRUI)
if($_POST["action"] == "one") {
	$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, lcase(weight) as weight, `prod_price`,`prod_disc`,`prod_id` FROM `product` WHERE categ_id LIKE '".$_POST["image_id"]."%' AND prod_stock > 0 ORDER BY prod_id DESC";
	$result = mysqli_query($connect, $query);
	show($result);
}

//sub-categary product
if($_POST["action"] == "delete") {
	$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, lcase(weight) as weight, `prod_price`,`prod_disc`,`prod_id` FROM `product` WHERE categ_id = '".$_POST["image_id"]."' AND prod_stock > 0 ORDER BY prod_id DESC";
	$result = mysqli_query($connect, $query);
	show($result);
}

//similar product
if($_POST["action"] == "similar") {
	$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, lcase(weight) as weight, `prod_price`,`prod_disc`,`prod_id` FROM `product` WHERE prod_stock > 0";
	$result = mysqli_query($connect, $query);
	show($result);
}

//offer product
if($_POST["action"] == "offer") {

	$que = "SELECT prod_id, offer_dis, offer_price FROM offer_prod WHERE offer_id = '".$_POST['image_id']."'";
	$res = mysqli_query($connect, $que);
	echo '<ul class="product-carousel" id="infinitScroll" producttotal="37" totalpage="1" filter="" limit="50" sort="pd.name" order="ASC" page="2" path="30">';
	while($ro = mysqli_fetch_array($res)) {
		$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, lcase(weight) as weight, `prod_id` FROM `product` WHERE prod_id = '".$ro['prod_id']."' AND prod_stock > 0 ORDER BY prod_id DESC LIMIT 0, 6";
		$result = mysqli_query($connect, $query);
		while($row = mysqli_fetch_array($result)) {
			echo '
				<li style="margin-top:2%; background-color:white;">
	<div class="prod-thumb">
		<img src="data:image/jpeg;base64,'.base64_encode($row['prod_pic'] ).'" height="100%" width="70%" alt="'.$row['prod_ename'].' - '.$row['prod_hname'].' 1'.$row['weight'].'" />
	</div>
	<div style="align:center; word-break:break-all;">
		<br>
		<center><h6>'.$row['prod_ename'].'<br> '.$row['prod_hname'].' <br> '.$row['weight'].'</h6></center>
	</div>
	<div style="align:center;">
		<center><span class="price-new ondr-rate"></span>
		<span class="price-old mrp-rate">₹<span class="WebRupee"></span>'.$ro['offer_price'].'</span>
		<span class="price-new ondr-rate">₹<span class="WebRupee"></span>'.($ro['offer_price'] - ( ($ro['offer_dis'] / 100) * $ro['offer_price'] )).'</span></center>
	</div>
	<br>
	<center><a href="shop-item.php?image_id='.$row["prod_id"].'&&off=OFFER"><button class="btn btn-primary" id="'.$row["prod_id"].'" style="width:auto; text-align:center;">ADD ORDER</button></a></center>
</li>
				';
		}
	}
	echo '</ul>';
}

//insert product
if($_POST["action"] == "insert") {
	//product name in english validation
	if (!preg_match("/^[a-zA-Z'-]+$/",$_POST['prod_name_eng'])) {
		$_SESSION['add_prod'] = "English Product name is not valid";
	} else {
		//product name in hindi validation
		if (!preg_match("/^[a-zA-Z'-]+$/",$_POST['prod_name_hin'])) {
			$_SESSION['add_prod'] = "Hindi Product name is not valid";
		} else {
			//intialize value
			$user_id = $_SESSION['user_id'];
			$categ_id = $_POST['categ'];
			$prod_id = uniqid("PROD000");
			$prod_name = $_POST['prod_name_eng']." - ".$_POST['prod_name_hin'];
			$prod_price = $_POST['prod_price'];
			$prod_disc = $_POST['prod_disc'];
			$prod_stock = $_POST['prod_stock'];
			$prod_desc = $_POST['prod_desc'];
			$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
			$query = "INSERT INTO product VALUES ('$user_id', '$categ_id', '$prod_id', '$prod_name', $prod_price, $prod_disc, $prod_stock, '$prod_desc', '$file')";
			if(mysqli_query($connect, $query)) {
				echo 'Product Sussfully Added';
			} else {
				echo "try again";
			}
		}
	}
}




}
?>
