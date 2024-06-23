<?php

if (isset($_GET['subtotal'])) {
    $subtotal = $_GET['subtotal'];
    // Sanitize and validate $subtotal as needed
} else {
    $subtotal = 0; // Or handle the missing subtotal appropriately
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('combine/database.php');

    $cardholder_name = $_POST['cardName'];
    $card_number = $_POST['cardNumber'];
    $expiration_month = $_POST['expMonth'];
    $expiration_year = $_POST['expYear'];
    $cvv = $_POST['cvv'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postalCode'];
    $subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : 0;

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO payment_info (cardholder_name, card_number, expiration_month, expiration_year, cvv, street, city, state, postal_code, subtotal) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssd", $cardholder_name, $card_number, $expiration_month, $expiration_year, $cvv, $street, $city, $state, $postal_code, $subtotal);

    // Execute the prepared statement and check for errors
if ($stmt->execute()) {
    echo "<p>New records created successfully</p>";

    // Delete all items from the cart
    $deleteQuery = "DELETE FROM cart"; // No WHERE clause means all records are deleted
    if ($conn->query($deleteQuery) === TRUE) {
        // Redirect to homepage after a short delay to allow the message to be read
        header("Refresh:5; url=homepage.php", true, 303);
    } else {
        echo "<p>Error clearing cart: " . $conn->error . "</p>";
    }

    
    exit(); // Always a good practice after a redirect
} else {
    echo "<p>Error: " . $stmt->error . "</p>";
}


    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width = device-width, initial-scale = 1.0">

        <link rel="stylesheet" href="css/style.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha384-***" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Payment and Address Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        fieldset {
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        legend {
            padding: 0 10px;
            font-weight: bold;
        }

        div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php include('combine/navigation.php'); ?>

    <div class="container">
        <!-- Only display the form if it's not been submitted or if there was an error -->
        <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || isset($stmt->error)): ?>
        <form action="payment_page.php" method="post" class="my-5 pb-5 pt-5">
        <h2>Payment and Billing Address Information</h2>

        <!-- Payment Information -->
        <fieldset>
            <legend>Payment Information</legend>
            <div>
                <label for="cardName">Cardholder's Name:</label>
                <input type="text" id="cardName" name="cardName" required>
            </div>
            <div>
                <label for="cardNumber">Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber" pattern="\d{16}" title="Card number must be 16 digits" required>
            </div>
            <div>
                <label for="expMonth">Expiration Month:</label>
                <input type="text" id="expMonth" name="expMonth" pattern="\d{2}" title="Month must be 2 digits" required>
            </div>
            <div>
                <label for="expYear">Expiration Year:</label>
                <input type="text" id="expYear" name="expYear" pattern="\d{4}" title="Year must be 4 digits" required>
            </div>
            <div>
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" pattern="\d{3}" title="CVV must be 3 digits" required>
            </div>
        </fieldset>

        <!-- Address Information -->
        <fieldset>
            <legend>Billing Address</legend>
            <div>
                <label for="street">Street Name and Number:</label>
                <input type="text" id="street" name="street" required>
            </div>
            <div>
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div>
                <label for="state">State:</label>
                <select id="state" name="state" required>
                    <option value="">Please Select</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <!-- Add other states as needed -->
                </select>
            </div>
            <div>
                <label for="postalCode">Postal Code:</label>
                <input type="text" id="postalCode" name="postalCode" required>
            </div>
        </fieldset>

        <div>
            <label for="subtotal">Subtotal:</label>
            <input type="text" id="subtotal" name="subtotal" value="<?php echo htmlspecialchars(number_format($subtotal, 2)); ?>" readonly>
        </div>

        <button type="submit">Submit Payment and Address</button>
    </form>
        <?php endif; ?>
    </div>

    <?php include('combine/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>