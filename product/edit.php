<?php
 $connect = mysqli_connect("localhost", "root", "", "vegetable");
 $id = $_POST["id"];
 $text = $_POST["text"];
 $column_name = $_POST["column_name"];
 $sql = "UPDATE product SET ".$column_name."='".$text."' WHERE prod_id='".$id."'";
 if(mysqli_query($connect, $sql)) {
	echo "Updated";
 } else {
	 echo "try again";
 }
 ?>
