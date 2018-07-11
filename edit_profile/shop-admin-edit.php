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
</head>
<body>

<!-- /. NAV SIDE  -->
	<div id="page-inner">
        <div class="row">
			<div class="col-md-12">
				<h1 class="page-head-line">Edit Profile</h1>
			</div>
		</div>
        <!-- /. ROW  -->
        <div class="row">
               <div class="panel panel-info">
					<div class="panel-body">
						<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"><?php echo $_SESSION['edit_prof']?></div></center>
						<form method="post">
							<div class="form-group">
								<label>First Name</label>
								<input class="form-control" type="text" name="fname" value="<?php echo $_SESSION['fname']; ?>" required/>
							</div>
							<div class="form-group">
								<label>Last Name</label>
								<input class="form-control" type="text" name="lname" value="<?php echo $_SESSION['lname']?>" required/>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" value="<?php echo $_SESSION['email']?>" required/>
							</div>
							<div class="form-group">
								<label>Primary Contact</label>
								<input class="form-control" type="text" maxlength="10" name="contact" value="<?php echo $_SESSION['contact']?>" required/>
							</div>
							<div class="form-group">
								<label>Alternate Contact</label>
								<input class="form-control" type="text" maxlength="10" name="alter_contact" value="<?php echo $_SESSION['a_contact']?>" required/>
							</div>
							<button type="submit" class="btn btn-info" name="epro">Update Profile </button>
						</form>
					</div>
				</div>
		</div>
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
