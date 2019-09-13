<?php
	session_start();
	$connect = mysqli_connect("localhost", "root", "", "tut");


?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<title>Shopping Cart</title>

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
</head>
<body>
	<div class="container" style="width: 60%">
		<h2 align="center">Tharindu Learning | Php</h2>

		<?php  
			$query = "SELECT * FROM products ORDER BY id ASC";
			$result = mysqli_query($connect, $query);
			if(mysqli_num_rows($result) > 0)
			{
				while($row = mysqli_fetch_array($result))
				{
					?>
					<div class="col-md-4">
						<form method="post" action="shop.php?action=add&id=<?php echo $row["id"]; ?>">
						<div style="border: 1px solid #eaeaec; margin: -1px 19px 3px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 10px;" align="center">
						<img src="<?php echo $row["image"]; ?> class="img-responsive">
						<h5 class="text-info"><?php echo $row["p_name"]; ?></h5>
						<h5 class="text-danger">$ <?php echo $row["price"]; ?></h5>
						<input type="text" name="quantity" class="form-control" value="1">
						<input type="hidden" name="hidden" value="<?php $row["p_name"]; ?>">
						<input type="hidden" name="hidden" value="<?php $row["price"]; ?>">
						<input type="submit" name="add" style="margin-top: 5px;" class="btn btn-default" value="Add to Bag">
					</div>
					</form>
					</div>
					<?php
				}
			}
			?>
			<div style="clear: both"></div>
			<h2>My Shopping Bag</h2>
			<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th width="40%">Product Name</th>
					<th width="10%">Quantity</th>
					<th width="20%">Price Details</th>
					<th width="15%">Order Total</th>
					<th width="5%">Action</th>
				</tr>
				<?php
				if (!empty($_SESSION["cart"])) {
					$total = 0;
					foreach ($_SESSION["cart"] as $keys => $values) {
						?>
						<tr><?php echo $values["item_name"]; ?></tr>
						<tr><?php echo $values["item_quantity"]; ?></tr>
						<tr>$ <?php echo $values["product_price"]; ?></tr>
						<tr>$ <?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?></tr>
						<td><a href="shop.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">X</span></a>></td>
						<?php
						$total = $total + ($values["item_quantity"] * $values["product_price"]);
					}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
					</tr>
					<?php
				}


				?>
			</table>

			</div>
		
		
	</div>

</body>
</html>