<?php
    // Include the file that contains your database connection code
    include('combine/database.php');

    // Retrieve the product name from the URL
    $product_name = isset($_GET['product_name']) ? $_GET['product_name'] : '';

    $sql = "SELECT * FROM figures WHERE product_name = '$product_name'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
?>

<head>
        <title>Generic Figure</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport"content="width = device-width, initial-scale = 1.0">

        <link rel="stylesheet" href="css/style.css">

        <style>

            .small-img-group{
                display: flex;
                justify-content: space-between;
            }

            .small-img-col{
                flex-basis: 30%;
                cursor: pointer;
            }

            .sproduct input{
                width: 50px;
                height: 40px;
                padding-left: 10px;
                font-size: 16px;
                margin-right: 10px;
            }

            .sproduct input:focus{
                outline: none;
            }

            .sproduct #detail_btn:hover{
                color: yellow;
            }
        </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha384-***" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<?php include('combine/navigation.php'); ?>

    <section class="container sproduct my-5 pt-5">
        <div class="row mt-5">
            <div class="col-lg-5 col-md-12 col-12">
                <img src="<?php echo $row['image1']; ?>" class="img-fluid w-100" id="MainImg">

                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="<?php echo $row['image1']; ?>" class="small-img" width="100%" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="<?php echo $row['image2']; ?>" class="small-img" width="100%" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="<?php echo $row['image3']; ?>" class="small-img" width="100%" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="<?php echo $row['image4']; ?>" class="small-img" width="100%" alt="">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12">
                <h6><?php echo $row['category']; ?></h6>
                <h3 class="py-4" style="color:red;"><?php echo $row['product_name']; ?></h3>
                <h4 style="color:black;"><?php echo $row['price']; ?></h4>
                <button class="btn btn-outline-secondary btn-add-to-cart" 
                    data-product-name="<?php echo htmlspecialchars($row['product_name']); ?>"
                    data-price="<?php echo htmlspecialchars($row['price']); ?>"
                    data-image-url="<?php echo htmlspecialchars($row['image1']); ?>"
                    style="font-weight: bold; border-radius: 20px;">Add to Cart
                </button>
                <h6 class="mt-3 mb-3" style="color: green;">Series: <?php echo $row['series']; ?><h6>
                <h6 class="mt-3 mb-3" style="color: green;">Cooperation: <?php echo $row['cooperation']; ?><h6>
                <h6 class="mt-3 mb-3" style="color: green;">Specification: <?php echo $row['specification']; ?><h6>
                <h6 class="mt-3 mb-3" style="color: green;">Sculptor: <?php echo $row['sculptor']; ?><h6>
                <h4 class="mt-3 mb-3" style="color:red;">Figure Detail</h4>
                <span>
                    <?php echo $row['product_description']; ?>
                </span>
            </div>
        </div>
    </section>

<?php include('related_product.php'); ?>
<?php include('combine\footer.php'); ?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    var MainImg = document.getElementById('MainImg');
    var smalling = document.getElementsByClassName('small-img');

    smalling[0].onclick =function(){
        MainImg.src =smalling[0].src;
    }
    smalling[1].onclick =function(){
        MainImg.src =smalling[1].src;
    }
    smalling[2].onclick =function(){
        MainImg.src =smalling[2].src;
    }
    smalling[3].onclick =function(){
        MainImg.src =smalling[3].src;
    }
</script>

<?php
    } else {
        // Handle case where product is not found
        echo "Product not found!";
    }
?>