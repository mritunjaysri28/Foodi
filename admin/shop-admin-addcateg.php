<?php session_start();
function __autoload($class){include $class.".php";}
	$connect = mysqli_connect("localhost", "root", "", "vegetable");

	$_SESSION['add_categ'] = "";

	function categ($connect) {
		$query = "SELECT categ_id, `categ_name`, `section` FROM `categary` ORDER BY categ_id DESC";
		$result = mysqli_query($connect, $query);
		$prod = '<table class="table table-bordered table-striped" style="width:auto">
					<tr>
						<th width="auto">Categ_id</th>
						<th width="auto">Categary Name</th>
						<th width="auto">Section</th>
					</tr>
				';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.'<tr>
						<td width="auto">'.$row['categ_id'].'</td>
						<td width="auto">'.$row['categ_name'].'</td>
						<td width="auto">'.$row['section'].'</td>
						<td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["categ_id"].'">REMOVE</button></td>
					</tr>';
		}
		return $prod.'</table>';
	}

	$table = categ($connect);

	//add categary
	if ( isset ( $_POST['cate'] ) ) {
		$a = new AdminBackend();
		$a->addCategary();
		$table = categ($connect);
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
<div id="page-inner" style="height:auto;">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-head-line">Add Categary</h1>
		</div>
	</div>
    <!-- /. ROW  -->
    <div class="row">
		<div class="panel panel-info">
			<div class="panel-body">
				<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"><?php echo $_SESSION['add_categ'];?></div></center>
				<form method="post">
					<div class="form-group">
						<label>Section</label>
						<select class="form-control" name="section">
							<option value="Vegetable">Vegetable</option>
							<option value="Fruit">Fruit</option>
							<option value="Kids">Kids & Baby Care</option>
							<option value="Persnal">Persnal Care & Health Care</option>
							<option value="Home">Home care</option>
							<option value="Grocery">Grocery</option>
							<option value="Patanjali">Patanjali</option>
						</select>
					</div>
					<div class="form-group">
						<label>Categary Name</label>
						<input class="form-control" type="text" name="categary" required/>
					</div>
					<button type="submit" class="btn btn-info" name="cate">Add Categary</button>
				</form>
			</div>
			<center>
			<h3>Categary Details</h3>
			<?php //echo $table; ?><div id="image_data"></div>
			</center>
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

<script>
$(document).ready(function(){

	//show categary
	fetch_data();
	function fetch_data() {
		var action = "fetchcateg";
		$.ajax({
			url:"block.php",
			method:"POST",
			data:{action:action, categ:"USER"},
			success:function(data) {
				$('#image_data').html(data);
			}
		})
	}

	//delete categary
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "categ";
		if(confirm("Are you sure you want to delete the categary")) {
			$.ajax({
				url:"block.php",
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

});
</script>

</body>
</html>
