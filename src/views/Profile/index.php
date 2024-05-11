<?php 
    require_once APPROOT . '/src/views/Common/common.php'; 
    getHead(array('/css/style.css', '/css/navbar.css', '/css/profile.css'), "Profile"); 
    getNavbar();
?>

<?php session_start(); ?>

<?php if (!isLoggedIn()) {
    // Redirecionar para a página de login, por exemplo:
    header("Location: login.php");
    exit;
} 

$user = $_SESSION['user'];


?>

<body class="forms">
    <section>
    <h1>Your profile</h1>
    
    <form class="current-info">
        <h2> Current info: </h2>
        <p>Username: <?php echo $user['username']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Full name: <?php echo $user['full_name']; ?></p>
        <p>Date: <?php echo $user['created_at']; ?></p>
    </form>

    <div class="edit-profile">

    <h2>Edit Profile:</h2>
    <h2>Change Password</h2>

   

    <form class = "email" action="<?= URLROOT; ?>/auth/changeemail" method="post">
        <label for="email">New email: </label>
        <br>
        <input type="text" name="email" id="email">
    <button class="button-submit" type="submit">Submit</button>
</form>
    
    <form class = "username" action="<?= URLROOT; ?>/auth/changeusername" method="post">
        <label for="username">New username: </label>
        <br>
        <input type="text" name="username" id="username">
    <button class="button-submit" type="submit">Submit</button>
    
</form>

    <form class = "fullname" action="<?= URLROOT; ?>/auth/changefullname" method="post">
        <label for="username">New full name: </label>
        <br>
        <input type="text" name="fullname" id="fullname">
    <button class="button-submit" type="submit">Submit</button>
    </form>
</form>
</form>

    
    <form class = "password" action="<?= URLROOT; ?>/auth/changepassword" method="post">
        <label for="current_password">Current password: </label>
        <input type="password" name="current_password" id="current_password">

        <label for="new_password">New password: </label>
        <input type="password" name="new_password" id="new_password">

        <label for="confirm_password">Confirm password: </label>
        <input type="password" name="confirm_password" id="confirm_password">
    <button class="button" type="submit">Submit</button>
    </form>



</div>






<h2> Shipping Forms: </h2>
<?php foreach ($data["transactions"] as $transaction) : ?>
    <?php if ($transaction->seller_id == $user['id']) { ?>
            <h3>Seller name: <?php echo $user->name; ?></h3>
            <?php } ?>

            <?php foreach ($data["items"] as $item) : ?>
              <?php  if ($transaction->product_id == $item->id) { ?>
            <h3>Item: <?php echo $item->model; ?> : <?php echo $item->brand; ?></h3>
            <?php } ?>
            <?php foreach ($data["users"] as $buyer) : ?>
              <?php  if ($buyer->id == $transaction->buyer_id) { ?>
            <h3>Buyer name: <?php echo $buyer->name; ?> : <?php echo $buyer->id; ?></h3>
            <?php } ?>

            <?php endforeach; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>





    <h2> Your products: </h2>

    <div class="item-wrapper">
    <?php foreach ($data["items"] as $item) : ?>


        <div class="item-container">
        <div class="item-image">
        <img id="item-image" src="<?= $item->image_urls[0] ?>" alt="Item image">
        <button id="previous-button">&#10094;</button>
        <button id="next-button" >&#10095;</button>

    </div>
    <div class="edit-product">
        <?php if ($item->seller_id == $user['id']) { ?>
            <h3><?php echo $item->brand; ?> : <?php echo $item->model; ?></h3>
            <br>


        <form  action="<?= URLROOT ?>/item/updateitem" method="post">

            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" value="<?php echo $item->brand; ?>">

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?php echo $item->model; ?>" >

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $item->price; ?>" >

            <input type="hidden" name="item_id" value="<?php echo $item->id; ?>">

            <h4 class="h">Product Category: </h4>

            <?php foreach ($data["categories"] as $category) : ?>
                <?php if ($category->id == $item->category_id) : ?>
                    <p class="pp"><?php echo $category->name; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
<br>
            
            <label for="category">Change Category</label>
            <select name="category" id="category">
                <?php foreach ($data["categories"] as $category) : ?>
                    <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                <?php endforeach; ?>
            </select>

            <h4 class="h">Product Size: </h4>

            <?php foreach ($data["sizes"] as $size) : ?>
                <?php if ($size->id == $item->size_id) : ?>
                    <p class="pp"><?php echo $size->name; ?></p>
                <?php endif; ?>
            <?php endforeach; ?> 
            <br>           

            <label for="size">Change Size</label>
            <select name="size" id="size">
                <?php foreach ($data["sizes"] as $size) : ?>
                    <option value="<?= $size->id; ?>"><?= $size->name; ?></option>
                <?php endforeach; ?>
            </select>

            <h4 class="h">Product Condition: </h4>

            <?php foreach ($data["conditions"] as $condition) : ?>
                <?php if ($condition->id == $item->condition_id) : ?>
                    <p class="pp"><?php echo $condition->name; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
            <br>

            <label for="condition">Change Condition</label>
            <select name="condition" id="condition">
                <?php foreach ($data["conditions"] as $condition) : ?>
                    <option value="<?= $condition->id; ?>"><?= $condition->name; ?></option>
                <?php endforeach; ?>
            </select>
            
            

            <!-- Adicione campos para quaisquer outros campos que você deseja atualizar -->
            
            <button class="button" type="submit">Update Item</button>

            <form class="buttondelete" action="<?= URLROOT; ?>/item/<?= $item->id; ?>/deleteuseritem" method="post">
    <input type="submit" value="Delete">
</form>
                </div>
                
                </form>
        </form>
        
        </form>
                </div>


        <?php } ?>
        <?php endforeach; ?>
    

    
    


</section>





</body>



<?php
getScript('navbar.js');
?>