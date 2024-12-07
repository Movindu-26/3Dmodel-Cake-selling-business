<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }


    /*----------------------send message----------------------------*/ 
    if(isset($_POST['submit-btn'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);                        

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name= '$name' AND email='$email' AND number='$number' AND message='$message'") or die('query failed');

        if(mysqli_num_rows($select_message) > 0){
            echo 'Message already sent';
        }
        else{
            mysqli_query($conn, "INSERT INTO `message`(`user_id`, `name`, `email`, `number`, `message`) VALUES ('$user_id','$name', '$email', '$number', '$message')") or die('query failed');
            echo 'Message sent successfully';
        }
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
        <h1>Contact us</h1>
        <p>Best cakes in the hood</p>
       </div> 

       <div class="help">


        <h1 class="title"> need help?</h1>
        <div class="box-container">
            <div class="box">
                <div>
                    <img src="images/birthday-cake.png">
                    <h2>address</h2>
                </div>
                <p>dafbia adaoifa iaofiaw ljakdwjbkfea oinafbw abuwi</p>
            </div>
            <div class="box">
                <div>
                    <img src="images/open.png">
                    <h2>opening</h2>
                </div>
                <p>dafbia adaoifa iaofiaw ljakdwjbkfea oinafbw abuwi</p>
            </div>
            <div class="box">
                <div>
                    <img src="images/contacts.png">
                    <h2>our contact</h2>
                </div>
                <p>dafbia adaoifa iaofiaw ljakdwjbkfea oinafbw abuwi</p>
            </div>
            <div class="box">
                <div>
                    <img src="images/sale-tag.png">
                    <h2>special offers</h2>
                </div>
                <p>dafbia adaoifa iaofiaw ljakdwjbkfea oinafbw abuwi</p>
            </div>
        </div>
       </div>


       <div class="form-container">
    <div class="form-section">
        <form method="post">
            <h1>Send us your question!</h1>
            <p>We'll get back to you as soon as possible.</p>
            <div class="input-field">
                <label>Your Name</label>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label>Your Email</label>
                <input type="text" name="email">
            </div>
            <div class="input-field">
                <label>Your Number</label>
                <input type="number" name="number">
            </div>
            <div class="input-field">
                <label>message</label>
                <textarea name="message"></textarea>
            </div>
            <input type="submit" name="submit-btn" class="btn" value="send message">
        </form>
    </div>
</div>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html














