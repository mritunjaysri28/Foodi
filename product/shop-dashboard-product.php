<!DOCTYPE html>  
<html>
 <head>
 	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Product Details | Big Bucket</title>
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
		<h3>Product Details</h3>
		<br /><br />

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
			url:"product.php",
			method:"POST",
			data:{action:action},
			success:function(data) {
				$('#image_data').html(data);
			}
		})
	}

	//image validation
	$('#image_form').submit(function(event){
		event.preventDefault();
		var image_name = $('#image').val();
		if(image_name == '') {
			alert("Please Select Image");
			return false;
		} else {
			var extension = $('#image').val().split('.').pop().toLowerCase();
			if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
				alert("Invalid Image File");
				$('#image').val('');
				return false;
			} else {
				$.ajax({
					url:"product.php",
					method:"POST",
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data) {
						alert(data);
						fetch_data();
						$('#image_form')[0].reset();
						$('#imageModal').modal('hide');
					}
				});
			}
		}
	});

	//delete product
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "delete";
		if(confirm("Are you sure you want to remove this image from database?")) {
			$.ajax({
				url:"product.php",
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

	//update
	function edit_data(id, text, column_name)
      {
           $.ajax({
                url:"edit.php",
                method:"POST",
                data:{id:id, text:text, column_name:column_name},
                dataType:"text",
                success:function(data){
                     $('#result').html(data);
                }
           });
      }

	  //update effect
      $(document).on('blur', '.prod_price', function(){
           var id = $(this).data("id1");
           var first_name = $(this).text();
           edit_data(id, first_name, "prod_price");
      });
      $(document).on('blur', '.prod_disc', function(){
           var id = $(this).data("id2");
           var last_name = $(this).text();
           edit_data(id,last_name, "prod_disc");
      });
	  $(document).on('blur', '.prod_stock', function(){
           var id = $(this).data("id3");
           var first_name = $(this).text();
           edit_data(id, first_name, "prod_stock");
      });
      $(document).on('blur', '.prod_desc', function(){
           var id = $(this).data("id4");
           var last_name = $(this).text();
           edit_data(id,last_name, "prod_desc");
      });

});
</script>
