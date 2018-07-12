<?php session_start();
//action.php
if(isset($_POST["action"])) {

$connect = mysqli_connect("localhost", "root", "", "vegetable");



//product add to offer
if($_POST["action"] == "prod") {
	$query = "SELECT prod_price FROM product WHERE prod_id = '".$_POST['image_id']."'";
		$result = mysqli_query($connect, $query);
		while($row = mysqli_fetch_array($result)) {
				$offer_id = $_SESSION['id'];
				$prod_id = $_POST['image_id'];
				$offer_dis = 0;
				$offer_price = $row["prod_price"];
				$quer = "INSERT INTO offer_prod VALUES ('$offer_id', '$prod_id', $offer_dis, $offer_price)";
				if(mysqli_query($connect, $quer)) {
					echo 'Product Sussfully Added to Offer';
				} else {
					echo "try again";
				}
		}
}

//remove product
if($_POST["action"] == "delete") {
	$query = "DELETE FROM offer_prod WHERE prod_id = '".$_POST["image_id"]."' AND offer_id = '".$_SESSION['id']."'";
	if($result = mysqli_query($connect, $query)) {
		echo "product removed";
	} else {
		echo "try again";
	}
}

//update product
if ($_POST['action'] == "update") {
	$id = $_POST["id"];
	$text = $_POST["text"];
	$sql = "UPDATE offer_prod SET offer_dis = '".$text."' WHERE prod_id='".$id."' AND offer_id = '".$_SESSION['id']."'";
	if(mysqli_query($connect, $sql)) {
		echo "Disocunt Applied";
	} else {
		echo "try again";
		echo $_SESSION['id'];
	}
}


//delete offer
if($_POST["action"] == "remove") {
	$query = "DELETE FROM offer WHERE offer_id = '".$_POST["image_id"]."'";
	if(mysqli_query($connect, $query)) {
		echo 'offer Deleted';
	} else {
		echo "try again";
	}
}
}
?>
