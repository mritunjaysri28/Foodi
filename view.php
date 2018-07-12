<?php session_start();
function __autoload($class){include $class.".php";}
	//establish connection
	$connect = mysqli_connect("localhost", "root", "", "vegetable");


	//categary quey call
	function categ($connect, $query) {
		$result = mysqli_query($connect, $query);
		$prod = '';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.'<li class="list-group-item dropdown clearfix">	<a class="delete" id="'.$row["categ_id"].'">'.$row['categ_name'].'</a>	</li>';
		}
		return $prod;
	}

	//contact detais call
	function details($connect, $query) {
		$result = mysqli_query($connect, $query);
		$prod = '';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.$row['value'];
		}
		return $prod;
	}

	//search
	function search() {
		$connect = mysqli_connect("localhost", "root", "", "vegetable");
		$query = "SELECT `prod_pic`, `prod_ename`, `prod_hname`, `weight`, `prod_price`,`prod_disc`,`prod_id` FROM `product` WHERE prod_id = '".$_GET['product']."'";
		$result = mysqli_query($connect, $query);
		echo '<ul class="product-carousel" id="infinitScroll" producttotal="37" totalpage="1" filter="" limit="50" sort="pd.name" order="ASC" page="2" path="30">';
		while($row = mysqli_fetch_array($result)) {
			echo '<form method="POST">
					<li style="width:22%; margin-top:2%; background-color:white;">
						<div class="prod-thumb">
							<img src="data:image/jpeg;base64,'.base64_encode($row['prod_pic'] ).'" height="100%" width="auto" alt="'.$row['prod_ename'].' - '.$row['prod_hname'].' 1'.$row['weight'].'" />
						</div>
						<div style="align:center">
						<br>
							<center><h6>'.$row['prod_ename'].'<br>( '.$row['prod_hname'].' )<br>1'.$row['weight'].'</h6></center>
						</div>
						<div style="align:center;">
							<center><span class="price-new ondr-rate"></span>
							<span class="price-old mrp-rate">₹<span class="WebRupee"></span>'.$row['prod_price'].'</span>
							<span class="price-new ondr-rate">₹<span class="WebRupee"></span>'.($row['prod_price']-(($row['prod_disc']/100)*$row['prod_price'])) .'</span></center>
						</div>
						<br>
						<input type="hidden" name="id" value="'.$row["prod_id"].'" >
						<center><button name="delete" class="btn btn-primary search" id="'.$row["prod_id"].'">View</button></center>
					</li></form>
				';
		}
		echo '</ul>';
	}



?>


<!DOCTYPE html>
<html lang="en">
<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Big Bucket</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Big Bucket description" name="description">
  <meta content="Big Bucket keywords" name="keywords">
  <meta content="Big Bucket" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="assets/corporate/img/logos/logo-shop-red.png"type="image/x-icon">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <!-- Fonts END -->

  <!-- Global styles START -->
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END -->

  <!-- Page level plugin styles START -->
  <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
  <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
  <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"><!-- for slider-range -->
  <link href="assets/plugins/rateit/src/rateit.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->

  <link href="assets\pages\css\jquery.mobile-1.4.5.min.css" rel="stylesheet">
  <link href="assets\pages\css\product.css" rel="stylesheet">

    <style media="screen,projection" data-href="catalog/view/theme/OPC080185_2/stylesheet/css/materialize.min.css?v=1.8"></style>
	<style media="" data-href="catalog/view/theme/OPC080185_2/stylesheet/css/font-awesome.min.css?v=1.8"></style>
    <style media="" data-href="catalog/view/theme/OPC080185_2/stylesheet/css/style.css?v=1.8"></style>

	<!--filter-product-list-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--/filter-product-list-->

	<!--slider-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--end slider-->

  <!--seach-->

  <link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Rubik" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
function lightbg_clr() {
	$('#qu').val("");
	$('#textbox-clr').text("");
 	$('#search-layer').css({"width":"auto","height":"auto"});
	$('#livesearch').css({"display":"none"});
	$("#qu").focus();
 };

function fx(str)
{
	//inputsearch text
var s1=document.getElementById("qu").value;

var xmlhttp;

//validate search and css apply
if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
	document.getElementById("search-layer").style.width="auto";
	document.getElementById("search-layer").style.height="auto";
	document.getElementById("livesearch").style.display="block";
	$('#textbox-clr').text("");
    return;
  }

//start ajax
if (window.XMLHttpRequest) {
	// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
} else {
	// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}

xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
	document.getElementById("search-layer").style.width="100%";
	document.getElementById("search-layer").style.height="100%";
	document.getElementById("livesearch").style.display="block";
	$('#textbox-clr').text("X");
  }
}
xmlhttp.open("GET","call_ajax.php?n="+s1,true);
xmlhttp.send();
}
</script>
  <!--/search-->
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce" bgcolor="#BDBDBD" id="body">

