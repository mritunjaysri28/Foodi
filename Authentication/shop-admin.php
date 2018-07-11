<!DOCTYPE html>
<?php session_start();
function __autoload($class){include $class.".php";}

	//login
	if( isset ( $_POST['login'] ) ) {
		$a = new Validate();
		$a->login('ADMIN');
	}
?>
<html >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v3.12.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Web Page Builder Description">
  <title>Sign In | Sign Up</title>
  <link rel="shortcut icon" href="assets/corporate/img/logos/logo-shop-red.png"type="image/x-icon">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


      <link rel="stylesheet" href="assets/form/css/style.css">
  <!--captcha-->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!--/captcha-->

</head>

<body>

  <div class="form">


      <div class="tab-content">

        <div id="login">
			<center><img src="assets/corporate/img/logos/logo-shop-red.png" alt="Big Bucket" class="avatar" width="50%" height="auto"></center>
			<br><br>
          <h1>ADMIN | Log In</h1>

          <form method="post">

            <div class="field-wrap">
            <input type="text" name="email" autocomplete="off" placeholder="Enter Email-Id"  style="color:white;" required/>
          </div>

          <div class="field-wrap">
           <!--pattern=".{6,}"--> <input type="password" name="pwd" autocomplete="off" placeholder="Enter Password"  style="color:white;" required/>
          </div>

          <p class="forgot"><a href="forget.php">Forgot Password?</a></p>
          <button class="button button-block" name="login"/>Log In</button>

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->




  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="assets/form/js/index.js"></script>
  <script>
	document.getElementById('login').style.display='block';
  </script>
  <script>
		// Get the modal
		var fpass = document.getElementById('forget');
		var fpass = document.getElementById('login');
		var fpass = document.getElementById('signup');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == fpass) {
				fpass.style.display = "none";
			}
		}

	</script>

</body>
</html>
