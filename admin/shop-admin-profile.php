<?php
session_start();
function __autoload($class){include $class.".php";}
if ($_SESSION['email']!=NULL && $_SESSION['categary']=="ADMIN" && $_SESSION['status']=="ACTIVE") {

	//edit profile pic
	if ( isset ( $_POST['change_image'] ) ) {
		$a = new AdminBackend();
		$a->profilePic();
	}

	//redirct to page
	if ( @$_REQUEST['url'] == "edit" ) {
  		$url = "../edit_profile/shop-admin-edit.php";
	} else if ( @$_REQUEST['url'] == "addr" ) {
		$url = "../edit_profile/shop-admin-address.php";
	} else if ( @$_REQUEST['url'] == "addprod" ) {
		$url = "../product/shop-product-insert.php";
	}  else if ( @$_REQUEST['url'] == "categ" ) {
		$url = "shop-admin-addcateg.php";
	} else if ( @$_REQUEST['url'] == "prod" ) {
		$url = "../product/shop-dashboard-product.php";
	} else if ( @$_REQUEST['url'] == "addprod" ) {
		$url = "../product/shop-product-insert.php";
	} else if ( @$_REQUEST['url'] == "ord" ) {
		$url = "../order/shop-dashboard-order.php";
	} else if ( @$_REQUEST['url'] == "MERCHENT" ) {
		$url = "block_merchent.php";
	} else if ( @$_REQUEST['url'] == "USER" ) {
		$url = "block_user.php";
	} else if ( @$_REQUEST['url'] == "detail" ) {
		$url = "../detail/detail.php";
	} else if ( @$_REQUEST['url'] == "offer" ) {
		$url = "../offer/add_offer.php";
	} else if ( @$_REQUEST['url'] == "offer_app" ) {
		$url = "../offer/offer_prod.php";
	} else if ( @$_REQUEST['url'] == "slider" ) {
		$url = "../detail/slider.php";
	} else if ( @$_REQUEST['url'] == "brand" ) {
		$url = "../detail/brands.php";
	}  else if ( @$_REQUEST['url'] == "log_out" ) {
		session_destroy();
		echo "<script> window.location.href = '../index.php'; </script>";
	} else {
		$url = "../edit_profile/shop-admin-edit.php";
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foodi | Profile</title>
	<link rel="shortcut icon" href="assets/corporate/img/logos/logo-shop-red.png"type="image/x-icon">
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                </button>
                <a class="navbar-brand" href="">ADMIN</a>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
							<div class="inner-text">
                                <?php echo "Welcome ".$_SESSION['fname']." ".$_SESSION['lname'];?>
                            <br /><br>
                            </div>

                        </div>
                    </li>
                    <li><a href="?url=edit">Edit Profile</a></li>
					<li><a href="?url=addr">Address Book</a></li>
					<li><a href="../Authentication/forget.php" target="blank">Change Password</a></li>
                    <li><a href="?url=categ">Add Product Categary</a></li>
					<li><a href="?url=addprod">Add Product</a></li>
                    <li><a href="?url=prod">Product Details</a></li>
					<li><a href="?url=ord">Order Details</a></li>
					<!--<li><a href="?url=MERCHENT">Block Merchent</a></li>-->
					<li><a href="?url=USER">Block Customer</a></li>
					<li><a href="?url=offer">Add Offer</a></li>
					<li><a href="?url=offer_app">Apply Offer on product</a></li>
					<li><a href="?url=detail">Edit Contact Details</a></li>
					<li><a href="?url=brand">Add Top Brand</a></li>
					<li><a href="?url=slider">Slider</a></li>
					<li><a href="?url=log_out">Logout</a></li>
				</ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
				<iframe src="<?php echo $url; ?>" onload="this.style.height=this.contentDocument.body.scrollHeight + 'px';" scrolling="auto" width="100%" frameborder="1"></iframe>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
        <center>Big Bucket © ALL Rights Reserved | <a href="https://www.linkedin.com/in/mritunjay-srivastava-118451106/" target="blank">Design by : Mritunjay Srivastava </a>.</center>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>

</body>
</html>
<?php } else { echo "<script> window.location.href = '../index.php'; </script>";  } ?>
