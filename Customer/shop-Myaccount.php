<?php session_start();
if ($_SESSION['email']!=NULL && $_SESSION['categary']=="USER" && $_SESSION['status']=="ACTIVE") {
	//establish connection
	$connect = mysqli_connect("localhost", "root", "", "vegetable");

	//contact detais call
	function details($connect, $query) {
		$result = mysqli_query($connect, $query);
		$prod = '';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.$row['value'];
		}
		return $prod;
	}

	//redirct to page
	if ( @$_REQUEST['url'] == "edit" ) {
  		$url = "../edit_profile/shop-editprofile.php";
	} else if ( @$_REQUEST['url'] == "add" ) {
		$url = "../edit_profile/shop-editadd.php";
	} else if ( @$_REQUEST['url'] == "ord" ) {
		$url = "../order/shop-order-user.php";
	} else if ( @$_REQUEST['url'] == "cart" ) {
		$url = "../cart/shop-shopping-cart.php";
	} else if ( @$_REQUEST['url'] == "out" ) {
		session_destroy();
		header("location:../");
	} else {
		$url = "../cart/shop-shopping-cart.php";
	}
?>
<html lang="en">
<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Profile | Foodi</title>

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


   <style media="screen,projection" data-href="catalog/view/theme/OPC080185_2/stylesheet/css/materialize.min.css?v=1.8"></style>
	<style media="" data-href="catalog/view/theme/OPC080185_2/stylesheet/css/font-awesome.min.css?v=1.8"></style>
    <style media="" data-href="catalog/view/theme/OPC080185_2/stylesheet/css/style.css?v=1.8"></style>

</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">

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
            </div>
        </div>
    </div>
    <!-- END TOP BAR -->

    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="../"><img src="assets/corporate/img/logos/logo-shop-red.png" alt="Big Bucket"></a>

        <!-- BEGIN CART -->
        <div class="top-cart-block">
			<a href = "?url=cart" ><i class="fa fa-shopping-cart"></a></i>
        </div>
        <!--END CART -->

      </div>
    </div>
    <!-- Header END -->

    <!-- BEGIN SIDEBAR -->
	<div class="sidebar col-md-3 col-sm-5" style="margin-left:2%;">
		<ul class="list-group margin-bottom-25 sidebar-menu">
			<li class="list-group-item clearfix" style="width:auto;"><a href="?url=ord"><i class="fa fa-angle-right"></i> My Order</a></li>
			<li class="list-group-item clearfix"><a href="?url=cart"><i class="fa fa-angle-right"></i> View Cart</a></li>
			<li class="list-group-item clearfix"><a href="?url=edit"><i class="fa fa-angle-right"></i> Edit Account</a></li>
			<li class="list-group-item clearfix"><a href="?url=add"><i class="fa fa-angle-right"></i> Address Book</a></li>
			<li class="list-group-item clearfix"><a href="../Authentication/forget.php" target="blank"><i class="fa fa-angle-right"></i> Change Password</a></li>
			<li class="list-group-item clearfix"><a href="../"><i class="fa fa-angle-right"></i> Countinue Shooping</a></li>
			<li class="list-group-item clearfix"><a href="?url=out"><i class="fa fa-angle-right"></i> Sign Out</a></li>
		</ul>
	</div>
    <!-- END SIDEBAR -->

	<iframe src="<?php echo $url; ?>" width="70%" height="100%" scrolling="auto" frameborder="no"></iframe>


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
				<h2>Information</h2>
				<ul class="list-unstyled">
					<li><i class="fa fa-angle-right"></i> <a href="../">Home</a></li>
					<!--<li><i class="fa fa-angle-right"></i> <a href="shop-faq.html">FAQ</a></li>-->
					<li><i class="fa fa-angle-right"></i> <a href="../shop-contacts.php">Contact Us</a></li>
				</ul>
			</div>
			<!-- END INFO BLOCK -->

			<!-- BEGIN BOTTOM CONTACTS -->
			<div class="col-md-3 col-sm-6 pre-footer-col" >
				<h2>Our Contacts</h2>
				<address class="margin-bottom-40" style="wrap">
					<?php echo details($connect, "SELECT value FROM `details` where details ='address'"); ?>
					Contact: <?php echo details($connect, "SELECT value FROM `details` where details ='contact'"); ?><br>
					Email: <a ><?php echo details($connect, "SELECT value FROM `details` where details ='email'"); ?></a><br>
				</address>
			</div>
			<!-- END BOTTOM CONTACTS -->

			<!-- BEGIN MAP BLOCK -->
			<div class="col-md-3" >
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
				<!-- BEGIN PAYMENTS
				<div class="row">
				<center>
					<div class="col-md-4 col-sm-4" style="margin-left:5%">
						<ul class="list-inline ">
							<li><img src="assets/corporate/img/payments/western-union.jpg" alt="We accept Western Union" title="We accept Western Union"></li>
							<li><img src="assets/corporate/img/payments/american-express.jpg" alt="We accept American Express" title="We accept American Express"></li>
							<li><img src="assets/corporate/img/payments/MasterCard.jpg" alt="We accept MasterCard" title="We accept MasterCard"></li>
							<li><img src="assets/corporate/img/payments/PayPal.jpg" alt="We accept PayPal" title="We accept PayPal"></li>
						</ul>
					</div>
				</center>
				<br><br><br>
				<div class="col-md-4 col-sm-4 padding-top-10" >
				<!-- END PAYMENTS -->

				<!-- BEGIN COPYRIGHT -->

					Foodi © ALL Rights Reserved | <a href="https://www.linkedin.com/in/mritunjay-srivastava-118451106/" target="blank">Design by : Mritunjay Srivastava </a>.
				</div>
				<!-- END COPYRIGHT -->
			</div>
		</div>
    </div>
</center>
<!-- END FOOTER -->
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <![endif]-->
    <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>

</body>
<!-- END BODY -->
</html>
<?php } else { header("location:../Authentication/shop-signin.php"); } ?>
