<?php
    // Include and initialize database class
    include 'DB.class.php';
    $db = new DB;

    // Get all products
    $products = $db->getRows('products');
?>

<!doctype html>
<html lang="pt-BR">
	<head>
		<title>Produtos Ativos</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php include "views/link.php"; ?>
	</head>
	<body>
		<?php include "views/navbar.php"; ?>

		<div class="container-fluid">
			<div class="container">
				<div class="row text-center title my-3">
					<div class="col">
						<h1>Checkout</h1>
					</div>
				</div>

                <div class='row'>
                    <?php
                        // List all products
                        if(!empty($products)){
                            foreach($products as $row){
                    ?>
                    
                        <div class='col product'>
                            <img src="./views/assets/products/<?php echo $row['image']; ?>" class='img-fluid product-image'/>
                            <div class='product-title'><?php echo $row['name']; ?></div>
                            <div class='product-code'>code: <?php echo $row['id']; ?></div>
                            <div class='product-price'>$ <?php echo number_format($row['price'], 2); ?></div>
                            <a href="shipping.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary">Buy Now $</a>
                        </div>
                    
                    <?php        
                            }
                        }else{
                            echo '<p>Product(s) not found...</p>';
                        }
                    ?>
                </div>
			</div>
		</div>

	</body>
</html>