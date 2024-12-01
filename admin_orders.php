<?php
    include 'connection.php';
    session_start();

    $admin_id = $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }
    /*----------------deleting order details from database----------------------*/ 

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        
        mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'")or die('query failed');

        header('location:admin_orders.php');

    }

    /*----------------update order details from----------------------*/ 
if(isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];

    mysqli_query($conn, "UPDATE `orders` SET payment_status='$update_payment' WHERE id='$order_id'") or die('query failed');
    $message[] = 'Payment status updated successfully';
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    
    
    <!-- font for numbers -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Bebas+Neue&family=Bungee+Spice&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Dosis:wght@200..800&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Oswald:wght@200..700&family=Paytone+One&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Russo+One&family=Saira:ital,wght@0,100..900;1,100..900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <!-- font for dashboard -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Bebas+Neue&family=Bungee+Spice&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Dosis:wght@200..800&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Oswald:wght@200..700&family=Paytone+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Russo+One&family=Saira:ital,wght@0,100..900;1,100..900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

<title>admin panel</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>

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

<section class="order-container">
    <h1 class="title">Total Placed Orders</h1>
    <div class="box-container">
        <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            if(mysqli_num_rows($select_orders) > 0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
        ?>


<div class="box">
    <p>User Name: <span><?php echo $fetch_orders['name']; ?></span></p>
    <p>User ID: <span><?php echo $fetch_orders['user_id']; ?></span></p>
    <p>Placed On: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
    <p>Number: <span><?php echo $fetch_orders['number']; ?></span></p>
    <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
    <p>Total Price: $<span><?php echo $fetch_orders['total_price']; ?></span>/-</p>
    <p>Method: <span><?php echo $fetch_orders['method']; ?></span></p>
    <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
    <p>Total Products: <span><?php echo $fetch_orders['total_products']; ?></span></p>
    <form method="post">
        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
        <select name="update_payment">
            <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
        </select>
        <input type="submit" name="update_order" value="Update Order" class="btn">
        <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete" onclick="return confirm('Delete this order?')">Delete</a>
    </form>
</div>


        <?php
                }
            }
        ?>
    </div>
</section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>