<?php session_start();
function __autoload($class){include $class.".php";}
$connect = mysqli_connect("localhost", "root", "", "vegetable");

	$_SESSION['add_prod'] = "";
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

<!-- /. NAV SIDE  -->
	<div id="page-inner">
        <div class="row">
			<div class="col-md-12">
				<h1 class="page-head-line">Add Product</h1>
			</div>
		</div>
        <!-- /. ROW  -->
        <div class="row">
               <div class="panel panel-info">
					<div class="panel-body">
						<center>
						<div id="result" style="width:30%; height:auto; background-color:#00ffbf;"><?php echo $_SESSION['add_prod']?></div></center>
						<form id="image_form" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Select Categary</label>
								<select name="categ" id="gender" class="form-control">
								<option value="VEGE">VEGETABLE</option>
								<option value="FRUI">FRUIT</option>
								<?php
									$query_categ = "SELECT * FROM categary ORDER BY categ_name";
									$categ = mysqli_query($connect, $query_categ);
									while($cate = mysqli_fetch_array($categ)) {
								?>
									<option value="<?php echo $cate["categ_id"]; ?>"><?php echo $cate["categ_name"]; ?></option>
								<?php
									}
								?>
								</select>
							</div>
							<div class="form-group">
								<label>Product Name English</label>
								<input type="text" name="prod_name_eng" id="designation" placeholder="Enter product name" class="form-control" required/>
							</div>
							<div class="form-group">
								<label>Product Name Hindi</label>
								<input type="text" name="prod_name_hin" id="designation" placeholder="Enter product name" class="form-control" />
							</div>
							<div class="form-group">
								<label>Weight</label>
								<input type="text" name="weight" id="designation" placeholder="Enter weight" class="form-control" required/>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" name="prod_price" id="designation" placeholder="Enter product price of 1Kg" class="form-control" required />
							</div>
							<div class="form-group">
								<label>Discount Percentage</label>
								<input type="number" name="prod_disc" id="designation" min="0" max="100" placeholder="Enter dicount in %" class="form-control" required />
							</div>
							<div class="form-group">
								<label>Stock (in kg) </label>
								<input type="number" name="prod_stock" id="designation" placeholder="Enter avilable stock in Kg" class="form-control" style="weidth:45%;" required />
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea rows="5" name="prod_desc" id="address" placeholder="Enter product discription" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>Choose Pic</label>
								<input type="file" name="image" id="image" class="form-control"/></p><br />
								<input type="hidden" name="action" id="action" value="insert" />
								<input type="hidden" name="image_id" id="image_id" />
							</div>
							<input type="submit" name="insert" id="insert" value="Add Product" class="btn btn-info" />
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

<script>
$(document).ready(function(){

 //insert product
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
						$('#result').html(data);

					}
				});
			}
		}
	});
});
</script>
</body>
</html>
