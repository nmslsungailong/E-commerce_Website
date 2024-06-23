<?php
    include('combine/database.php');

    // Define the number of items per page
    $items_per_page = 20;

    // Determine the current page number
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the offset
    $offset = ($page - 1) * $items_per_page;

    // Check if a category value is passed through the URL
    $category = isset($_GET['category']) ? $_GET['category'] : '';

    // Perform SQL query to count total rows
    $count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM figures WHERE category LIKE '%$category%'");
    $count_result = mysqli_fetch_assoc($count_query);
    $total_rows = $count_result['total'];

    // Calculate total number of pages
    $total_pages = ceil($total_rows / $items_per_page);

    // Perform SQL query to fetch items for the current page and specific category
    $result = mysqli_query($conn, "SELECT * FROM figures WHERE category LIKE '%$category%' LIMIT $offset, $items_per_page");

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

<body>
    <?php include('combine/navigation.php'); ?>

    <!-- Featured section -->
    <section class="featured my-5 pb-5 pt-5 mt-5">
        <div class="container mt-4 py-4">
            <h3 style="font-weight: bold;">Our Product</h3>
            <hr>
        </div>

        <!-- Product container -->
        <div class="container">
            <!-- Product items -->
            <?php
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                if ($count % 4 == 0) {
                    echo '<div class="row mx-auto container">';
                }
            ?>
                <!-- Individual product item -->
                <div class="product text-center text-center mt-3 py-3 col-lg-3 col-md-4 col-12">
                    <!-- Product image container -->
                    <div onclick="window.location.href='item_detail.php?product_name=<?php echo urlencode($row['product_name']); ?>'" class="image-container">
                        <img class="img-fluid mb-3" src="<?php echo $row['image1']; ?>" alt="Product">
                    </div>
                    <!-- Product details -->
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
            <?php
                $count++;
                if ($count % 4 == 0) {
                    echo '</div>';
                }
            }
            // Close the last row if it's not already closed
            if ($count % 4 != 0) {
                echo '</div>';
            }
            ?>
        </div>

        <!-- Pagination container -->
        <div class="container" id="paginationContainer">
            <nav aria-label="Page navigation">
                <ul id="pagination" class="pagination justify-content-center">
                    <?php
                    // Display previous button
                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="shop-page.php?page=' . ($page - 1) . '">Previous</a></li>';
                    }
                    // Display pagination links for the first 4 pages
                    for ($i = max(1, $page - 1); $i <= min($total_pages, $page + 2); $i++) {
                        echo '<li class="page-item ' . ($page == $i ? 'active' : '') . '"><a class="page-link" href="shop-page.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    // Display next button
                    if ($page < $total_pages) {
                        echo '<li class="page-item"><a class="page-link" href="shop-page.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Footer section -->
    <?php include('combine/footer.php'); ?>

    <!-- JavaScript scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to load additional pagination links
            function loadMorePages(startPage, endPage) {
                var paginationHtml = '';
                for (var i = startPage; i <= endPage; i++) {
                    paginationHtml += '<li class="page-item"><a class="page-link" href="shop-page.php?page=' + i + '">' + i + '</a></li>';
                }
                $('#pagination').append(paginationHtml);
            }

            // Load more pages when the last visible page link is clicked
            $('#pagination').on('click', 'li.page-item:last-child', function() {
                var currentPage = parseInt($(this).find('a').text());
                var totalPages = <?php echo $total_pages; ?>;
                if (currentPage < totalPages) {
                    loadMorePages(currentPage + 1, Math.min(currentPage + 3, totalPages));
                }
            });
        });
    </script>

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
</body>
