<?php session_start(); 
function __autoload($class){include $class.".php";}
	$_SESSION['edit_prof'] = "";
	//edit profile
	if ( isset ( $_POST['epro'] ) ) {
		//First Name validation
		if(!preg_match("/^[a-zA-Z'-]+$/",$_POST['fname'])) {
			$_SESSION['edit_prof'] = "First Name is Invalid";
		} else {
			//Last Name Vaildation
			if(!preg_match("/^[a-zA-Z'-]+$/",$_POST['lname'])) {
				$_SESSION['edit_prof'] = "Last Name is Invalid";
			} else {
				//email validation
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$_SESSION['edit_prof'] = "Email is Invalid";
				} else {
					//Primary Contact Validation
					if(!preg_match('/^\d{10}$/', $_POST['contact'])) {
						$_SESSION['edit_prof'] = "Primary Contact is Invalid";
					} else {
						//Altenate Contact Validation
						if(!preg_match('/^\d{10}$/', $_POST['alter_contact'])) {
							$_SESSION['edit_prof'] = "Secondary Contact is Invalid";
						} else {
							//Call Update Function
							$a = new Editprofile();
							$a->updateProfile();
						}
					}
				}
			}
		}
	}
?>
<!DOCTYPE html>

<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>Sign In | Sign Out</title>

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
</head>
<!-- Head END -->

<!-- Body BEGIN -->
<body class="ecommerce">

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7" style="width:100%;">
            <h1>Edit Profile</h1>
            <div class="content-form-page" style="width:100%;">
				<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"><?php echo $_SESSION['edit_prof'];?></div></center>
              <form method="post" class="form-horizontal form-without-legend">
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="first-name">First Name </label>
                  <div class="col-lg-8">
                    <input type="text" name="fname" id="first-name" class="form-control" value="<?php echo $_SESSION['fname']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="last-name">Last Name </label>
                  <div class="col-lg-8">
                    <input type="text" name="lname" id="first-name" class="form-control" value="<?php echo $_SESSION['lname']?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="email">E-Mail </label>
                  <div class="col-lg-8">
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $_SESSION['email']?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="telephone">Contact </label>
                  <div class="col-lg-8">
                    <input type="text" name="contact" maxlength="10" id="telephone" class="form-control" value="<?php echo $_SESSION['contact']?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label" for="fax">Alternate Contact </label>
                  <div class="col-lg-8">
                    <input type="text" name="alter_contact" maxlength="10" id="fax" class="form-control" value="<?php echo $_SESSION['a_contact']?>" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-8 col-md-offset-2 padding-left-0 padding-top-20">
                    <button class="btn btn-primary" type="submit" name="epro">Update Account</button>
                  </div>
                </div>
              </form>
            </div>
			          </div>
          <!-- END CONTENT -->




    <!-- Load javascripts at bottom, this will reduce page load time -->
    <!-- BEGIN CORE PLUGINS(REQUIRED FOR ALL PAGES) -->
    <!--[if lt IE 9]>
    <script src="assets/plugins/respond.min.js"></script>
    <![endif]-->
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
</body>
<!-- END BODY -->
</html>
