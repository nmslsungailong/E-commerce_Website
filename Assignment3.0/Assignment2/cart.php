<?php
    include('combine/database.php');

    // Attempt to establish a connection to the database
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch cart items from the database
    $query = "SELECT * FROM cart";
    $result = mysqli_query($conn, $query);

    // Check if the query executed successfully
    if (!$result) {
        die("Error executing the query: " . mysqli_error($conn));
    }

    // Initialize an empty array to store cart items
    $cart_items = [];

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Fetch each row from the result set and store it in the $cart_items array
        while ($row = mysqli_fetch_assoc($result)) {
            $cart_items[] = $row;
        }
    }
?>

<head>
        <title>Generic Figure</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width = device-width, initial-scale = 1.0">

        <style>
            #cart-container {
                overflow-x: auto;
            }

            #table {
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: none;
                padding: 8px;
            }

            #table img {
                max-width: 100px;
                height: auto;
            }

            /* Adjust the width of the product column */
            #table .product-column {
                min-width: 450px; /* Set your desired width here */
            }

            #total{
                text-align: right;
            }

            #total button{
                font-size: 0.8rem;
                font-weight: 700;
                outline: none;
                border-radius: 20px;
                background-color: red;
                color: white;
                padding: 13px 30px;
                cursor: pointer;
                text-transform: uppercase;
                transition: 0.3 ease;
            }

            #total button:hover{
                background-color: white;
                color: red;
                transition: 0.3 ease;
            }
            
        </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha384-***" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php include('combine/navigation.php');?>

<section id="cart-home" class="pt-5 mt-5 container">
    <h2 class="font-weigth-bold pt-5">Shopping Cart</h2>
    <hr>
</section>

<section id="cart-container" class="container my-5">
    <?php if (!empty($cart_items)) { ?>
        <div id="cart-container" class="text-center" style="align-items: center;">
            <table id="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Product Name</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            $subtotal = 0; // Initialize subtotal variable
                            foreach ($cart_items as $item) {
                                // Remove non-numeric characters from the price string
                                $price_numeric = preg_replace('/[^0-9]/', '', $item['price']);

                                // Convert the cleaned price string to an integer
                                $price_int = intval($price_numeric);

                                $subtotal += $price_int * intval($item['quantity']); // Increment subtotal

                        ?>
                                <tr>
                                    <td><img src="<?php echo htmlspecialchars(substr($item['image1'], 1)); ?>" alt=""></td>
                                    <td class="product-column"><?php echo htmlspecialchars($item['product_name']); ?></td>
                                    <td style="min-width: 150px; width: 150px;">
                                        <?php echo htmlspecialchars($item['price']); ?>
                                        <!-- Form for deleting item -->
                                        <form method="post" action="delete_from_cart.php">
                                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['id']); ?>">
                                            <button type="submit" class="delete-item-btn">
                                                <i class="fas fa-trash-alt"></i>
                                            </button> 
                                        </form>
                                        </td>
                                    <td style="min-width: 150px; width: 150px;"><?php echo $price_int * intval($item['quantity']); ?></td>
                                </tr>
                        <?php
                            }
                        ?>
                </tbody>
            </table>
        </div>
    <?php } else { $subtotal = 0; // Initialize subtotal variable?>
        <p>Your cart is empty.</p>
        
    <?php } ?>
</section>

<section id="total" class="container my-5">
    <h4>Subtotal <span id="total-price" style="color: crimson ;">¥<?php echo $subtotal; ?></span></h4>
    <h6>Shipping, taxes, and discount will be calculated at checkout</h6>
    <button id="checkoutButton">Checkout</button>
</section>

<?php include('combine\footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>
document.getElementById('checkoutButton').addEventListener('click', function() {
    var subtotal = <?php echo $subtotal; ?>;

    // Check if subtotal is greater than 0
    if (subtotal > 0) {
        window.location.href = 'payment_page.php?subtotal=' + encodeURIComponent(subtotal);
    } else {
        // Alert the user or handle the scenario as needed
        alert("Your cart is empty. Please add items to your cart before checking out.");
    }
});
</script>
