<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/profile.css'), "Profile");
session_start();
$user = $_SESSION['user'];
?>

<body class="forms">
    <?php getNavbar(); ?>
    <section>
        <h1>Your profile</h1>

        <div class="current-info">
            <h2> Current info: </h2>
            <p>Username: <?= $user['username']; ?></p>
            <p>Email: <?= $user['email']; ?></p>
            <p>Full name: <?= $user['full_name']; ?></p>
            <p>Date: <?= $user['created_at']; ?></p>
            <p> Status: 
            <?php if (isAdmin()) : ?>
                        Admin
                <?php elseif (isSeller()) : ?>
                        Seller
                    <?php elseif (hasRequested()) : ?>
                        Request to be Seller Sent

                    <?php else : ?>
            
                            <form class="highlight" action="<?= URLROOT ?>/auth/request" method="post">
                                <?php getCSRFInput(); ?>
                                <button type="submit" class="requestButton">Request Seller Privileges</button>
                            </form>
        
                    <?php endif; ?>
                    </p>
        </div>

        <div class="edit-profile">

            <h2>Edit Profile:</h2>
            <h2>Change Password</h2>


            <form class="email" action="<?= URLROOT; ?>/auth/changeemail" method="post">
                <?php getCSRFInput(); ?>
                <label for="email">New email: </label>
                <br>
                <input type="text" name="email" id="email">
                <button class="button-submit" type="submit">Submit</button>
            </form>

            <form class="username" action="<?= URLROOT; ?>/auth/changeusername" method="post">
                <?php getCSRFInput(); ?>
                <label for="username">New username: </label>
                <br>
                <input type="text" name="username" id="username">
                <button class="button-submit" type="submit">Submit</button>
            </form>

            <form class="fullname" action="<?= URLROOT; ?>/auth/changefullname" method="post">
                <?php getCSRFInput(); ?>
                <label for="username">New full name: </label>
                <br>
                <input type="text" name="fullname" id="fullname">
                <button class="button-submit" type="submit">Submit</button>
            </form>


            <form class="password" action="<?= URLROOT; ?>/auth/changepassword" method="post">
                <?php getCSRFInput(); ?>
                <label for="current_password">Current password: </label>
                <input type="password" name="current_password" id="current_password">

                <label for="new_password">New password: </label>
                <input type="password" name="new_password" id="new_password">

                <label for="confirm_password">Confirm password: </label>
                <input type="password" name="confirm_password" id="confirm_password">

                <button class="button" type="submit">Submit</button>
            </form>
        </div>

        <div class="preferences">
            <h3>Your Preferences</h3>
            <?php $hasCategory = false; ?>
            <?php foreach ($data["categories"] as $category) :
                if ($category->id == $user['category_id']) :
                    $hasCategory = true; ?>
                    <p>Category: <?= $category->name ?? "None"; ?></p>
                <?php endif;
            endforeach;
            if (!$hasCategory) :
                $condition = true; ?>
                <p>Category: None</p>
                <?php endif;
            $hasSize = false;
            foreach ($data["sizes"] as $size) :
                if ($size->id == $user['size_id']) :
                    $hasSize = true; ?>
                    <p>Size: <?= $size->name ?? "None"; ?></p>
                <?php endif;
            endforeach;
            if (!$hasSize) :
                $condition = true; ?>
                <p>Size: None</p>
                <?php endif;
            $hasCondition = false;
            foreach ($data["conditions"] as $condition) :
                if ($condition->id == $user['condition_id']) :
                    $hasCondition = true; ?>
                    <p>Condition: <?= $condition->name ?></p>
                <?php endif;
            endforeach;
            if (!$hasCondition) :
                $condition = true; ?>
                <p>Condition: None</p>
            <?php endif; ?>

            <br>
            <h3>Change Your Preferences</h3>
            <form action="<?= URLROOT ?>/auth/changepreferences" method="post">
                <?php getCSRFInput(); ?>
                <label for="category">Change Category</label>
                <select name="category" id="category">
                    <option value=<?php NULL ?>>All Categories</option>
                    <?php foreach ($data["categories"] as $category) : ?>
                        <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="size">Change Size</label>
                <select name="size" id="size">
                    <option value=<?php NULL ?>>All Sizes</option>
                    <?php foreach ($data["sizes"] as $size) : ?>
                        <option value="<?= $size->id; ?>"><?= $size->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="condition">Change Condition</label>
                <select name="condition" id="condition">
                    <option value=<?php NULL ?>>All Conditions</option>
                    <?php foreach ($data["conditions"] as $condition) : ?>
                        <option value="<?= $condition->id; ?>"><?= $condition->name; ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="button" type="submit">Set preferences</button>
            </form>
        </div>


        <?php $hasItems = false ?>

        <h2> Your products: </h2>
        <div class="item-wrapper">
            <?php foreach ($data["items"] as $item) :
                if ($item->seller_id == $user['id'] && $item->sold_at === NULL) :
                    $hasItems = true ?>
                    <div class="item-container">
                        <div class="size-image">
                        <div class="item-image" data-item-id="<?= $item->id ?>">
                            <?php foreach ($item->image_urls as $key => $image_url) : ?>
                                <img class="item-image" src="<?= $image_url ?>" alt="Item image" style="<?= $key > 0 ? 'display: none;' : '' ?>">
                            <?php endforeach; ?>
                            <button class="previous-button">&#10094;</button>
                            <button class="next-button">&#10095;</button>
                        </div>
                        </div>
                        <div class="edit-product">
                            <h3><?= $item->brand; ?> : <?= $item->model; ?></h3>
                            <br>
                            <form class ="item-info" action="<?= URLROOT ?>/item/updateitem" method="post">
                                <?php getCSRFInput(); ?>
                                <div class="brand">
                                <label for="brand">Brand:</label>
                                <input type="text" id="brand" name="brand" value="<?= $item->brand; ?>">
                                
                               <br>
                                <label for="model">Model:</label>
                                <input type="text" id="model" name="model" value="<?= $item->model; ?>">
                                <br>
                                <label for="price">Price:</label>
                                <input type="text" id="price" name="price" value="<?= $item->price; ?>">
                                <br>    
                                </div>
                                <input type="hidden" name="item_id" value="<?= $item->id; ?>">
                               

                                <div>
                                <h4 class="h">Product Category: </h4>

                                <?php foreach ($data["categories"] as $category) : ?>
                                    <?php if ($category->id == $item->category_id) : ?>
                                        <p class="pp"><?= $category->name; ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <br>
                                
                                <label for="category">Change Category</label>
                                <select name="category" id="category">
                                    <?php foreach ($data["categories"] as $category) : ?>
                                        <option value="<?= $category->id; ?>"><?= $category->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>

                                <div>
                                <h4 class="h">Product Size: </h4>

                                <?php foreach ($data["sizes"] as $size) : ?>
                                    <?php if ($size->id == $item->size_id) : ?>
                                        <p class="pp"><?= $size->name; ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <br>
                                
                                <label for="size">Change Size</label>
                                <select name="size" id="size">
                                    <?php foreach ($data["sizes"] as $size) : ?>
                                        <option value="<?= $size->id; ?>"><?= $size->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                <div>
                                <h4 class="h">Product Condition: </h4>

                                <?php foreach ($data["conditions"] as $condition) : ?>
                                    <?php if ($condition->id == $item->condition_id) : ?>
                                        <p class="pp"><?= $condition->name; ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <br>
                               
                                <label for="condition">Change Condition</label>
                                <select name="condition" id="condition">
                                    <?php foreach ($data["conditions"] as $condition) : ?>
                                        <option value="<?= $condition->id; ?>"><?= $condition->name; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                </div>
                                <button class="button" type="submit">Update Item</button>
                                
                            </form>

                            <form class="button-delete" action="<?= URLROOT; ?>/item/<?= $item->id ?>/deleteuseritem" method="post">
                                <?php getCSRFInput(); ?>
                                <input type="submit" value="Delete Item">
                            </form>
                        </div>
                    </div>
            <?php endif;
            endforeach; ?>
        </div>
        <?php if (!$hasItems) { ?>
            <h4> No items for sale </h4>
        <?php } ?>

        <br>
        <h2>Shipping Forms:</h2>
        <br>
        <div class="item-wrapper">
        <h3>Sold Products:</h3>
        <h3>Bought Products:</h3>
        </div>
        <div class="item-wrapper">
            
                <?php $soldItems = false; ?>

                <div class="sold-products">
                    
                    <?php foreach ($data["transactions"] as $transaction) :
                        if ($transaction->seller_id == $user['id']) : ?>
                            <div class="product-box">
                                <?php foreach ($data["items"] as $item) :
                                    if ($transaction->product_id == $item->id) :
                                        $soldItems = true; ?>
                                        <h3> <?= $item->model; ?> <?= $item->brand; ?></h3>
                                        <div class="item-container">
                                            <div class="item-image">
                                                <img id="item-image" src="<?= $item->image_urls[0] ?>" alt="Item image">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="item-info">
                                            <h4>Price: <?= $item->price; ?>€</h4>
                                            <br>
                                            <h5>Sold at <?= $item->sold_at; ?></h5>

                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <div class="buyer-seller-info">
                                    <div class="buyer-info">
                                        <h5>by <?= $user['full_name']; ?></h5>
                                    </div>
                                    <?php foreach ($data["users"] as $buyer) :
                                        if ($buyer->id == $transaction->buyer_id) : ?>
                                            <h5 class="seller-info">to <?= $buyer->full_name; ?> </h5>
                                    <?php endif;
                                    endforeach; ?>
                                </div>

                            </div>
                    <?php endif;
                    endforeach; ?>
            
                <?php if ($soldItems == false) : ?>
                    <h4>No items sold yet</h4>
                <?php endif; ?>
                </div>
           
            
            
                <?php $boughtItems = false; ?>
                <div class="products-bought">
                    

                    <?php foreach ($data["transactions"] as $transaction) :
                        if ($transaction->buyer_id == $user['id']) :
                            $boughtItems = true; ?>
                            <div class="product-box">
                                <?php foreach ($data["items"] as $item) :
                                    if ($transaction->product_id == $item->id) : ?>
                                        <h3> <?= $item->model; ?> <?= $item->brand; ?></h3>
                                        <div class="item-container">
                                            <div class="item-image">
                                                <img id="item-image" src="<?= $item->image_urls[0] ?>" alt="Item image">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="item-info">
                                            <h4>Price: <?= $item->price; ?>€</h4>
                                            <br>
                                            <h5>Sold at <?= $item->sold_at; ?></h5>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div class="buyer-seller-info">
                                    <div class="buyer-info">
                                        <h5>to <?= $user['full_name']; ?></h5>
                                    </div>
                                    <?php foreach ($data["users"] as $seller) : ?>
                                        <?php if ($seller->id == $transaction->seller_id) : ?>
                                            <div class="seller-info">
                                                <h5>by <?= $seller->full_name; ?> </h5>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                
                <?php if (!$boughtItems) : ?>
                    <h4>No items bought yet</h4>
                <?php endif; ?>
                </div>

            
        </div>

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const previousButtons = document.querySelectorAll('.previous-button');
            const nextButtons = document.querySelectorAll('.next-button');

            previousButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemImageContainer = this.parentElement;
                    const itemImages = itemImageContainer.querySelectorAll('.item-image img');
                    let currentIndex = Array.from(itemImages).findIndex(img => img.style.display !== 'none');
                    currentIndex = (currentIndex - 1 + itemImages.length) % itemImages.length;
                    itemImages.forEach((img, index) => {
                        img.style.display = index === currentIndex ? 'block' : 'none';
                    });
                });
            });

            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemImageContainer = this.parentElement;
                    const itemImages = itemImageContainer.querySelectorAll('.item-image img');
                    let currentIndex = Array.from(itemImages).findIndex(img => img.style.display !== 'none');
                    currentIndex = (currentIndex + 1) % itemImages.length;
                    itemImages.forEach((img, index) => {
                        img.style.display = index === currentIndex ? 'block' : 'none';
                    });
                });
            });
        });
    </script>
    <?php getScript('navbar.js'); ?>
</body>
<html>