<?php
    if(!empty($_GET['id'])){

        // Include and initialize database class
        include 'DB.class.php';
        $db = new DB;

        // Get payment details
        $conditions = array(
            'where' => array('id' => $_GET['id']),
            'return_type' => 'single'
        );
        $paymentData = $db->getRows('payments', $conditions);
    }
?>

<html lang="pt-BR">
	<head>
		<title>My Web Store - Payment Status</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php include "views/link.php"; ?>
	</head>
	<body>
		<?php include "views/navbar.php"; ?>

		<div class="container-fluid">
			<div class="container">
                <!-- <div class="row text-center title my-3">
					<div class="col">
						<h2>Checkout</h2>
					</div>
				</div> -->

                <?php
                    // List all products
                    if(!empty($paymentData)){
                ?>
                    <div class="row text-center my-3">
                        <div class='col product'>
                        <h3>Your payment was successful!</h3>
                        <p>TXN ID: <?php echo $paymentData['txn_id']; ?></p>
                        <p>Paid Amount: <?php echo $paymentData['payment_gross'].' '.$paymentData['currency_code']; ?></p>
                        <p>Payment Status: <?php echo $paymentData['payment_status']; ?></p>
                        <p>Payment Date: <?php echo $paymentData['created']; ?></p>
                        </div>
                    </div>
                <?php        
                    }else{
                        echo '<p>Payment was unsuccessful</p>';
                    }
                ?>
                <a href="index.php">Back to Home</a>
            </div>
		</div>
	</body>
</html>