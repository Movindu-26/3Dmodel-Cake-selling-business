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
    <section class="dashboard">
        <h1 class="title">dashboard</h1>
        <div class="box-container">
            <div class="box">
                <?php 
                    $total_pendings = 0;
                    $select_pendings =  mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending' ") or die('query failed');
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pendings)){
                        $total_pendings += $fetch_pendings['total_price'];
                    }
                ?>
                <h3>LKR <?php echo $total_pendings; ?></h3>
                <p>total pendings</p>
            </div>

            <div class="box">
                <?php 
                    $total_completed = 0;
                    $select_completed =  mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed' ") or die('query failed');
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)){
                        $total_completed += $fetch_completed['total_price'];
                    }
                ?>
                <h3>LKR <?php echo $total_completed; ?></h3>
                <p>total completed</p>
            </div>

            <div class="box">
                <?php 
                    $select_orders =  mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    $num_of_orders = mysqli_num_rows($select_orders);

                ?>
                <h3><?php echo $num_of_orders; ?></h3>
                <p>order placed</p>
            </div>

            <div class="box">
                <?php 
                    $select_products =  mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                    $num_of_products = mysqli_num_rows($select_products);

                ?>
                <h3><?php echo $num_of_products; ?></h3>
                <p>products added</p>
            </div>

            <div class="box">
                <?php 
                    $select_users =  mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                    $num_of_users = mysqli_num_rows($select_users);

                ?>
                <h3><?php echo $num_of_users; ?></h3>
                <p>Registered users</p>
            </div>

            <div class="box">
                <?php 
                    $select_admins =  mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                    $num_of_admins = mysqli_num_rows($select_admins);

                ?>
                <h3><?php echo $num_of_admins; ?></h3>
                <p>Total admins</p>
            </div>

            <div class="box">
                <?php 
                    $select_totaluser =  mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                    $num_of_totaluser = mysqli_num_rows($select_totaluser);

                ?>
                <h3><?php echo $num_of_totaluser; ?></h3>
                <p>Total users</p>
            </div>

            
            <div class="box">
                <?php 
                    $select_message =  mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                    $num_of_message = mysqli_num_rows($select_message);

                ?>
                <h3><?php echo $num_of_message; ?></h3>
                <p>New messages</p>
            </div>
            


        </div>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>