<!-- BEGIN TOP BAR -->
<div class="pre-header">
	<div class="container">
		<div class="row">
			<!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
				<ul class="list-unstyled list-inline">
					<li><i class="fa fa-phone"></i><span><?php echo details($connect, "SELECT value FROM `details` where details ='contact'"); ?></span></li>
					<li><?php echo details($connect, "SELECT value FROM `details` where details ='email'"); ?></span></li>
				</ul>
			</div>
            <!-- END TOP BAR LEFT PART -->

			<!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
				<ul class="list-unstyled list-inline pull-right">
					<li><a href="Customer/shop-Myaccount.php">My Account</a></li>
					<li><a href="Authentication/shop-signin.php">Sign In</a></li>
					<li><a href="Authentication/shop-signup.php">Sign Up</a></li>
                </ul>
			</div>
            <!-- END TOP BAR MENU -->
		</div>
	</div>
</div>
<!-- END TOP BAR -->

<!-- BEGIN HEADER -->
<div class="header">
	<div class="container" style="width:auto;">
		<a class="site-logo" href="index.php"><img src="assets/corporate/img/logos/logo-shop-red.png" alt="Big Bucket"></a>
		<!-- BEGIN CART -->
        <div class="top-cart-block">
			<a href = "Customer/shop-Myaccount.php" ><i class="fa fa-shopping-cart"></a></i>
        </div>
        <!--END CART -->

		<!-- BEGIN TOP SEARCH-->
		<span class="sep"></span>
		<center>
			<div style="width:60%; margin-top:2%;">
				<form method="post">
					<div class="input-group">
						<input type="text" onKeyUp="fx(this.value)" autocomplete="off" name="qu" id="qu" placeholder="Enter Product to Search" class="form-control" tabindex="1" required>
						<span class="input-group-btn">

							<button type="submit" class="query-submit" tabindex="2"><!--<i class="fa fa-search" style="color:#727272; font-size:20px"></i>--></button>
						</span>
						<div id="livesearch"></div>
					</div>
				</form>
			</div>
		</center>
        <!-- END TOP SEARCH -->
	</div>
</div>
<!-- Header END -->

<!-- Product body start -->
<center><hr width="80%"></center>
<div class="main">
	<div class="container" style="width:100%;">
		<!-- BEGIN SIDEBAR & CONTENT -->
		<div class="row margin-bottom-40" >
			<!-- BEGIN SIDEBAR -->
			<div class="sidebar col-md-3 col-sm-5" style="margin-top:4%;">
				<ul class="list-group margin-bottom-25 sidebar-menu">
					<li class="list-group-item dropdown clearfix">	<a class="prod">All Product</a></li>
					<li class="list-group-item clearfix dropdown">	<a ><i class="fa fa-angle-right"></i>Vegetable</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a class="vege">All Vegetables</a></li>
							<?php echo categ($connect, "SELECT categ_id, `categ_name` FROM `categary` where section ='Vegetable'"); ?>
						</ul>
					</li>
					<li class="list-group-item clearfix dropdown">	<a class="FRUI"><i class="fa fa-angle-right"></i>Fruit</a>
						<ul class="dropdown-menu">
							<li class="list-group-item dropdown clearfix">	<a class="fru">All Fruit</a></li>
							<?php echo categ($connect, "SELECT categ_id, `categ_name` FROM `categary` where section ='Fruit'"); ?>
						</ul>
					</li>
				</ul>


			</div>
			<!-- END SIDEBAR -->

			<!-- BEGIN CONTENT -->
			<div class="col-md-9 col-sm-7">
				<!-- BEGIN SORT Product
				<div class="row list-view-sorting clearfix">
					<div class="col-md-2 col-sm-2 list-view">
						<a href="javascript:;"><i class="fa fa-th-large"></i></a>
						<a href="javascript:;"><i class="fa fa-th-list"></i></a>
					</div>
					<div class="col-md-10 col-sm-10" style="margin-top:2%;">
						<div class="pull-right">
							<label class="control-label">Sort&nbsp;By:</label>

							<select class="form-control input-sm" name="name">
								<option value="time">New Arrival</option>
								<option value="AZ" class="AZ">Name (A - Z)</option>
								<option value="ZA">Name (Z - A)</option>
								<option value="low">Price (Low &gt; High)</option>
								<option value="high">Price (High &gt; Low)</option>
							</select>

						</div>
					</div>
				</div>
				<!-- END SORT Product-->
				<!-- BEGIN PRODUCT LIST -->
				<div class="row product-list">


					<div id="image_data"><?php echo search(); ?></div>
					<div id="categ_data"></div>

				</div>
				<!-- END PRODUCT LIST -->
				<div id="load_data_message"></div>
			</div>
			<!-- END CONTENT -->
		</div>
		<!-- END SIDEBAR & CONTENT -->
	</div>
</div>
<!-- Product body END -->

