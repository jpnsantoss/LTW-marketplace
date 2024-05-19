# LTW MarketPlace

## Group ltw05g05

- João Santos (up202205794) 33%
- Marta Silva (up202208258) 33%
- Sara Cortez (up202205636) 33%

## Install Instructions

(adapt this)

    git clone git@github.com:FEUP-LTW-2024/ltw-project-2024-ltw05g05.git
    git checkout final-delivery-v1
    touch data/marketplace.db
    sqlite3 data/marketplace.db < schema.sql
    sqlite3 data/marketplace.db < seed.sql
    php make serve

## External Libraries

- We have used composer auto-load.

## Screenshots


![alt text](image-1.png)

![alt text](image-2.png)

![alt text](image.png)


## Implemented Features

**General**:

- [X] Register a new account.
- [X] Log in and out.
- [X] Edit their profile, including their name, username, password, and email.

**Sellers**  should be able to:

- [X] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [X] Track and manage their listed items.
- [X] Respond to inquiries from buyers regarding their items and add further information if needed.
- [X] Print shipping forms for items that have been sold.

**Buyers**  should be able to:

- [X] Browse items using filters like category, price, and condition.
- [X] Engage with sellers to ask questions or negotiate prices.
- [X] Add items to a wishlist or shopping cart.
- [X] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**  should be able to:

- [X] Elevate a user to admin status.
- [X] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [X] Oversee and ensure the smooth operation of the entire system.

**Security**:
We have been careful with the following security aspects:

- [X] **SQL injection**
- [X] **Cross-Site Scripting (XSS)**
- [X] **Cross-Site Request Forgery (CSRF)**

**Password Storage Mechanism**: hash_password&verify_password

**Aditional Requirements**:

We also implemented the following additional requirements:

- [ ] **Rating and Review System**
- [ ] **Promotional Features**
- [ ] **Analytics Dashboard**
- [ ] **Multi-Currency Support**
- [ ] **Item Swapping**
- [X] **API Integration**
- [ ] **Dynamic Promotions**
- [X] **User Preferences**
- [ ] **Shipping Costs**
- [X] **Real-Time Messaging System**
