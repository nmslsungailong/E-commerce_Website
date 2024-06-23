<?php
// Include database connection code
include('combine/database.php');

// Check if item_id is provided in the request
if (isset($_POST['item_id'])) {
    // Sanitize the item_id
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);

    // Prepare SQL query to delete item from cart
    $stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $item_id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Item deleted successfully
        http_response_code(200); // Set HTTP status code to 200 (OK)
        // Redirect back to the cart page
        header('Location: cart.php');
        exit; // Terminate script execution after redirection
    } else {
        // Failed to delete item
        http_response_code(500); // Set HTTP status code to 500 (Internal Server Error)
        // Optionally, you can return an error message or handle the response
    }
} else {
    // product_name not provided
    http_response_code(400); // Set HTTP status code to 400 (Bad Request)
    // Optionally, you can return an error message or handle the response
}
?>
