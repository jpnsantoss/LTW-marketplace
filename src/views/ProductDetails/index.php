<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', '/css/navbar.css'), "Product Details"); 
    getNavbar();
?>

<body>
<p> ProductDetails </p>
<div>
<pre>
        <?php echo var_dump($data["item"]); ?>
    </pre>
        
        <p>Preço: <?= $data["item"]->price ?></p>

        <!-- Exibir imagens do item -->
        <h3>Imagens do Item</h3>
       
    </div>
</body>