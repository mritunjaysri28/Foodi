<?php session_start();
$connect = mysqli_connect("localhost", "root", "", "vegetable");
$query = "select `user_id`,`fname`,`lname`,`email`,`contact`,`alter_contact`,`status` from user_details where categary ='MERCHENT'";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
<body id="page-inner">
<H3>MERCHENT DETAILS</H3>
<div id="image_data"></div>

<body>
</html>

<script>
$(document).ready(function(){

	//fetch data
	fetch_data();
	function fetch_data() {
		var action = "fetch";
		$.ajax({
			url:"block.php",
			method:"POST",
			data:{action:action, categ:"MERCHENT"},
			success:function(data) {
				$('#image_data').html(data);
			}
		})
	}

	//delete product
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "delete";
		if(confirm("Are you sure you want to change the status")) {
			$.ajax({
				url:"block.php",
				method:"POST",
				data:{image_id:image_id, action:action},
				success:function(data) {
					fetch_data();
				}
			})
		} else {
			return false;
		}
	});

});
</script>
