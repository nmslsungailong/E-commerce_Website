<?php 
    if(session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    
    // Initialize $username variable
    $username = "";

    // Check if the username is set in the session
    if(isset($_SESSION["username"])) {
        // Assign the session username to the $username variable
        $username = $_SESSION["username"];
    }
?>

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

<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-light py-2 fixed-top ">
  <div class="container">
    <a class="navbar-brand" href="homepage.php">
        <img src="source/logo2.png" alt="Logo" style="width: 150px;">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span><i class="fa-solid fa-bars bar"></i></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="homepage.php">
                Home
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">Ready Stock</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="category_page.php?category=Nendoroid">Nendoroid</a></li>
                <li><a class="dropdown-item" href="category_page.php?category=1/7th Scale">1/7th Scale</a></li>
                <li><a class="dropdown-item" href="category_page.php?category=1/4th Scale">1/4th Scale</a></li>
                <li><a class="dropdown-item" href="category_page.php?category=figma">Figma</a></li>
                <li><a class="dropdown-item" href="category_page.php?category=Plastic Models">Plastic Models</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="FAQ.php">
                FAQ
            </a>
        </li>

        <?php if(isset($_SESSION["username"])): ?>
          <!-- Display username and logout link if user is logged in -->
          <li class="nav-item">
              <a class="nav-link" href="#"> HI, <?= $username ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">
                LogOut
              </a>
            </li>
          
        <?php else: ?>
          <!-- Display login link if user is not logged in -->
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        <?php endif; ?>
        
        <li class="nav-item">
          <a href="cart.php">
            <i class="fa-solid fa-cart-shopping"></i>
          </a>
        </li>       
      </ul>
    </div>
  </div>
</nav>