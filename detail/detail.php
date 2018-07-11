<!DOCTYPE html>  
<html>
 <head>
 	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Contact Details | Big Bucket</title>
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
		<h3>Contact Details</h3>

		<br />
		<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"></div></center>
		<br />

		<div id="image_data"></div>

	</div>
</div>
 </body>
</html>

<script>
$(document).ready(function(){

	//fetch details
	fetch_data();
	function fetch_data() {
		var action = "fetch";
		$.ajax({
			url:"detailback.php",
			method:"POST",
			data:{action:action},
			success:function(data) {
				$('#image_data').html(data);
			}
		})
	}

	//update details
	function edit_data(id, text) {
        var action = "update";
		$.ajax({
				url:"detailback.php",
                method:"POST",
                data:{id:id, text:text, action:action},
                dataType:"text",
                success:function(data){
                    $('#result').html(data);
					fetch_data();
                }
           });
	}

	  //update effect
      $(document).on('blur', '.prod_price', function(){
           var id = $(this).data("id1");
           var first_name = $(this).text();
           edit_data(id, first_name);
      });

});
</script>
