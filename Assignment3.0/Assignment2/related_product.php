<?php
    include('combine/database.php');

    // Perform SQL query to fetch 4 random rows
    $result = mysqli_query($conn, "SELECT * FROM figures ORDER BY RAND() LIMIT 4");

    // Check for errors
    if (!$result) {
        echo "Error: " . mysqli_error($conn);
        exit;
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

<section class="featured my-5 pb-5">
        <div id="container text-center mt-5 py-5" style="text-align: center;">
            <h3 style="color: crimson; font-weight: bold;">Our Product</h3>
            <hr class="mx-auto">
            <p>Let's check out our products</p>
        </div>

        <div class="row mx-auto container-fluid product-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="product text-center text-center mt-5 py-5 col-lg-3 col-md-4 col-12">
                <div onclick="window.location.href='item_detail.php?product_name=<?php echo urlencode($row['product_name']); ?>'" class="image-container" style="height: 300px; display: flex; justify-content: center; align-items: center; transition: 0.3s all;">
                    <img class="img-fluid mb-3" src="<?php echo htmlspecialchars($row['image1']); ?>" loading="lazy" alt="Product">
                </div>
                <div class="product-details">
                    <h5 class="p-name"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                    <h4 class="p-price"><?php echo htmlspecialchars($row['price']); ?></h4>
                    <!-- Add to Cart button with data attributes -->
                    <button class="btn btn-outline-secondary btn-add-to-cart" 
                            data-product-name="<?php echo htmlspecialchars($row['product_name']); ?>"
                            data-price="<?php echo htmlspecialchars($row['price']); ?>"
                            data-image-url="<?php echo htmlspecialchars($row['image1']); ?>"
                            style="font-weight: bold; border-radius: 20px;">Add to Cart
                    </button>
                </div>
            </div>
        <?php } ?>
        </div>
</section>

<script>
    // Function to handle adding product to cart
    function addToCart(productName, price, imageUrl) {
        // Create FormData object to send data to PHP script
        var formData = new FormData();
        formData.append('product_name', productName);
        formData.append('price', price);
        formData.append('image_url', imageUrl);
        formData.append('quantity', 1); // Default quantity

        // Send data to PHP script using fetch API
        fetch('add_to_cart.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Cart updated successfully
                console.log('Product added to cart.');
                // Display success alert
                alert('Product added to cart successfully!');
                // Optionally, you can display a success message or update the UI
            } else {
                // Handle errors
                console.error('Failed to add product to cart.');
                // Optionally, you can display an error message to the user
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle network errors
        });
    }

    // Add event listeners to all "Add to Cart" buttons
    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            // Extract product information from data attributes
            const productName = this.getAttribute('data-product-name');
            const price = this.getAttribute('data-price');
            const imageUrl = this.getAttribute('data-image-url');

            // Call addToCart function with product information
            addToCart(productName, price, imageUrl);
        });
    });
</script>