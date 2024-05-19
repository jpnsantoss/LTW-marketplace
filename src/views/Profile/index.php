<?php
require_once APPROOT . '/src/views/Common/common.php';
getHead(array('/css/style.css', '/css/navbar.css', '/css/profile.css'), "Profile");
getNavbar();
$user = $_SESSION['user'];
?>

<body class="forms">
    <?php getNavbar(); ?>
    <section>
        <h1>Your profile</h1>

        <div class="current-info">
            <h2> Current info: </h2>
            <p>Username: <?php echo $user['username']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Full name: <?php echo $user['full_name']; ?></p>
            <p>Date: <?php echo $user['category_name']; ?></p>
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
            </form>
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
            <?php foreach ($data["categories"] as $category) : ?>
                <?php if ($category->id == $user['category_id']) : ?>
                    <?php $hasCategory = true; ?>
                    <p>Category: <?= $category->name ?? "None"; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$hasCategory) : ?>
                <?php $condition = true; ?>
                <p>Category: None</p>
            <?php endif; ?>
            <?php $hasSize = false; ?>
            <?php foreach ($data["sizes"] as $size) : ?>
                <?php if ($size->id == $user['size_id']) :
                    $hasSize = true; ?>
                    <p>Size: <?= $size->name ?? "None"; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$hasSize) : ?>
                <?php $condition = true; ?>
                <p>Size: None</p>
            <?php endif; ?>
            <?php $hasCondition = false; ?>
            <?php foreach ($data["conditions"] as $condition) : ?>
                <?php if ($condition->id == $user['condition_id']) : ?>
                    <?php $hasCondition = true; ?>
                    <p>Condition: <?= $condition->name ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$hasCondition) : ?>
                <?php $condition = true; ?>
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

            </form>
        </div>


        <?php $hasItems = false ?>

        <h2> Your products: </h2>

        <div class="item-wrapper">
        <?php foreach ($data["items"] as $item) : 
                 if ($item->seller_id == $user['id'] && $item->sold_at === NULL): 
                    $hasItems = true ?>  
        <div class="item-container">
            <div class="item-image" data-item-id="<?= $item->id ?>">
                <?php foreach ($item->image_urls as $key => $image_url) : ?>
                    <img class="item-image" src="<?= $image_url ?>" alt="Item image" style="<?= $key > 0 ? 'display: none;' : '' ?>">
                <?php endforeach; ?>
                <button class="previous-button">&#10094;</button>
                <button class="next-button">&#10095;</button>
            </div>
            <div class="edit-product">
                <h3><?= $item->brand; ?> : <?= $item->model; ?></h3>
                <br>
                <form  action="<?= URLROOT ?>/item/updateitem" method="post">
                    <?php getCSRFInput(); ?>

                    <label for="brand">Brand:</label>
                    <input type="text" id="brand" name="brand" value="<?= $item->brand; ?>">


                                        <label for="model">Model:</label>
                                        <input type="text" id="model" name="model" value="<?= $item->model; ?>">

                                        <label for="price">Price:</label>
                                        <input type="text" id="price" name="price" value="<?= $item->price; ?>">

                                        <input type="hidden" name="item_id" value="<?= $item->id; ?>">

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
                    <h4 class="h">Product Condition: </h4>

                                <?php foreach ($data["conditions"] as $condition) : ?>
                                    <?php if ($condition->id == $item->condition_id) : ?>
                                        <p class="pp"><?php echo $condition->name; ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <br>
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



                                <!-- Adicione campos para quaisquer outros campos que você deseja atualizar -->

                                <button class="button" type="submit">Update Item</button>
                            </form>
                    <label for="condition">Change Condition</label>
                    <select name="condition" id="condition">
                        <?php foreach ($data["conditions"] as $condition) : ?>
                            <option value="<?= $condition->id; ?>"><?= $condition->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button class="button" type="submit">Update Item</button>
                </form>

                            <form class="button-delete" action="<?= URLROOT; ?>/item/<?= $item->id ?>/deleteuseritem" method="post">
                                <?php getCSRFInput(); ?>
                                <input type="submit" value="Delete">
                            </form>
                        </div>

                        </form>
                        </form>

                        </form>
                    </div>


                <?php } ?>

            <?php endforeach; ?>
        </div>

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


        <?php if (!$hasItems) : ?>
            <h4>No items for sale</h4>
        <?php endif; ?>


        <h2>Shipping Forms:</h2>
        <br>
        <div class="item-wrapper">

            <?php $soldItems = false ?>
            <div class="sold-products">
                <h3>Sold Products:</h3>

                <?php foreach ($data["transactions"] as $transaction) : ?>
                    <?php if ($transaction->seller_id == $user['id']) : ?>
                        <div class="product-box">
                            <?php foreach ($data["items"] as $item) : ?>
                                <?php if ($transaction->product_id == $item->id) : ?>
                                    <?php $soldItems = true ?>
                                    <h3> <?php echo $item->model; ?>
                                        <?php echo $item->brand; ?></h3>
                                    <div class="item-container">
                                        <div class="item-image">
                                            <img id="item-image" src="<?= $item->image_urls[0] ?>" alt="Item image">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="item-info">
                                        <h4>
                                            Price: <?php echo $item->price; ?>€</h4>
                                        <br>
                                        <h5>
                                            Sold at <?php echo $item->sold_at; ?></h5>

                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <div class="buyer-seller-info">
                                <div class="buyer-info">
                                    <h5>by <?php echo $user['full_name']; ?></h5>
                                </div>

                                <?php foreach ($data["users"] as $buyer) : ?>
                                    <?php if ($buyer->id == $transaction->buyer_id) : ?>
                                        <div class="seller-info">
                                            <h5>to <?php echo $buyer->full_name; ?> </h5>
                                        </div>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (!$soldItems) : ?>
                    <h4>No items sold yet</h4>
                <?php endif; ?>
            </div>


            <?php $boughtItems = false ?>
            <div class="products-bought">
                <h3>Products Bought:</h3>

                <?php foreach ($data["transactions"] as $transaction) : ?>
                    <?php if ($transaction->buyer_id == $user['id']) : ?>
                        <?php $boughtItems = true ?>
                        <div class="product-box">
                            <?php foreach ($data["items"] as $item) : ?>
                                <?php if ($transaction->product_id == $item->id) : ?>
                                    <h3> <?php echo $item->model; ?>
                                        <?php echo $item->brand; ?></h3>
                                    <div class="item-container">
                                        <div class="item-image">
                                            <img id="item-image" src="<?= $item->image_urls[0] ?>" alt="Item image">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="item-info">
                                        <h4>
                                            Price: <?php echo $item->price; ?>€</h4>
                                        <br>
                                        <h5>
                                            Sold at <?php echo $item->sold_at; ?></h5>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <div class="buyer-seller-info">
                                <div class="buyer-info">
                                    <h5>to <?php echo $user['full_name']; ?></h5>
                                </div>

                                <?php foreach ($data["users"] as $seller) : ?>
                                    <?php if ($seller->id == $transaction->seller_id) : ?>
                                        <div class="seller-info">
                                            <h5>by <?php echo $seller->full_name; ?> </h5>
                                        </div>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>


    </section>





</body>
<html>