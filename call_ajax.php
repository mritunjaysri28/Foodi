<?php
$db_host='localhost';
$db_user='root';
$db_pwd='';
$database='vegetable';
mysql_connect($db_host,$db_user,$db_pwd);
mysql_select_db($database);
$s1=$_REQUEST["n"];
$select_query="select prod_id, prod_pic, prod_ename, prod_hname from product where (prod_ename like '%".$s1."%' || prod_hname like '%".$s1."%')" ;
$sql=mysql_query($select_query) or die (mysql_error());
$s="";
while($row=mysql_fetch_array($sql))
{
	$s=$s."
	<a class='link-p-colr' href='shop-item.php?image_id=".$row['prod_id']."&&off='>
		<div class='live-outer'>
            	<div class='live-im'>
                	<img src='data:image/jpeg;base64,".base64_encode($row['prod_pic'] )."' height='100%' width='auto' alt='".$row['prod_ename'].' - '.$row['prod_hname']."' />
                </div>
                <div class='live-product-det'>
                	<div class='live-product-name'>
                    	<p>".$row['prod_ename'].' - '.$row['prod_hname']."</p>
                    </div>
                    <div class='live-product-price'>

                    </div>
                </div>
            </div>
	</a>
	"	;
}
echo $s;
//<a href='pview.php?id=".$row['id']."&productname=".$row['productname']."'>".$row['productname']."></a>
//<p>".$row['productname']."</p><br>	<p>".$row['producttotalprice']."</p>
?>
