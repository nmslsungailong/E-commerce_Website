<?php
    include('combine/database.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirm_password = filter_input(INPUT_POST, "confirm_password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($username)) {
            echo "<script>
                    document.getElementById('username').setAttribute('placeholder', 'Please enter username');
                    usernameField.style.color = 'red';
                  </script>";
        } else if (empty($password)) {
            echo "<script>
                    document.getElementById('password').setAttribute('placeholder', 'Please enter password');
                    passwordField.style.color = 'red';
                  </script>";
        } else if (empty($confirm_password)) {
            echo "<script>
                    document.getElementById('confirm_password').setAttribute('placeholder', 'Please enter confirm password');
                    confirm_passwordField.style.color = 'red';
                  </script>";
        } else if ($confirm_password !== $password) {
            echo "<script>
                    document.getElementById('confirm_password').setAttribute('placeholder', 'confirm password error');
                    confirm_passwordField.style.color = 'red';
                  </script>";
        } else {
            // Check if the username already exists in the database
            $check_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
            if (mysqli_num_rows($check_query) > 0) {
                echo "<script>
                        usernameField.setAttribute('placeholder', 'Please enter username');
                        usernameField.style.color = 'red';
                      </script>";
            } else {
                // Insert the new user into the database
                $sql = "INSERT INTO users (username, password)
                        VALUES('$username','$password')";
                mysqli_query($conn, $sql);

                header("location:successful_register.php");
            }
        }
    }
?>


<head>
        <title>Generic Figure</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width = device-width, initial-scale = 1.0">

        <link rel="stylesheet" href="css/l&R.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha384-***" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include('combine/navigation.php'); ?>

    <section class="Reg">
        <div class="login">
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" class="form" method="post">
                <h1><img src="source/LogoBigv2_transparent.png" style="width: 150px;"></h1>
                <h1>Register</h1><br>
                <label>Username</label>
                <input type="text" placeholder="Username" id="username" name="username"/><br>
                <label>Password</label>
                <input type="password" placeholder="Password" name="password" id="password"/><br>
                <label>Confirm Password</label>
                <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password"/><br>
                <button type="submit">Register</button>
                <p>Already have an account <a style="color: red;" href="login.php">LogIn</a></p>
            </form>
        </div>
    </section>

    <?php include('combine\footer.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // JavaScript code to change placeholders
            var usernameField = document.getElementById('username');
            var passwordField = document.getElementById('password');
            var confirm_passwordField = document.getElementById('confirm_password');

            document.querySelector('.form').addEventListener('submit', function(event) {
                if (usernameField.value.trim() === '') {
                    event.preventDefault();
                    usernameField.setAttribute('placeholder', 'Please enter username');
                    usernameField.style.color = 'red';
                }
                if (passwordField.value.trim() === '') {
                    event.preventDefault();
                    passwordField.setAttribute('placeholder', 'Please enter password');
                    passwordField.style.color = 'red';
                }
                if (confirm_passwordField.value.trim() === '') {
                    event.preventDefault();
                    confirm_passwordField.setAttribute('placeholder', 'Please enter confirm password');
                    confirm_passwordField.style.color = 'red';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>