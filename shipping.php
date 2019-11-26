<?php
    // Redirect to the home page if id parameter not found in URL
    if(empty($_GET['id'])){
        header("Location: index.php");
    }

    // Include and initialize database class
    include 'DB.class.php';
    $db = new DB;

    // Include and initialize paypal class
    include 'PaypalExpress.class.php';
    $paypal = new PaypalExpress;

    // Get product ID from URL
    $productID = $_GET['id'];

    // Get product details
    $conditions = array(
        'where' => array('id' => $productID),
        'return_type' => 'single'
    );
    $productData = $db->getRows('products', $conditions);

    // Redirect to the home page if product not found
    if(empty($productData)){
        header("Location: index.php");
    }
?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<!doctype html>
<html lang="pt-BR">
	<head>
		<title>My Web Store - Shipping</title>
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
						<h2>Shipping</h2>
					</div>
                </div>
                <form method="post" action='saveclient.php'>
                    <div class="row">

                        <div class="col">
                            <h4 class="my-4">Shipping Informations</h4>

                            <input class='input' type='hidden' name='id' value='<?php echo $_GET['id']; ?>' />

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="shipName">Name</label>
                                    <input type="text" class="form-control" id="shipName" name="shipName" placeholder="First name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="shipLastname">Lastname</label>
                                    <input type="text" class="form-control" id="shipLastname" name="shipLastname" placeholder="Last name">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="shipPhone">Phone</label>
                                    <input type="text" class="form-control" id="shipPhone" name="shipPhone" placeholder="Phone number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="shipEmail">E-mail</label>
                                    <input type="email" class="form-control" id="shipEmail" name="shipEmail" placeholder="E-mail">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="shipAddress">Address</label>
                                <input type="text" class="form-control" id="shipAddress" name="shipAddress" placeholder="1234 Main St">
                            </div>

                            <div class="form-group">
                                <label for="shipAddress2">Address 2</label>
                                <input type="text" class="form-control" id="shipAddress2" name="shipAddress2" placeholder="Apartment, studio, or floor">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="shipCity">City</label>
                                    <input type="text" class="form-control" id="shipCity" name="shipCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="shipState">State</label>
                                    <input type="text" class="form-control" id="shipState" name="shipState">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="shipZip">Zip</label>
                                    <input type="text" class="form-control" id="shipZip">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Go to Checkout</button>
                        </div>

                        <div class='col'>
                            <h4 class="my-4">Product</h4>
                            <div class="product">
                                <img src="./views/assets/products/<?php echo $productData['image']; ?>" class='img-fluid product-image'/>
                                <div class='product-title'><?php echo $productData['name']; ?></div>
                                <div class='product-code'>code: <?php echo $productData['id']; ?></div>
                                <div class='product-price'>$ <?php echo number_format($productData['price'], 2); ?></div>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</body>
</html>