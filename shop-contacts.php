<?php
session_start();
function __autoload($class){include $class.".php";}
	$connect = mysqli_connect("localhost", "root", "", "vegetable");

	//details quey call
	function details($connect, $query) {
		$result = mysqli_query($connect, $query);
		$prod = '';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.$row['value'];
		}
		return $prod;
	}


	$_SESSION['conmail'] = "";
	//redirct to page
	if(isset($_POST['contact'])) {
		if (strlen($_POST['mssg']) < 200 || strlen($_POST['mssg']) > 400) {
			$_SESSION['conmail'] = "Message is to short, Provide Message in 200 - 400 character";
		} else {
			$a = new Validate();
			$a->contact();
		}
	}
?>

<!DOCTYPE html>
<html>

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Contact | Foodi</title>

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
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="assets/pages/css/components.css" rel="stylesheet">
  <link href="assets/corporate/css/style.css" rel="stylesheet">
  <link href="assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
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
            <!-- END TOP BAR LEFT PART -->
        <?php if(isset( $_SESSION['user_id']) && $_SESSION['categary'] == 'USER') { ?>
			<!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
				<ul class="list-unstyled list-inline pull-right">
					<li><a href="shop-about.php">AboutUs</a></li>
					<li><a href="Customer/shop-Myaccount.php">My Account</a></li>
                </ul>
			</div>
            <!-- END TOP BAR MENU -->
		<?php } else { ?>
			<!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
				<ul class="list-unstyled list-inline pull-right">
					<li><a href="shop-about.php">AboutUs</a></li>
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
			<a href = "Customer/shop-Myaccount.php" ><i class="fa fa-shopping-cart"></a></i>
        </div>
        <!--END CART -->

        <!-- BEGIN NAVIGATION -->

      </div>
    </div>
    <!-- Header END -->

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">

        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">


            <h2>Our Contacts</h2>
            <address>
              <?php echo details($connect, "SELECT value FROM `details` where details ='address'"); ?><br>
              <abbr title="Phone">CONTACT:</abbr> <?php echo details($connect, "SELECT value FROM `details` where details ='contact'"); ?><br>
            </address>
            <address>
              <strong>Email</strong><br>
              <a><?php echo details($connect, "SELECT value FROM `details` where details ='email'"); ?></a><br>
            </address>

          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-9">
            <h1>Contact</h1>
            <div class="content-page">

              <h2>Contact Form</h2>
              <center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"><?php echo $_SESSION['conmail']?></div></center>
              <!-- BEGIN FORM-->
              <form method="POST">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter full name" autocomplete="name" required />
                </div>
                <div class="form-group">
                  <label for="email">Email <span class="require">*</span></label>
                  <input type="email" class="form-control" name="email" placeholder="Enter email" autocomplete="email" required />
                </div>
                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea class="form-control" rows="8" name="mssg" placeholder="Enter your query" autocomplete="mssg" required></textarea>
                </div>
                <div class="padding-top-20">
                  <button type="submit" name="contact" class="btn btn-primary">Submit</button>
                </div>
              </form>
              <!-- END FORM-->
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>

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

    <!-- Load javascripts at bottom, this will reduce page load time -->
    <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->
    <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="assets/pages/scripts/contact-us.js" type="text/javascript"></script>

    <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
