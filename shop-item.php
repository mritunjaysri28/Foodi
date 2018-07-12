<?php session_start();
function __autoload($class){include $class.".php";}
$connect = mysqli_connect("localhost", "root", "", "vegetable");

	//$query = "SELECT prod_pic, `prod_ename`, `prod_hname`, `weight`, `prod_disc`, `prod_price`, prod_stock, p='".$_GET['image_id']."'";
	if ($_GET['off'] == "OFFER") {
		//offer
		$quer = "SELECT offer_id, offer_dis, offer_price FROM offer_prod WHERE prod_id = '".$_GET['image_id']."'";
		$resul = mysqli_query($connect, $quer);
		while($ro = mysqli_fetch_array($resul)) {
			$offer = $ro['offer_id'];
			$disc = $ro['offer_price'] - ($ro['offer_dis'] / 100 * $ro['offer_price']);
			$price = $ro['offer_price'];
			$query = "SELECT product.prod_pic as prod_pic, product.prod_ename as prod_ename, product.prod_hname as prod_hname, product.weight as weight, offer_prod.offer_price as prod_price, offer_prod.offer_dis as prod_disc, product.prod_desc as prod_desc
						FROM
						offer_prod INNER JOIN product
						ON
						offer_prod.prod_id = product.prod_id
						WHERE
						product.prod_id = '".$_GET['image_id']."' AND offer_prod.offer_id = '".$offer."'";
		}
	} else {
		$query = "SELECT prod_pic, `prod_ename`, `prod_hname`, `weight`, `prod_disc`, `prod_price`, prod_stock, prod_desc FROM `product` where prod_id ='".$_GET['image_id']."'";
	}

	$result = mysqli_query($connect, $query);

	//details quey call
	function details($connect, $query) {
		$result = mysqli_query($connect, $query);
		$prod = '';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.$row['value'];
		}
		return $prod;
	}

	//brand detais call
	function brand($connect, $query) {
		$result = mysqli_query($connect, $query);
		$prod = '';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.'<img src="data:image/jpeg;base64,'.base64_encode($row['brand_pic']).'" alt="'.$row['brand_name'].'" style="margin-left:1%;">';
		}
		return $prod;
	}

	//review call
	function review($connect) {
		$query = "SELECT user_details.fname as fname, user_details.lname as lname, review.time as time, review.revie
					FROM
					review INNER JOIN user_details
					ON
					review.user_id = user_details.user_id
					WHERE
					review.prod_id ='".$_GET['image_id']."'
					ORDER BY review.time DESC LIMIT 0, 5;
					";
		$result = mysqli_query($connect, $query);
		$prod = '';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.'<div class="review-item clearfix">
							<div class="review-item-submitted">
								<strong>'.$row['fname'].' '.$row['lname'].'</strong>
								<em>'.$row['time'].'</em>
							</div>
							<div class="review-item-content" style="word-break:break-all;">
								<p>'.$row['revie'].'.</p>
							</div>
						</div>  ';
		}
		return $prod;
	}
?>

<!DOCTYPE html>
<html lang="en">
<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>View Product | Foodi</title>

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

    <!--<link href="assets\pages\css\product.css" rel="stylesheet">-->
</head>

<!-- Body BEGIN -->
<body class="ecommerce" id="back">

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

            <!-- END TOP BAR LEFT PART -->
        <?php if(isset( $_SESSION['user_id']) && $_SESSION['categary'] == 'USER') { ?>
			<!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
				<ul class="list-unstyled list-inline pull-right">
					<li><a href="Customer/shop-Myaccount.php">My Account</a></li>
					<li><a href="shop-about.php">About Us</a></li>
                </ul>
			</div>
            <!-- END TOP BAR MENU -->
		<?php } else { ?>
			<!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
				<ul class="list-unstyled list-inline pull-right">
					<li><a href="shop-about.php">About Us</a></li>
					<li><a href="Authentication/shop-signin.php">Sign In</a></li>
					<li><a href="Authentication/shop-signup.php">Sign Up</a></li>
                </ul>
			</div>
            <!-- END TOP BAR MENU -->
		<?php } ?>
		</div>
	</div>
</div>
<!-- END TOP BAR -->

<!-- BEGIN HEADER -->
<div class="header">
	<div class="container">
		<a class="site-logo" href="index.php"><img src="assets/corporate/img/logos/logo-shop-red.png" alt="Big Bucket"></a>
        <!-- BEGIN CART -->
        <div class="top-cart-block">
			<a href = "Customer/shop-Myaccount.php?url=cart" ><i class="fa fa-shopping-cart"></a></i>
        </div>
        <!--END CART -->
	</div>
</div>
<!-- Header END -->

