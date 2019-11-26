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
<!--
JavaScript code to render PayPal checkout button
and execute payment
-->
<script>
    paypal.Button.render({
        // Configure environment
        env: '<?php echo $paypal->paypalEnv; ?>',
        client: {
            sandbox: '<?php echo $paypal->paypalClientID; ?>',
            production: '<?php echo $paypal->paypalClientID; ?>'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'gold',
            shape: 'pill',
        },
        // Set up a payment
        payment: function (data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: '<?php echo $productData['price']; ?>',
                        currency: 'USD'
                    }
                }]
        });
        },
        // Execute the payment
        onAuthorize: function (data, actions) {
            return actions.payment.execute()
            .then(function () {
                // Show a confirmation message to the buyer
                //window.alert('Thank you for your purchase!');
                
                // Redirect to the payment process page
                window.location = "process.php?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&pid=<?php echo $productData['id']; ?>";
            });
        }
    }, '#paypal-button');
</script>

<!doctype html>
<html lang="pt-BR">
	<head>
		<title>My Web Store - Checkout</title>
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
						<h2>Checkout</h2>
					</div>
                </div>
                <form method="post">
                    <div class="row">
                        <div class='col'>
                            <div class="product">
                                <img src="./views/assets/products/<?php echo $productData['image']; ?>" class='img-fluid product-image'/>
                                <div class='product-title'><?php echo $productData['name']; ?></div>
                                <div class='product-code'>code: <?php echo $productData['id']; ?></div>
                                <div class='product-price'>$ <?php echo number_format($productData['price'], 2); ?></div>
                                <div id="paypal-button"></div>
                            </div>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</body>
</html>