<?php 
    session_start();
    
    // Initialize $username variable
    $username = "";

    // Check if the username is set in the session
    if(isset($_SESSION["username"])) {
        // Assign the session username to the $username variable
        $username = $_SESSION["username"];
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Generic Figure</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width = device-width, initial-scale = 1.0">

        <link rel="stylesheet" href="css/style.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha384-***" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <?php include('combine/navigation.php'); ?>

        <section id="home">
            <div class="container">
                    <img src="source/LogoBigv2_transparent.png" style="width: 150px;">
                    <h5 style="font-weight: bold;">Anime Figure Shop</h5>
                    <h1 style="font-weight: bold;">Welcome to <br> <span id="home_name">Generic Figure</span></h1>
                    <p style="font-weight: bold;">Shop figure, Pre-order Figurine, <br> Free shipping to Peninsular Malaysia.<br>
                    "Only what you can't imagine,<br> <span id="home_name">nothing you can't buy."</span> </p>
                    <button id="home_button" style="font-weight: bold;" onclick="directToShopPage()">Shop now</button>
            </div>
        </section>

        <?php include('slideshow.php'); ?>
        <?php include('related_product.php'); ?>
        <?php include('combine\footer.php'); ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script>
            function directToShopPage() {
                // Redirect to the shop-page.php
                window.location.href = "shop-page.php";
            }
        </script>
    </body>
</html>