<?php session_start();
function __autoload($class){include $class.".php";}
$_SESSION['reg']="";

//place order
if (isset($_POST['order'])) {
	//email validation
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$_SESSION['reg'] = "Email is Invalid";
	} else {
		//Primary Contact Validation
		if(!preg_match('/^\d{10}$/', $_POST['contact'])) {
			$_SESSION['reg'] = "Primary Contact is Invalid";
		} else {
			//Altenate Contact Validation
			if(!preg_match('/^\d{10}$/', $_POST['a_contact'])) {
				$_SESSION['reg'] = "Secondary Contact is Invalid";
			} else {
				//caity validate
					if(!preg_match("/^[a-zA-Z'-]+$/",$_POST['city'])) {
						$_SESSION['reg'] = "City is Invalid";
					} else {
						//Altenate Contact Validation
						if(!preg_match('/^\d{6}$/', $_POST['pincode'])) {
							$_SESSION['reg'] = "Pincode is Invalid";
						} else {
							if($_POST['transac'] == NULL) {
								$_SESSION['reg'] = "Choose the payment mode";
							} else {
								//Call Update Function
								$a = new Place();
								$a->order("USER");
							}
						}
					}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Checkout | Foodi</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Big Bucket description" name="description">
  <meta content="Big Bucket keywords" name="keywords">
  <meta content="keenthemes" name="author">

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


      <script language="Javascript" src="jquery.js"></script>
    <script type="text/JavaScript" src='state.js'></script>

</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">

<div class="main">
	<div class="container" style="width:100%;">
		<!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
			<!-- BEGIN CONTENT -->
			<div class="col-md-12 col-sm-12">
				<h1>Checkout</h1><center><div style="background-color:#00ffbf; width:30%;"><?php echo $_SESSION['reg']; ?></div></center>
				<!-- BEGIN CHECKOUT PAGE -->
				<div class="panel-group checkout-page accordion scrollable" id="checkout-page">
					<!-- BEGIN PAYMENT ADDRESS -->
					<div id="payment-address" class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">
								<a data-toggle="collapse" data-parent="#checkout-page" href="#payment-address-content" class="accordion-toggle">
									Step 1: Account &amp; Billing Details
								</a>
							</h2>
						</div>
						<div id="payment-address-content" class="panel-collapse collapse">
							<div class="panel-body row">
								<form method="post">
									<div class="col-md-6 col-sm-6">
										<h3>Your Personal Details</h3>
										<div class="form-group">
											<label for="firstname">Name <span class="require">*</span></label>
											<input type="text" name="name" value="<?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="email">E-Mail <span class="require">*</span></label>
											<input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="telephone">Contact <span class="require">*</span></label>
											<input type="number" maxlength="10" name="contact" value="<?php echo $_SESSION['contact']; ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="fax">Alternate Contact</label>
											<input type="number" name="a_contact" value="<?php echo $_SESSION['a_contact']; ?>" class="form-control" required>
										</div>
										<div class="form-group">
											<label for="password">Choose Delivery Before *(Delivery within 1 day)<span class="require">*</span></label>
											<select name="d_time" class="form-control" required> <option value="Any">Any</option><option value="8:30 AM">8:30 AM</option><option value="9:00 AM">9:00 AM</option><option value="9:30 AM">9:30 AM</option><option value="10:00 AM">10:00 AM</option><option value="7:30 PM">7:30 PM</option><option value="8:00 PM">8:00 PM</option><option value="8:30 AM">8:30 AM</option><option value="9:00 PM">9:00 PM</option></select>
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label for="company">Address</label>
											<textarea rows="5" cols="5" name="address" class="form-control" style="margin-top:5%;" required><?php echo $_SESSION['address']; ?></textarea>
										</div>
										<div class="form-group">
											<label for="post-code">Post Code <span class="require">*</span></label>
											<input type="text" name="pincode" value="<?php echo $_SESSION['pincode']; ?>"class="form-control" required>
										</div>
										<div class="form-group">
											<label for="city">City <span class="require">*</span></label>
											<input type="text" name="city" value="LUCKNOW" class="form-control" readonly>
										</div>
										<div class="form-group">
											<label for="country">Country <span class="require">*</span></label>
											<input type="text" name="country" value="INDIA" class="form-control" readonly>
										</div>
										<div class="form-group">
											<label for="region-state">Region/State <span class="require">*</span></label>
											<input type="text" id="listBox" name="state" value="<?php echo $_SESSION['state'] ?>" class="form-control" readonly>
										</div>
									</div>
									<hr>

								</div>
							</div>
						</div>
						<!-- END PAYMENT ADDRESS -->

						<!-- BEGIN PAYMENT METHOD -->
						<div id="payment-method" class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title">
									<a data-toggle="collapse" data-parent="#checkout-page" href="#payment-method-content" class="accordion-toggle">
										Step 2: Payment Method
									</a>
								</h2>
							</div>
							<div id="payment-method-content" class="panel-collapse collapse">
								<div class="panel-body row">
									<div class="col-md-12">
										<p>Please select the preferred payment method to use on this order.</p>
										<div class="radio-list">
											<label>
												<select name="transac"><option value="CashOnDelivery">Cash On Delivery</option></select>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END PAYMENT METHOD -->

						<!-- BEGIN CONFIRM -->
						<div id="confirm" class="panel panel-default">
							<div class="panel-heading">
								<h2 class="panel-title">
									<a data-toggle="collapse" data-parent="#checkout-page" href="#confirm-content" class="accordion-toggle">
										Step 3: Confirm Order
									</a>
								</h2>
							</div>
							<div id="confirm-content" class="panel-collapse collapse">
								<div class="panel-body row">
									<div class="col-md-12 clearfix">
										<div class="table-wrapper-responsive">

											<div id="image_data"></div>

										</div>
										<div class="clearfix"></div>
											<button class="btn btn-primary pull-right" type="submit" name="order" id="button-confirm">Confirm Order</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- END CONFIRM -->
					</div>
					<!-- END CHECKOUT PAGE -->
				</div>
				<!-- END CONTENT -->
			</div>
			<!-- END SIDEBAR & CONTENT -->
		</div>
    </div>

    <!-- Load javascripts at bottom, this will reduce page load time -->
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

    <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="assets/pages/scripts/checkout.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initOWL();
            Layout.initTwitter();
            Layout.initImageZoom();
            Layout.initTouchspin();
            Layout.initUniform();
            Checkout.init();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>

<script>
$(document).ready(function(){

	//fetch data
	fetch_data();
	function fetch_data() {
		var action = "fetch";
		$.ajax({
			url:"cart.php",
			method:"POST",
			data:{action:action},
			success:function(data) {
				$('#image_data').html(data);
			}
		})
	}

	//delete product
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "delete";
		if(confirm("Are you sure you want to remove producct")) {
			$.ajax({
				url:"cart.php",
				method:"POST",
				data:{image_id:image_id, action:action},
				success:function(data) {
					alert(data);
					fetch_data();
				}
			})
		} else {
			return false;
		}
	});

});
</script>
