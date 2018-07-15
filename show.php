<?php
session_start();
?>
<html>
<head>
<title>ThaiCreate.Com</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
mysql_connect("localhost","root","password");
mysql_select_db("testaddcard");
?>
<table width="400"  border="1">
  <tr>
    <td width="101">ProductID</td>
    <td width="82">ProductName</td>
    <td width="82">Price</td>
    <td width="79">Qty</td>
    <td width="79">Total</td>
    <td width="10">Del</td>
  </tr>
  <?php
  $Total = 0;
  $SumTotal = 0;

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
		$strSQL = "SELECT * FROM product WHERE ProductID = '".$_SESSION["strProductID"][$i]."' ";
		$objQuery = mysql_query($strSQL)  or die(mysql_error());
		$objResult = mysql_fetch_array($objQuery);
		$Total = $_SESSION["strQty"][$i] * $objResult["Price"];
		$SumTotal = $SumTotal + $Total;
	  ?>
	  <tr>
		<td><?=$_SESSION["strProductID"][$i];?></td>
		<td><?=$objResult["ProductName"];?></td>
		<td><?=$objResult["Price"];?></td>
		<td><?=$_SESSION["strQty"][$i];?></td>
		<td><?=number_format($Total,2);?></td>
		<td><a href="delete.php?Line=<?=$i;?>">x</a></td>
	  </tr>
	  <?php
	  }
  }
  ?>
</table>
Sum Total <?=number_format($SumTotal,2);?>
<br><br><a href="product.php">Go to Product</a>
<?php
	if($SumTotal > 0)
	{
?>
	| <a href="checkout.php">CheckOut</a>
<?php
	}
?>
<?php
mysql_close();
?>
</body>
</html>

<?php/* This code download from www.ThaiCreate.Com */ ?>