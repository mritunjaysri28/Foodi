<!DOCTYPE html>  
<html>
 <head>
 	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Order Details | Big Bucket</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>



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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
<body>
<div id="page-inner">
	<br /><br />
	<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"></div></center>
	<div class="container" style="width:900px;">
		<h3>Order Details</h3>
		<br /><br />
		<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"></div></center>
		<div id="image_data"></div>

	</div>
</div>
 </body>
</html>

<script>
$(document).ready(function(){

	//fetch data
	fetch_data();
	function fetch_data() {
		var action = "fetch";
		$.ajax({
			url:"action_order.php",
			method:"POST",
			data:{action:action},
			success:function(data) {
				$('#image_data').html(data);
			}
		})
	}

	//delete order
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "delete";
		if(confirm("Are you sure you want to cancel the order")) {
			$.ajax({
				url:"action_order.php",
				method:"POST",
				data:{image_id:image_id, action:action},
				success:function(data) {
					$('#result').html(data);
					fetch_data();
				}
			})
		} else {
			return false;
		}
	});

	//confirm order
      $(document).on('click', '.update', function(){
           var image_id = $(this).attr("id");
			var action = "update";
			$.ajax({
				url:"action_order.php",
				method:"POST",
				data:{image_id:image_id, action:action},
				success:function(data) {
					$('#result').html(data);
					fetch_data();
				}
			})
      });

	//delevered order
      $(document).on('click', '.delevered', function(){
           var image_id = $(this).attr("id");
			var action = "delevered";
			$.ajax({
				url:"action_order.php",
				method:"POST",
				data:{image_id:image_id, action:action},
				success:function(data) {
					$('#result').html(data);
					fetch_data();
				}
			})
      });
});
</script>
