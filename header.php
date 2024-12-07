<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="index.php" class="logo">Deelight <span>cakes</span></a>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="shop.php">products</a>
                <a href="order.php">orders</a>
                <a href="about.php">about us</a>
                <a href="contact.php">contact</a>

            </nav>
            <div class="icons">
                <!--a different logo for user -->
                    <i class="bi bi-person" id="user-btn"></i>
                    <?php
                        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                        $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                    ?>  
                    <a href="wishlist.php"><i class="bi bi-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
                    <?php
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                        $cart_num_rows = mysqli_num_rows($select_cart);
                    ?>
                    <a href="cart.php"><i class="bi bi-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>  
                    <i class="bi bi-list" id="menu-btn"></i>
                    
                    
            </div>
            <div class="user-box">
                <p>username: <span><?php echo $_SESSION['user_name'];?></span></p>
                <p>email: <span><?php echo $_SESSION['user_email'];?></span></p>
                    <form method="post" class="logout">
                        <button name="logout" class="logout-btn">LOG OUT</button>
                    </form>
            </div>
        </div>

    </header>
    
</body>
</html>