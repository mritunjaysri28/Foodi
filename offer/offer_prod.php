<?php session_start();
function __autoload($class){include $class.".php";}



	//establish connection
	$connect = mysqli_connect("localhost", "root", "", "vegetable");
	$table = "";
	$id = "";

	//add offer
	if ( isset ( $_POST['apply'] ) ) {
		$table = '<form method="post"><input type="submit" name="disc" id="insert" value="Apply Discount" class="btn btn-info" style="margin-bottom:2%"/></form>';
		$_SESSION['id'] = $_POST['offer'];
		$table = $table.prod($connect);
	}

	//apply discount
	if ( isset ( $_POST['disc'] ) ) {
		$table = $table.offer($connect);
	}

	//offer call
	function offer_prod($connect, $query) {
		$count = 0;
		$result = mysqli_query($connect, $query);
		$prod = '<select class="form-control" name="offer">';
		while($row = mysqli_fetch_array($result)) {
			$prod = $prod.'<option value="'.$row['offer_id'].'">'.$row['offer_name'].'</option>';
			$count = 1;
		}
		if ($count == 0) {
			$prod = $prod.'<option>Create Some Offer</option>';
		}
		return $prod.'</select>';
	}

	//product call
	function prod($connect) {
		$query = "SELECT product.prod_ename as prod_ename, product.prod_hname as prod_hname, product.weight as weight, product.prod_price as prod_price, product.prod_disc as prod_disc, product.prod_stock as prod_stock, product.prod_id as prod_id
					FROM
					product LEFT JOIN offer_prod
					ON
					product.prod_id = offer_prod.prod_id
					WHERE
					product.prod_id NOT IN (
						SELECT product.prod_id
						FROM
						product INNER JOIN offer_prod
						ON
						product.prod_id = offer_prod.prod_id
					)
					ORDER BY product.prod_id DESC";
		$result = mysqli_query($connect, $query);
		$table = '<table class="table table-bordered table-striped" style="width:auto">
							<tr>
								<th width="auto">Product</th>
								<th width="auto">Product Name</th>
								<th width="auto">Unit Price</th>
								<th width="auto">Discount</th>
								<th width="auto">Stock (kg)</th>
							</tr>
						';
		while($row = mysqli_fetch_array($result)) {
			$table = $table.'<tr>
								<td width="auto">'.$row["prod_ename"].' - '.$row["prod_hname"].' '.$row["weight"].'</td>
								<td width="auto">'.$row["prod_price"].'</td>
								<td width="auto">'.$row["prod_disc"].'</td>
								<td width="auto">'.$row["prod_stock"].'</td>
								<td><button type="button" name="delete" class="btn btn-danger bt-xs prod" id="'.$row["prod_id"].'">ADD</button></td>
							</tr>';
		}
		return $table.'</table>';
	}

	//offer product call
	function offer($connect) {
		$query = "SELECT product.prod_ename as prod_ename, product.prod_hname as prod_hname, product.weight as weight, product.prod_price as prod_price, product.prod_disc as prod_disc, product.prod_stock as prod_stock, product.prod_id as prod_id, offer_prod.offer_dis as dis
					FROM
					product INNER JOIN offer_prod
					ON
					product.prod_id = offer_prod.prod_id
					WHERE
					offer_prod.offer_id = '".$_SESSION['id']."'
					ORDER BY offer_prod.offer_dis";
		$result = mysqli_query($connect, $query);
		$table = '<table class="table table-bordered table-striped" style="width:auto">
							<tr>
								<th width="auto">Product</th>
								<th width="auto">Product Name</th>
								<th width="auto">Price</th>
								<th width="auto">Actual Discount</th>
								<th width="auto">Offer Discount</th>
								<th width="auto">Stock (kg)</th>
							</tr>
						';
		while($row = mysqli_fetch_array($result)) {
			$table = $table.'<tr>
								<td width="auto">'.$row["prod_ename"].' - '.$row["prod_hname"].' '.$row["weight"].'</td>
								<td width="auto">'.$row["prod_price"].'</td>
								<td width="auto">'.$row["prod_disc"].'</td>
								<td width="auto" class="prod_disc" data-id2="'.$row["prod_id"].'" contenteditable>'.$row["dis"].'</td>
								<td width="auto">'.$row["prod_stock"].'</td>
								<td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["prod_id"].'">REMOVE</button></td>
							</tr>';
		}
		return $table.'</table>';
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
			<h1 class="page-head-line">Offer on Product</h1>
		</div>
	</div>
    <!-- /. ROW  -->
    <div class="row">
		<center><div id="result" style="width:30%; height:auto; background-color:#00ffbf;"></div></center>
		<div class="panel panel-info">
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label>Select Offer</label>
						<?php echo offer_prod($connect, "SELECT offer_id, offer_name FROM offer WHERE CURDATE() <= offer_end"); ?>
					</div>
					<input type="submit" name="apply" id="insert" value="Select Offer" class="btn btn-info" />
				</form>
			</div>
		</div>
	</div>

	<!--product display start-->
	<center>
		<div class="row">
			<?php echo $table; ?>
		</div>
	</center>
	<!--product dispay end-->
</div>


<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<script>
$(document).ready(function(){

	//product to offer
	$(document).on('click', '.prod', function(){
		var image_id = $(this).attr("id");
		var action = "prod";
		$.ajax({
			url:"offer_ajax.php",
			method:"POST",
			data:{image_id:image_id, action:action},
			success:function(data) {
				alert(data);
				window.location.reload();
			}
		})
	});

	//remove product
	$(document).on('click', '.delete', function(){
		var image_id = $(this).attr("id");
		var action = "delete";
		if(confirm("Are you sure you want to remove product from offer!")) {
			$.ajax({
				url:"offer_ajax.php",
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

	//update
	function edit_data(id, text, column_name) {
		var action = "update";
        $.ajax({
            url:"offer_ajax.php",
            method:"POST",
            data:{id:id, text:text, action:action},
            dataType:"text",
            success:function(data){
                $('#result').html(data);
            }
        });
    }

	//update discount on offer
    $(document).on('blur', '.prod_disc', function(){
        var id = $(this).data("id2");
        var last_name = $(this).text();
        edit_data(id,last_name, "prod_disc");
    });

});
</script>

</body>
</html>
