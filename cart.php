<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }


        /*----------update products from cart------------*/ 
        if(isset($_POST['update_quantity_btn'])){
            $update_quantity_id = $_POST['update_quantity_id'];
            $update_value = $_POST['update_quantity'];
            
            $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_quantity_id'") or die('query failed');

            if ($update_query) {
                header('Location:cart.php');
            }
        }

        /*----------deleting products from cart------------*/
        if(isset($_GET['delete'])){
            $delete_id = $_GET['delete'];
            mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
            header('Location:cart.php');
            
        }
                                  
        /*----------deleting all products from cart------------*/
        if(isset($_GET['delete_all'])){
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            header('Location:cart.php');
            
        }

?>
<style type="text/css">
    <?php include 'main.css'; ?>
</style>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Deelight</title>
</head>
<body>
    <?php include 'header.php'; ?>
       <div class="banner">
        <h1>my wishlist</h1>
        <p>Best cakes in the hood</p>
       </div> 

    <div class="shop">
        <h1 class="title">products added in cart</h1>
        <?php
        if(isset($message)){
            foreach ($message as $message){
                echo '    <div class="message">
        <span>'.$message.'</span>
<i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
    </div>';
            }
        }
    ?>
    <div class="box-container">
        <?php
        $grand_total = 0;
           $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed'); 
              if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    

        ?>
        <div class="box">
        <div class="icon"> 
            <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x"></a> 
            <a href="view_page.php?pid=<?php echo $fetch_cart['id']; ?>" class="bi bi-eye-fill"></a> 
        </div>
            <img src="images/<?php echo $fetch_cart ['image'];?>">
            <div class="price"><?php echo $fetch_cart ['price'];?></div>
            <div class="name"><?php echo $fetch_cart ['name'];?></div>
            <form method="post">
                <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']?>">
                <div class="qty">
                    <input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity']?>">
                    <input type="submit" name="update_quantity_btn" value="update">
                </div>
            </form>
            <div class="total-amt">
                Total Amount: <span><?php echo $total_amt = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>
            </span>
            </div>

                </div>
        <?php
            $grand_total += $total_amt;
                            }
                        } 
                        else{
                            echo '<img src="images/empty-Photoroom.png" class="empty_image">';
                        }
        ?>

    </div>
    <div class="dlt">
        <a href="cart.php?delete_all" class="btn2" >Delete all</a>
        </div>

    <div class="wishlist_total">

        <p>total amount payable: <span>$<?php echo $grand_total ?>/=</span></p>
        <a href="shop.php" class="btn2"> continue shopping</a>
        <a href="checkout.php" class="btn2 <?php echo ($grand_total>1)? '':'disabled' ?>" onclick="return confirm('do you want to delete all from wishlist')" >proceed to checkout</a>
        
    </div>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>