<?php session_start();
function __autoload($class){include $class.".php";}
$connect = mysqli_connect("localhost", "root", "", "vegetable");

	function slider($connect) {
		$query = "SELECT brand_pic, brand_name, brand_id FROM `brand` ORDER BY brand_id";
		$result = mysqli_query($connect, $query);
		$prod = '<center><table class="table table-bordered table-striped" style="width:auto">
					<tr>
						<th width="auto">Slider</th>
						<th width="auto">Slider Title</th>
					</tr>
				';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.'<tr>
						<td width="auto"> <img src="data:image/jpeg;base64,'.base64_encode($row['brand_pic'] ).'" height="30%" width="70%" /> </td>
						<td width="auto">'.$row['brand_name'].'</td>
						<td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["brand_id"].'">REMOVE</button></td>
					</tr>';
		}
		return $prod.'</table></center>';
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

<!-- /. NAV SIDE  -->
	<div id="page-inner">
        <div class="row">
			<div class="col-md-12">
				<h1 class="page-head-line">Add Slider</h1>
			</div>
		</div>
        <!-- /. ROW  -->
        <div class="row">
               <div class="panel panel-info">
					<div class="panel-body">
						<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"></div></center>
						<form id="image_form" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Brand Name</label>
								<input type="text" name="slider_title" id="designation" placeholder="Enter brand name" class="form-control" required/>
							</div>
							<div class="form-group">
								<label>Choose Pic</label>
								<input type="file" name="image" id="image" class="form-control"/></p><br />
								<input type="hidden" name="action" id="action" value="insert" />
								<input type="hidden" name="image_id" id="image_id" />
							</div>
							<input type="submit" name="insert" id="slider" value="Add Brand" class="btn btn-info" />
						</form>
					</div>
				</div>
		</div>
		<div class="row">
			<?php echo slider($connect); ?>
		</div>
	</div>

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

<script>
$(document).ready(function(){

 //insert
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
					url:"brandback.php",
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

		//delete product
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "delete";
		if(confirm("Are you sure you want to remove this brand from database?")) {
			$.ajax({
				url:"brandback.php",
				method:"POST",
				data:{image_id:image_id, action:action},
				success:function(data) {
					alert(data);
					location.reload();
				}
			})
		} else {
			return false;
		}
	});

});
</script>
</body>
</html>
