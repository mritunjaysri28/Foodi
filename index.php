<?php session_start();
$connect = mysqli_connect("localhost", "root", "", "vegetable");
$query = "SELECT value FROM `details` where details IN('contact','email','address')";
$prod = array('','');
$result = mysqli_query($connect, $query);
$i = 0;
while($row = mysqli_fetch_array($result)) {
	$prod[$i] = $row['value'];
	$i += 1;
}
function make_query($connect) {
	$query = "SELECT slider_title, slider_image FROM slider ORDER BY slider_id";
	$result = mysqli_query($connect, $query);
	return $result;
}
function make_slide_indicators($connect) {
	$output = '';
	$count = 0;
	$result = make_query($connect);
	while($row = mysqli_fetch_array($result)) {
		if($count == 0) {
			$output .= '<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>';
		} else {
			$output .= '<li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>';
		}
		$count = $count + 1;
	}
	return $output;
}
function make_slides($connect) {
	$output = '';
	$count = 0;
	$result = make_query($connect);
	while($row = mysqli_fetch_array($result)) {
		if($count == 0) {
			$output .= '<div class="item active" style="height:2%;">';
		} else {
			$output .= '<div class="item" style="height:2%;">';
		}
			$output .= '<img src="data:image/jpeg;base64,'.base64_encode($row["slider_image"] ).'" width="100%" alt="'.$row["slider_title"].'"/>
						<div class="carousel-caption">
							<h3></h3>
						</div>
					</div>';
			$count = $count + 1;
	}
	echo $output;
}
function offer($connect) {
	$query = "SELECT offer_id, offer_name, offer_dis FROM offer WHERE CURDATE() >= offer_start AND CURDATE() <= offer_end";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)) {
		echo '
			<div class="agileinfo-ads-display col-md-12">
				<div class="wrapper">
					<div class="product-sec1">
						<h3 class="heading-tittle">'.$row['offer_name'].'</h3>
						<div style="text-align:center;"><i class="heading-tittle">( '.$row['offer_dis'].' )</i></div>
		';
		$que = "SELECT prod_id, offer_dis, offer_price FROM offer_prod WHERE offer_id = '".$row['offer_id']."' LIMIT 0,3";
		$res = mysqli_query($connect, $que);
		while($ro = mysqli_fetch_array($res)) {
			echo offer_prod($connect, $ro['prod_id'], ($ro['offer_price'] - ( ($ro['offer_dis'] / 100) * $ro['offer_price'] )));
  		}
		echo '
			<div class="clearfix"></div>
			<div class="snipcart-details" style="margin-top:1%;"><input type="submit" id="'.$row['offer_id'].'" idname="'.$row['offer_name'].'" value="VIEW ALL" class="button viewoffer" /></div>
				</div>
			</div>
		</div>
			';
	}
}
function offer_prod($connect, $id, $price) {
	$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, `weight`, `prod_price`, `prod_id` FROM `product` WHERE prod_id = '".$id."' AND prod_stock > 0 ORDER BY prod_id DESC";
	$result = mysqli_query($connect, $query);
	while($row = mysqli_fetch_array($result)) {
		echo '
<li class="col-md-4 product-men">
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
			<del>₹'.$price.'</del>
		</div>
		<br>
		<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
			<a href="shop-item.php?image_id='.$row["prod_id"].'&&off=OFFER" ><input type="submit" name="submit" value="ADD ORDER" class="button" /></a>
		</div>
	</div>
</li>
		';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Foodi</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">
  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-">
  <meta property="og:url" content="-CUSTOMER VALUE-">
  <link rel="shortcut icon" href="assets/corporate/img/logos/logo-shop-red.png"type="image/x-icon">

  <link href="css/css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />

  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css" type="text/css">

  <style>.container{margin:0 auto;max-width:1280px;width:90%}</style>
  <script>function lightbg_clr(){$("#qu").val(""),$("#textbox-clr").text(""),$("#search-layer").css({width:"auto",height:"auto"}),$("#livesearch").css({display:"none"}),$("#qu").focus()}function fx(e){var t,n=document.getElementById("qu").value;if(0==e.length)return document.getElementById("livesearch").innerHTML="",document.getElementById("livesearch").style.border="0px",document.getElementById("livesearch").style.display="block",void $("#textbox-clr").text("");(t=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP")).onreadystatechange=function(){4==t.readyState&&200==t.status&&(document.getElementById("livesearch").innerHTML=t.responseText,document.getElementById("livesearch").style.display="block",$("#textbox-clr").text("X"))},t.open("GET","call_ajax.php?n="+n,!0),t.send()}</script>
<style>
.crop {
	position:relative;
	width:90%;
	height:150px;
	overflow:hidden;
	z-index:1;
}
.crop img {
	height:100%;
	width:100%;
	left:50%;
	position:absolute;
	top:50%;
	-ms-transform:translate(-50%, -50%);
	-webkit-transform:translate(-50%, -50%);
	-moz-transform:translate(-50%, -50%);
	transform:translate(-50%, -50%);
	max-width:100%;
}

</style>
</head>
<body  class="ecommerce" >
<div class="pre-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span><?php echo $prod[0]; ?></span></li>
                    <li class="langs-block"><?php echo $prod[1]; ?></li>
                </ul>
            </div>
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right">



<?php if(isset( $_SESSION['user_id']) && $_SESSION['categary'] == 'USER') { ?>
					<li><a href="shop-about.php">About Us</a></li>
					<li><a href="Customer/shop-Myaccount.php">My Account</a></li>
		<?php } else { ?>
					<li><a href="shop-about.php">About Us</a></li>
					<li><a href="Authentication/shop-signin.php">Sign In</a></li>
					<li><a href="Authentication/shop-signup.php">Sign Up</a></li>
		<?php } ?>




				</ul>
            </div>
        </div>
    </div>
</div>

<div class="header">
	<div class="container" style="width:auto;">
		<a class="site-logo" href=""><img src="assets/corporate/img/logos/logo-shop-red.png" alt="Big Bucket"></a>
        <div class="top-cart-block">
			<a href = "Customer/shop-Myaccount.php" ><i class="fa fa-shopping-cart"></a></i>
        </div>
		<center>
			<div style="width:60%; margin-top:2%;">
				<form method="post">
					<div class="input-group" style="width:90%;">
						<input type="text" onKeyUp="fx(this.value)" autocomplete="off" name="qu" id="qu" placeholder="Enter Product to Search" tabindex="1" class="form-control" required>
						<div id="livesearch" style="display: block; position: absolute; margin-top: 6%; border: 0px none; width: 100%;"></div>
					</div>
				</form>
			</div>
		</center>
	</div>
</div>

<div class="container">
	<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel" style="height:2%;">
		<ol class="carousel-indicators" style="height:2%;">
			<?php echo make_slide_indicators($connect); ?>
		</ol>
		<div class="carousel-inner" style="height:2%;">
			<?php echo make_slides($connect); ?>
		</div>
		<a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

<br><br>

<div class="ads-grid">
	<div class="container">

<div id="offer"><?php echo offer($connect); ?></div>

		<div class="side-bar col-md-3">
			<div class="sidebar col-md-12">
				<ul class="list-group margin-bottom-25 sidebar-menu">
					<li class="list-group-item clearfix dropdown">	<a  style="color:red;"><i class="fa fa-angle-right"></i>VEGETABLE</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a href="#" class="VEGE">ALL VEGETABLE</a></li>
							<div id="categ1"></div>
						</ul>
					</li>
					<li class="list-group-item clearfix dropdown">	<a style="color:red;"><i class="fa fa-angle-right"></i>FRUIT</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a href="#" class="FRUIT">ALL FRUIT</a></li>
							<div id="categ2"></div>
						</ul>
					</li>
					<li class="list-group-item clearfix dropdown">	<a style="color:red;"><i class="fa fa-angle-right"></i>KIDS & BABY CARE</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a href="#" class="KIDS">ALL KIDS & BABY CARE</a></li>
							<div id="categ3"></div>
						</ul>
					</li>
					<li class="list-group-item clearfix dropdown">	<a style="color:red;"><i class="fa fa-angle-right"></i>PERSNAL & HEALTH CARE</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a href="#" class="PERSNAL">ALL PERSNAL & HOME CARE</a></li>
							<div id="categ4"></div>
						</ul>
					</li>
					<li class="list-group-item clearfix dropdown">	<a style="color:red;"><i class="fa fa-angle-right"></i>GROCERY</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a href="#" class="GROCERY">ALL GROCERY</a></li>
							<div id="categ5"></div>
						</ul>
					</li>
					<li class="list-group-item clearfix dropdown">	<a style="color:red;"><i class="fa fa-angle-right"></i>HOME CARE</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a href="#" class="HOME">ALL HOME CARE</a></li>
							<div id="categ6"></div>
						</ul>
					</li>
					<li class="list-group-item clearfix dropdown">	<a style="color:red;"><i class="fa fa-angle-right"></i>PATANJALI</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a href="#" class="PATANJALI">ALL PATANJALI</a></li>
							<div id="categ7"></div>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<div id="first" class="agileinfo-ads-display col-md-9">
			<div class="wrapper">
				<div class="product-sec1">
					<h3 id="title" class="heading-tittle">Vegetables & Fruit</h3>
						<div id="prod1"></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="side-bar col-md-3"></div>
		<div id="sec" class="agileinfo-ads-display col-md-9">
			<div class="wrapper">
				<div class="product-sec1">
					<h3 class="heading-tittle">PATANJALI</h3>
						<div id="prod2"></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="side-bar col-md-3"></div>
		<div id="thir" class="agileinfo-ads-display col-md-9">
			<div class="wrapper">
				<div class="product-sec1">
					<h3 class="heading-tittle">PERSNAL & HOME CARE</h3>
							<div id="prod3"></div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

	</div>
</div>
<br><h4 STYLE="margin-left:4%;">TOP BRANDS</H4>
    <div class="brands">
      <div class="container" style="width:100%;">
            <div class="owl-carousel owl-carouse16-brands">

              <div id="brand"></div>

            </div>
        </div>
    </div>
<div class="pre-footer">
	<div class="container" style="width:100%;">
		<div class="row">
			<div class="col-md-4 col-sm-9 pre-footer-col" >
				<h2>Our Contacts</h2>
				<address class="margin-bottom-40">
					<div id="address"><?php echo $prod[2]; ?></div>
					<div id="contact1"><?php echo $prod[0]; ?></div><br>
					<a><div id="email1"><?php echo $prod[1]; ?></div></a><br>
				</address>
			</div>
			<div class="col-md-3 col-sm-4 pre-footer-col">
				<h2>LINKS</h2>
				<ul class="list-unstyled">
					<li><i class="fa fa-angle-right"></i> <a href="index.php">Home</a></li>
					<li><i class="fa fa-angle-right"></i> <a href="shop-about.php">AboutUS</a></li>
					<li><i class="fa fa-angle-right"></i> <a href="shop-contacts.php">Contact Us</a></li>
				</ul>
			</div>
			<div class="col-md-4">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.267532047077!2d81.0220753150439!3d26.86323998314888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399be2f33f24d0dd%3A0x384b9f2eea51c164!2s1%2F5%2C+Viraj+Khand+Rd%2C+Vinamra+Khand%2C+Gomti+Nagar%2C+Lucknow%2C+Uttar+Pradesh+226010!5e0!3m2!1sen!2sin!4v1518115235462" width="400" height="300" frameborder="0" style="border:0" allowfullscreen async defer></iframe>
			</div>
		</div>
	</div>
</div>
<center>
    <div class="footer">
		<div class="container">
			<div>
		foodi © ALL Rights Reserved | <a href="https://www.linkedin.com/in/mritunjay-srivastava-118451106/" target="blank">Design by : Mritunjay Srivastava </a>.
			</div>
		</div>
	</div>
    </div>
</center>
<script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function() {Layout.init();});
</script>
<script>
$(document).ready(function(){
	var start = 0;
	var last = 2;
	var count = 0;
function categ(image) {
	var action = "CATEG";
	$.ajax({
		url:"product_backend.php",
		method:"POST",
		data:{action:action, image:image},
		success:function(data) {
			if (image == "Vegetable")
				$('#categ1').html(data);
			else if (image == "Fruit")
				$('#categ2').html(data);
			else if (image == "KIDS")
				$('#categ3').html(data);
			else if (image == "Persnal")
				$('#categ4').html(data);
			else if (image == "Grocery")
				$('#categ5').html(data);
			else if (image == "Home")
				$('#categ6').html(data);
			else if (image == "PATANJALI")
				$('#categ7').html(data);
			else
				console.log("Unauthorized data");
		}
	})
}
categ("Vegetable");
categ("Fruit");
categ("KIDS");
categ("Persnal");
categ("Grocery");
categ("Home");
categ("PATANJALI");
function show_product(image) {
	var action = "PROD";
	$.ajax({
		url:"product_backend.php",
		method:"POST",
		data:{action:action, image:image, start:start, last:3},
		success:function(data) {
			if (image == "VEGE")
				$('#prod1').html(data);
			else if (image == "PATAN")
				if (data == '') {
				} else {
					$('#prod2').html(data);
				}
			else if (image == "PER")
				$('#prod3').html(data);
			else
				alert("unauthorized access!");
		}
	})
}
show_product("VEGE");
show_product("PATAN");
show_product("PER");
function show_brand() {
	var action = "brand";
	$.ajax({
		url:"product_backend.php",
		method:"POST",
		data:{action:action},
		success:function(data) {
			if (data != '') {
				$('#brand').append(data);
			}
		}
	})
}
show_brand();
function show_section_product(section, action, start, last) {
	$.ajax({
		url:"product_backend.php",
		method:"POST",
		data:{action:action, image:section, start:start, last:last},
		success:function(data) {
			if (data != '') {
				$('#prod1').append(data);
				show_section_product(section, action, start+last, 2);
				count += 1;
			} else if (count > 0) {
			} else {
				$('#prod1').html("Comming Soon");
			}
		}
	})
}
$(document).on('click', '.VEGE', function(){
	$('#prod1').html("");
	$('#title').html("Vegetable");
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_section_product("VEGE", "PROD", 4, 2);
});
$(document).on('click', '.FRUIT', function(){
	$('#prod1').html("");
	$('#title').html("FRUIT");
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_section_product("FRUI", "PROD", 0, 2);
});
$(document).on('click', '.KIDS', function(){
	$('#prod1').html("");
	$('#title').html("KIDS & BABY CARE");
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_section_product("KIDS", "PROD", 0, 2);
});
$(document).on('click', '.PERSNAL', function(){
	$('#prod1').html("");
	$('#title').html("PERSNAL & HEALTH CARE");
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_section_product("PER", "PROD", 0, 2);
});
$(document).on('click', '.GROCERY', function(){
	$('#prod1').html("");
	$('#title').html("GROCERY");
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_section_product("GROC", "PROD", 0, 2);
});
$(document).on('click', '.HOME', function(){
	$('#prod1').html("");
	$('#title').html("HOME CARE");
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_section_product("HOM", "PROD", 0, 2);
});
$(document).on('click', '.PATANJALI', function(){
	$('#prod1').html("");
	$('#title').html("PATANJALI");
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_section_product("PATAN", "PROD", 0, 2);
});
$(document).on('click', '.delete', function(){
	$('#prod1').html("");
	var image_id = $(this).attr("idname");
	$('#title').html(image_id);
	$('#sec').html("");
	$('#thir').html("");
	var id = $(this).attr("id");
	count = 0;
	show_section_product(id, "PROD", 0, 2);
});
function show_offer_product(section, action, start, last) {
	$.ajax({
		url:"product_backend.php",
		method:"POST",
		data:{action:action, image:section, start:start, last:last},
		success:function(data) {
			if (data != '') {
				$('#prod1').append(data);
				show_offer_product(section, action, start+last, 2);
				count += 1;
			} else if (count > 0) {
			} else {
				$('#prod1').html("Comming Soon");
			}
		}
	})
}
$(document).on('click', '.viewoffer', function(){
	$('#offer').html("");
	$('#prod1').html("");
	var image_id = $(this).attr("idname");
	$('#title').html(image_id);
	$('#sec').html("");
	$('#thir').html("");
	count = 0;
	show_offer_product($(this).attr("id"), "offer", 0, 2);
});
});
</script>
</body>
</html>
