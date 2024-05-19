<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/form.css', '/css/itemlist.css'), "Checkout");
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
};

$user = $_SESSION['user'];
?>

<body>
    <?php getNavbar(); ?>
    <h1>Checkout</h1>
    <h2>Items to checkout:</h2>
    <?php foreach ($data['items'] as $item) { ?>
        <article>
            <div class="desc">
                <p><b>Model: </b><?= $item->model ?></p>
                <p><b>Brand: </b><?= $item->brand ?></p>
                <p><b>Price: </b><?= $item->price ?>€</p>
                <p><b>Created at: </b><?= $item->created_at ?></p>
                <p><b>Status: </b>For sale</p>
            </div>
            <img src="<?= $item->url ?>" alt="Image">

        </article>


    <?php $topay += $item->price;
    } ?>

    <div class="info">
        <h3><b>Number of items: </b><?= sizeof($data['items']) ?></h3>
        <h3><b>To pay: </b><?= $topay ?>€</h3>
    </div>
    <form class="stub" action="<?= URLROOT ?>/cart/paystub" method="post">

        <?php getCSRFInput(); ?>
        <input type="hidden" name="data" value="<?= htmlspecialchars(json_encode($data['items'])) ?>">
        <label for="name">Name on Card:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="card_number">Card Number:</label><br>
        <input type="text" id="card_number" name="card_number"><br><br>

        <label for="expiry_date">Expiry Date:</label><br>
        <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YYYY"><br><br>

        <label for="cvv">CVV:</label><br>
        <input type="text" id="cvv" name="cvv"><br><br>

        <button type="submit" class="pay">Submit Payment</button>
    </form>
    <section class="text">
        <p>By checking out, you are transferring to each seller the value for the items you want.</p>
        <p>You will soon receive shipping forms of your products from the respective seller. If you don't receive a shipping form, please contact your seller. If they do not answer in a workday, please contact an Admin.</p>
        <p>Our sellers are subject to a careful promotion process for to ensure your best experience. </p>
        <p>Sincerely,</p>
        <p>Your marketplace team</p>
    </section>
    <?php getScript('navbar.js'); ?>
</body>

</html>