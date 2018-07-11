<?php session_start(); 
function __autoload($class){include $class.".php";}
	$_SESSION['edit_addr'] = "";

	//edit profile
	if ( isset ( $_POST['epro'] ) ) {
		//Address validation
		if(strlen($_POST['address']) < 30) {
			$_SESSION['edit_addr'] = "Address is to short";
		} else {
			//District Vaildation
			if(!preg_match("/^[a-zA-Z'-]+$/",$_POST['district'])) {
				$_SESSION['edit_addr'] = "Last Name is Invalid";
			} else {
				//Pincode Validation
				if(!preg_match('/^\d{6}$/', $_POST['pincode'])) {
					$_SESSION['edit_addr'] = "Pincode is Invalid";
				} else {
					//state Validation
					if($_POST['state'] == "SELECT STATE") {
						$_SESSION['edit_addr'] = "State is Invalid";
					} else {
						//Call Address Update Function
						$a = new Editprofile();
						$a->updateAddress();
					}
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
	<!--State List-->
    <script language="Javascript" src="jquery.js"></script>
    <script type="text/JavaScript" src='state.js'></script>
</head>
<body>

<!-- /. NAV SIDE  -->
	<div id="page-inner">
        <div class="row">
			<div class="col-md-12">
				<h1 class="page-head-line">Address Book</h1>
			</div>
		</div>
        <!-- /. ROW  -->
        <div class="row">
               <div class="panel panel-info">
					<div class="panel-body">
						<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"><?php echo $_SESSION['edit_addr']?></div></center>
						<form method="post">
							<div class="form-group">
								<label>Address</label>
								<textarea rows="5" cols="50" class="form-control" name="address" required/><?php echo $_SESSION['address']; ?></textarea>
							</div>
							<div class="form-group">
								<label>Pin Code</label>
								<input class="form-control" type="text" maxlength="6" name="pincode" value="<?php echo $_SESSION['pincode']; ?>" required/>
							</div>
							<div class="form-group">
								<label>District</label>
								<input type="text" name="district" value="LUCKNOW" id="first-name" class="form-control" readonly>
							</div>
							<div class="form-group" >
								<label>State</label>
								<input type="text" name="state" value="UTTAR PRADESH" id="first-name" class="form-control" readonly>
							</div>
							<div class="form-group">
								<label>Country</label>
								<input class="form-control" type="text" minlength="10" maxlength="10" name="contact" value="INDIA" readonly/>
							</div>
							<button type="submit" class="btn btn-info" name="epro">Update Address </button>
						</form>
					</div>
				</div>

		</div>
	</div>
      <div id="dumdiv" align="center" style=" font-size: 10px;color: #dadada;">
        <a id="dum" style="padding-right:0px; text-decoration:none;color: green;text-align:center;" href="http://www.hscripts.com">&copy;h</a>
      </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
