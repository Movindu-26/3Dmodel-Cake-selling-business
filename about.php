<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
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
        <h1>about us</h1>
        <p>Best cakes in the hood</p>
       </div> 


       <div class="about">
    <div class="row">
        <div class="detail">
            <h1>visit our beautiful showroom</h1>
            <p>Our showroom is an expression of what we love doing; being creative with cake </p>
            <a href="shop.php" class="btn2">shop</a>
        </div>
        <div class="img-box">
            <img src="images/Gemini_Generated_Image_wm27yjwm27yjwm27.jpg">
        </div>
    </div>
</div>

<div class="services">
    <h1 class="title">our services</h1>
    <div class="box-container">
        <div class="box">
            <i class="bi bi-truck"></i>
            <h3>FAST SHIPPING</h3>
            <p>will deliver fast</p>
        </div>
        <div class="box">
            <i class="bi bi-cake2"></i>
            <h3>FRESHEST CAKES</h3>
            <p>Exclusive fresh cakes with our Happiness Guarantee</p>
        </div>
        <div class="box">
            <i class="bi bi-pencil-square"></i>
            <h3>Fully Customizable Cakes</h3>
            <p>Create your perfect cake! Choose the flavor, design, to match your occasion.</p>
    </div>
</div>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html














