<?php
include 'header.php';
?>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <?php
        if (isset($_SESSION['candidate_id'])) {
            // If 'candidate_id' exists in session, include 'top_menu.php'
            include 'top_menu.php';
        } else {
            // If 'candidate_id' does not exist, include 'topmenu.php'
            include 'topmenu.php';
        }
        ?>
    </nav>

    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">Information Technology</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">We provide tailored solutions for your IT workforce needs, ensuring optimal results.</p>
                                <a href="./jobs.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">Healthcare</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Discover the perfect fit for your healthcare staffing needs through our comprehensive services.</p>
                                <a href="jobs.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-3.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">FMCG Workforce Solutions</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">BoostTech specializes in providing comprehensive permanent workforce solutions for the Fast-Moving Consumer Goods (FMCG) industry.</p>
                                <a href="jobs.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-4.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">Education and Edtech</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Our expertise lies in providing competent manpower to institutions and Edtech companies, ensuring the right talent for your organization's needs..</p>
                                <a href="jobs.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                <a href="" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Find A Talent</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Search Start -->
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <?php
        include 'jobsearchbar.php';
        ?>
    </div>
    <!-- Search End -->


    <!-- Category Start -->
    <?php include 'category.php'; ?>
    <!-- Category End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden">
                        <div class="col-6 text-start">
                            <img class="img-fluid w-100" src="img/about-1.jpg">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid" src="img/about-2.jpg" style="width: 85%; margin-top: 15%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid" src="img/about-3.jpg" style="width: 85%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid w-100" src="img/about-4.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h3 class="mb-4">Empowering your journey towards success through exceptional talent acquisition.</h3>
                    <p class="mb-4">Boost Tech Consulting emerged with a vision to deliver comprehensive and reliable hiring solutions for middle and top management roles across a wide range of industries in India and internationally. We focus on bridging the gap between highly skilled professionals and the organizations that need them, ensuring that both candidates and employers find the ideal match to achieve their respective goals.</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Bridging the gap between skilled professionals and organizations</p>
                    <p><i class="fa fa-check text-primary me-3"></i> Delivering reliable hiring solutions</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Serving businesses of all sizes, from startups to multinational corporations</p>
                    <a class="btn btn-primary py-3 px-5 mt-3" href="./about_us.php">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <?php
        include 'job.php';
        ?>
    </div>
    <!-- Jobs End -->
    <?php
        // include 'feedback.php';
        ?>
    <!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="text-center mb-5">Our Clients Say!!!</h1>
        <div class="owl-carousel testimonial-carousel">
            <?php
            // Include database connection
            include 'dbconnect.php';

            // Fetch feedback details
            $sql = "SELECT user_name, user_profession, user_message, user_image FROM feedback ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="testimonial-item bg-light rounded p-4">
                        <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                        <p><?= htmlspecialchars($row['user_message']); ?></p>
                        <div class="d-flex align-items-center">
                            <img class="img-fluid flex-shrink-0 rounded" 
                                 src="<?= htmlspecialchars($row['user_image'] ? $row['user_image'] : 'assets/uploads/default-avatar.png'); ?>" 
                                 style="width: 50px; height: 50px;">
                            <div class="ps-3">
                                <h5 class="mb-1"><?= htmlspecialchars($row['user_name']); ?></h5>
                                <small><?= htmlspecialchars($row['user_profession']); ?></small>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>No feedback available.</p>";
            }
            ?>
        </div>
    </div>
</div>
<!-- Testimonial End -->

   

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <?php
        include 'footer.php';
        ?>
    </div>
    <!-- Footer End -->

</div>