<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer">
	<div class="container" style="width:100%;">
		<div class="row">
			<!-- BEGIN BOTTOM ABOUT BLOCK -->
			<div class="col-md-3 col-sm-6 pre-footer-col" style="color:white;">
				<h2>About us</h2>
				<p style="color:white"><?php echo details($connect, "SELECT value FROM `details` where details ='about'"); ?>. </p>
			</div>
			<!-- END BOTTOM ABOUT BLOCK -->

			<!-- BEGIN BOTTOM INFO BLOCK -->
			<div class="col-md-3 col-sm-6 pre-footer-col" style="width:13%;">
				<h2>LINKS</h2>
				<ul class="list-unstyled">
					<li><i class="fa fa-angle-right"></i> <a href="">Home</a></li>
					<!--<li><i class="fa fa-angle-right"></i> <a href="shop-faq.html">FAQ</a></li>-->
					<li><i class="fa fa-angle-right"></i> <a href="shop-contacts.php">Contact Us</a></li>
				</ul>
			</div>
			<!-- END INFO BLOCK -->

			<!-- BEGIN BOTTOM CONTACTS -->
			<div class="col-md-3 col-sm-6 pre-footer-col" >
				<h2>Our Contacts</h2>
				<address class="margin-bottom-40" style="wrap">
					<?php echo details($connect, "SELECT value FROM `details` where details ='address'"); ?>
					Contact: <?php echo details($connect, "SELECT value FROM `details` where details ='contact'"); ?><br>
					Email: <a href="mailto:info@metronic.com"><?php echo details($connect, "SELECT value FROM `details` where details ='email'"); ?></a><br>
				</address>
			</div>
			<!-- END BOTTOM CONTACTS -->

			<!-- BEGIN MAP BLOCK -->
			<div class="col-md-3" >
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227821.93376121653!2d80.80242464318376!3d26.848929331392167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd991f32b16b%3A0x93ccba8909978be7!2sLucknow%2C+Uttar+Pradesh!5e0!3m2!1sen!2sin!4v1507823259776" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
			<!-- END MAP BLOCK -->
		</div>
        <hr>
	</div>
</div>
<!-- END PRE-FOOTER -->

<!-- BEGIN FOOTER -->
<center>
    <div class="footer">
		<div class="container">
			<div>
				<!-- BEGIN PAYMENTS
				<div class="row">
				<center>
					<div class="col-md-4 col-sm-4" style="margin-left:5%">
						<ul class="list-inline ">
							<li><img src="assets/corporate/img/payments/western-union.jpg" alt="We accept Western Union" title="We accept Western Union"></li>
						</ul>
					</div>
				</center>
				<br><br><br>
				<div class="col-md-4 col-sm-4 padding-top-10" >
				<!-- END PAYMENTS -->

				<!-- BEGIN COPYRIGHT -->
					Big Bucket © ALL Rights Reserved | <a href="https://www.linkedin.com/in/mritunjay-srivastava-118451106/" target="blank">Design by : Mritunjay Srivastava </a>.
				</div>
				<!-- END COPYRIGHT -->
			</div>
		</div>
    </div>
</center>
<!-- END FOOTER -->


<!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
    <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
    <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="assets/plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script><!-- for slider-range -->
	<script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>

<!--call JSON-->
<script>
//Call JSON
$(document).ready(function(){

	//Show all products
	$(document).on('click', '.prod', function(){
        window.location.href = "index.php



		";
	});

	//filter one vegeatble
	$(document).on('click', '.vege', function(){
		var image_id = "VEGE";
		var action = "one";
		$.ajax({
			url:"view_product.php",
			method:"POST",
			data:{image_id:image_id, action:action},
			success:function(data) {
				$('#image_data').html(data);
				$('#load_data_message').html("");
			}
		})
	});

	//filter one fruit
	$(document).on('click', '.fru', function(){
		var image_id = "FRUI";
		var action = "one";
		$.ajax({
			url:"view_product.php",
			method:"POST",
			data:{image_id:image_id, action:action},
			success:function(data) {
				$('#image_data').html(data);
				$('#load_data_message').html("");
			}
		})
	});

	//filter product by categary
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "delete";
		$.ajax({
			url:"view_product.php",
			method:"POST",
			data:{image_id:image_id, action:action},
			success:function(data) {
				$('#image_data').html(data);
				$('#load_data_message').html("");
			}
		})
	});

	//show full product details
	$(document).on('click', '.search', function(){alert("s");
		var image_id = $(this).attr("id");
		$.ajax({
			url:"shop-item.php",
			method:"GET",
			data:{image_id:image_id},
			success:function() {
				window.location.href = "shop-item.php?image_id="+ image_id +"&&off=";
			}
		})
	});
});
</script>
<!--END CALLING JSON-->

<!-- START PAGE LEVEL JAVASCRIPTS -->
<script type="text/javascript">
	jQuery(document).ready(function() {
		Layout.init();
		Layout.initOWL();
		Layout.initTwitter();
		Layout.initImageZoom();
		Layout.initTouchspin();
		Layout.initUniform();
		Layout.initSliderRange();
	});
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->

</body>
<!-- END BODY -->
</html>
