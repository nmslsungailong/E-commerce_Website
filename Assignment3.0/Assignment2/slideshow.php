<link rel="stylesheet" href="css/slideshow.css">

<section>
            <div class="container">
                    <!-- Slideshow container -->
                    <div class="slideshow-container">
                        <script>
                            function showSlides(n) {
                            let i;
                            let slides = document.getElementsByClassName("mySlides");
                            let dots = document.getElementsByClassName("dot");

                            if (n > slides.length) {
                                slideIndex = 1
                            }
                            if (n < 1) {
                                slideIndex = slides.length
                            }
                            for (i = 0; i < slides.length; i++) {
                                slides[i].style.display = "none";
                            }
                            for (i = 0; i < dots.length; i++) {
                                dots[i].className = dots[i].className.replace(" active", "");
                            }
                            slides[slideIndex-1].style.display = "block";
                            dots[slideIndex-1].className += " active";
                            }
                        </script>

                    <br>
                    <br>
                    <!-- Full-width images with number and caption text -->
                    <div class="mySlides fade">
                    <a href="shop-page.php" class="Category">
                        <img src="source/Scale Figure.jpg" style="width:100%" loading="lazy">
                        <div class="text fade" id="Category">Scale Figure</div>
                    </a>
                    </div>

                    <div class="mySlides fade">
                    <a href="shop-page.php" class="Category">
                        <img src="source/figma.jpg" style="width:100%" loading="lazy">
                        <div class="text fade" id="Category">Figma</div>
                    </a>
                    </div>

                    <div class="mySlides fade">
                    <a href="shop-page.php" class="Category">
                        <img src="source/nendroid.jpg" style="width:100%" loading="lazy">
                        <div class="text fade" id="Category">Nendoroid</div>
                    </a>
                    </div>

                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>
                    <br>

                    <!-- The dots/circles -->
                    <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    </div>
                </div>
        </section>

        <script src="javascript/slideshow.js"></script>