<!-- Product body start -->
<a href="index.php" class="btn btn-primary" style="margin-left:10%;">Countinue shooping</a>
<div class="main" style="margin-top:2%;">
	<div class="container">
		<!-- BEGIN SIDEBAR & CONTENT -->
		<div class="row margin-bottom-40">
			<div class="col-md-9 col-sm-7" style="width:100%">
				<div class="product-page">
					<div class="row">
		<?php
			while($row = mysqli_fetch_array($result)) {
				if ($_GET['off'] != "OFFER") {
					$disc = $row['prod_price']-(($row['prod_disc']/100)*$row['prod_price']);
					$price = $row['prod_price'];
				}

				echo '
						<div class="col-md-6 col-sm-6">
							<div class="product-main-image">
								<img src="data:image/jpeg;base64,'.base64_encode($row['prod_pic'] ).'" height="60" width="75" class="img-responsive" />
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<h1>'.$row['prod_ename'].' - '.$row['prod_hname'].' '.$row['weight'].'</h1>
							<div class="price-availability-block clearfix">
								<div>
									<font color="red" size="5%"><B>&#8377;"'.($row['prod_price']-(($row['prod_disc']/100)*$row['prod_price'])) .'" </B></font>
									<font size="3%"><strike><em>&#8377;<span>'.$row['prod_price'].'</span></em></strike></font>
								</div>
								<div class="availability"></div>
							</div>
							<div>
								<a data-toggle="tab">Descrition </a>
								<p style="word-break:break-all;">'.$row['prod_desc'].'</p>
							</div>
							<div class="product-page-cart">
								<form method="POST" >
									<div class="product-quantity" >
										<input id="product-quantity" type="number" min="1" name="quant" value="1" class="form-control">
										<input type="hidden" name="prod_id" value='.$_GET['image_id'].' >
									</div> X
									'.$row['weight'].'<button type="submit" name="cart" style="margin-left:10%;" class="btn btn-primary">ADD TO CART</button>
								</form>
							</div>
						</div>
						';
			}
		?>
						<div class="product-page-content">
							<ul id="myTab" class="nav nav-tabs">
								<li class="active"><a data-toggle="tab">Reviews </a></li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div class="tab-pane fade in active" id="Reviews">
									<?php echo review($connect); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END SIDEBAR & CONTENT -->
	</div>
</div>

    <!-- BEGIN BRANDS -->
    <div class="brands">
      <div class="container" style="width:100%;">
            <div class="owl-carousel owl-carousel6-brands">
            	<?php echo brand($connect, "SELECT brand_pic,brand_name FROM `brand` ORDER BY brand_id DESC"); ?>
		<!--<img src="assets/pages/img/brands/canon.jpg" alt="canon" title="canon">-->
            </div>
        </div>
    </div>
    <!-- END BRANDS -->

<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer">
	<div class="container">
		<div class="row">

			<!-- BEGIN BOTTOM CONTACTS -->
			<div class="col-md-4 col-sm-9 pre-footer-col" >
				<h2>Our Contacts</h2>
				<address class="margin-bottom-40">
					<?php echo details($connect, "SELECT value FROM `details` where details ='address'"); ?><br>
					Contact: <?php echo details($connect, "SELECT value FROM `details` where details ='contact'"); ?><br>
					Email: <a><?php echo details($connect, "SELECT value FROM `details` where details ='email'"); ?></a><br>
				</address>
			</div>
			<!-- END BOTTOM CONTACTS -->

			<!-- BEGIN BOTTOM INFO BLOCK -->
			<div class="col-md-3 col-sm-4 pre-footer-col">
				<h2>LINKS</h2>
				<ul class="list-unstyled">
					<li><i class="fa fa-angle-right"></i> <a href="index.php">Home</a></li>
					<li><i class="fa fa-angle-right"></i> <a href="shop-about.php">AboutUS</a></li>
					<li><i class="fa fa-angle-right"></i> <a href="shop-contacts.php">Contact Us</a></li>
				</ul>
			</div>
			<!-- END INFO BLOCK -->

			<!-- BEGIN MAP BLOCK -->
			<div class="col-md-4">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.267532047077!2d81.0220753150439!3d26.86323998314888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399be2f33f24d0dd%3A0x384b9f2eea51c164!2s1%2F5%2C+Viraj+Khand+Rd%2C+Vinamra+Khand%2C+Gomti+Nagar%2C+Lucknow%2C+Uttar+Pradesh+226010!5e0!3m2!1sen!2sin!4v1518115235462" width="400" height="300" frameborder="0" style="border:0" allowfullscreen async defer></iframe>
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


				<!-- BEGIN COPYRIGHT -->

					Foodi © ALL Rights Reserved | <a href="https://www.linkedin.com/in/mritunjay-srivastava-118451106/" target="blank">Design by : Mritunjay Srivastava </a>.
				</div>
				<!-- END COPYRIGHT -->
			</div>
		</div>
    </div>
</center>
<!-- END FOOTER -->

    <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
    <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="assets/plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>

    <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initOWL();
            Layout.initTwitter();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initUniform();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->


<?php
//action on button
	if ( isset ( $_POST['cart'] ) ) {
		if ($_GET['off'] == "OFFER") {
			$a = new Validate();
			$a->addCart($disc, $price);
		} else {
			$a = new Validate();
			$a->addCart($disc, $price);
		}
	}
	if (isset($_POST['a'])) {
		header("location:index.php");
	}

?>
</body>
<!-- END BODY -->
</html>
