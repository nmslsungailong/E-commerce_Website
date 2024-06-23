<?php
    include('combine/database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $image_url = $_POST['image_url'];
        $quantity = $_POST['quantity']; // Default quantity

        // Insert into cart table
        $query = "INSERT INTO cart (product_name, price, image1, quantity) VALUES ('$product_name', '$price', '$$image_url', $quantity)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Cart updated successfully
            http_response_code(200); // OK
        } else {
            // Error inserting into cart
            http_response_code(500); // Internal Server Error
        }
    } else {
        // Method not allowed
        http_response_code(405); // Method Not Allowed
    }
?>
