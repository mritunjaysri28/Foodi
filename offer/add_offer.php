<?php session_start();
function __autoload($class){include $class.".php";}

	//establish connection
	$connect = mysqli_connect("localhost", "root", "", "vegetable");

	$_SESSION['offer'] = '';

	//add offer
	if ( isset ( $_POST['insert'] ) ) {
		//Call Address Update Function
		$a = new offerbackend();
		$a->addoff();
	}

	//Offer call
	function offer($connect) {
		echo '<center><table class="table table-bordered table-striped" style="width:auto">
			<tr>
				<th width="auto">Name</th>
				<th width="auto">Discription</th>
				<th width="auto">Start Date</th>
				<th width="auto">End Date</th>
				<th width="auto">Remove</th>
			</tr>';
		//present offer call
		$query = "SELECT offer_name, offer_dis, offer_start, offer_end, offer_id FROM offer WHERE CURDATE() >= offer_start AND CURDATE() <= offer_end";
		$result = mysqli_query($connect, $query);
		while($row = mysqli_fetch_array($result)) {
			echo '<tr>
				<td width="auto">'.$row['offer_name'].'</td>
				<td width="auto">'.$row['offer_dis'].'</td>
				<td width="auto">'.$row['offer_start'].'</td>
				<td width="auto">'.$row['offer_end'].'</td>
				<td width="auto"><button type="button" class="btn btn-danger bt-xs remove" id="'.$row['offer_id'].'">REMOVE</button>
				</td>
      			</tr>';
		}
		echo '</table></center>';
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>

<!-- /. NAV SIDE  -->
	<div id="page-inner">
        <div class="row">
			<div class="col-md-12">
				<h1 class="page-head-line">Add Offer</h1>
			</div>
		</div>
        <!-- /. ROW  -->
        <div class="row">
               <div class="panel panel-info">
					<div class="panel-body">
						<center>
						<div id="result" style="width:30%; height:auto; background-color:#00ffbf;"><?php echo $_SESSION['offer']?></div></center>
						<form method="post">
							<div class="form-group">
								<label>Offer Title</label>
								<input type="text" name="title" id="designation" placeholder="Enter offer title" class="form-control" required/>
							</div>
							<div class="form-group">
								<label>Offer Discription</label>
								<textarea rows="10" cols="50" name="dis" id="designation" placeholder="Enter offer discription" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label>Offer start date</label>
								<input type="date" name="start" id="designation" placeholder="Enter start date" class="form-control" required/>
							</div>
							<div class="form-group">
								<label>Offer end date</label>
								<input type="date" name="end" id="designation" placeholder="Enter end date" class="form-control" required/>
							</div>
							<input type="submit" name="insert" id="insert" value="Add Offer" class="btn btn-info" />
						</form>
					</div>
						<?php echo offer($connect); ?>
				</div>
		</div>

	</div>
	<script>
$(document).ready(function(){

	//delete product
	$(document).on('click', '.remove', function(){
		var image_id = $(this).attr("id");
		var action = "remove";
		if(confirm("Are you sure you want to remove this offer from database?")) {
			$.ajax({
				url:"offer_ajax.php",
				method:"POST",
				data:{image_id:image_id, action:action},
				success:function(data) {
					alert(data);
					window.location.reload();
				}
			})
		} else {
			alert("try again!");
		}
	});

});
</script>
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
