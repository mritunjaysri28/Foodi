<?php
if(isset($_POST['count'])){
	header("location:../");
}
?>
<!DOCTYPE html>
<html>
 <head>
 	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>My Order | Nig Bucket</title>


	  <link rel="shortcut icon" href="favicon.ico">

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
  <link href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css"><!-- for slider-range -->
  <link href="assets/plugins/rateit/src/rateit.css" rel="stylesheet" type="text/css">
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
<body id="body">
<div id="page-inner">
<div class="main" style="width:100%;">
      <div class="container" style="width:100%;">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40" style="width:100%;">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12" style="width:100%;">
            <h1>My order</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
				<div id="result"></div>
			  <div class="table-wrapper-responsive">

<div id="image_data"></div>

				</div>
			</div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

      </div>
    </div>
	<!-- END fast view of a product -->

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
    <script src="assets/plugins/rateit/src/jquery.rateit.js" type="text/javascript"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script><!-- for slider-range -->

    <script src="assets/corporate/scripts/layout.js" type="text/javascript"></script>

    <!-- END PAGE LEVEL JAVASCRIPTS -->
 </body>
</html>

<script>
$(document).ready(function(){

	//fetch data
	fetch_data();
	function fetch_data() {
		var action = "fetch";
		$.ajax({
			url:"order.php",
			method:"POST",
			data:{action:action},
			success:function(data) {
				$('#image_data').html(data);
			}
		})
	}

	//cancel
	$(document).on('click', '.update', function(){
		var image_id = $(this).attr("id");
		var action = "update";
		$.ajax({
			url:"order.php",
			method:"POST",
			data:{image_id:image_id, action:action},
			success:function(data) {
				$('#image_data').html("");
				fetch_data();
			}
		})
	});

	//review
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		$.ajax({
			url:"../review/review.php",
			method:"GET",
			data:{image_id:image_id},
			success:function() {
				window.location.href = "../review/review.php?image_id="+ image_id;
			}
		})
	});

	//invoice
	$(document).on('click', '.Invoice', function(){
		var image_id = $(this).attr("id");
		var image_i = $(this).attr("id1");
		$.ajax({
			url:"../invoice/invoice.php",
			method:"GET",
			data:{image_id:image_id},
			success:function() {
				window.location.href = "../invoice/invoice.php?image_id="+image_id+"&&a="+image_i;
			}
		})
	});

});
</script>
