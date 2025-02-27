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
                        <h1 class="mb-4">GLOBAL HOSPITALS</h1>
                        <p class="mb-4">Provide best quality healthcare for you</p>
                        <p><i class="fa fa-check text-primary me-3"></i><strong>Affordable monthly premium packages</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</p>
                        <p><i class="fa fa-check text-primary me-3"></i><strong>Choose your favourite services</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</p>
                        <p><i class="fa fa-check text-primary me-3"></i><strong>Only use friendly environment</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2md part -->
        <!-- <section id="boxes" class="home-section paddingtop-80" style="background: -webkit-linear-gradient(left, #3931af, #00c6ff);color: white;font-family: 'IBM Plex Sans', sans-serif;"> -->
        <section id="boxes" class="home-section paddingtop-80">
            <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <div class="box text-center">

                    <i class="fa fa-check fa-3x bg-skin"></i>
                    <h4>Make an appoinment</h4>
                    <p>
                        Lorem ipsum dolor sit amet, nec te mollis utroque honestatis, ut utamur molestiae vix, graecis eligendi ne.
                    </p>
                    </div>
                </div>
                </div>
                <div class="col-sm-3 col-md-3">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <div class="box text-center">

                    <i class="fa fa-list-alt fa-3x bg-skin"></i>
                    <h4>Choose your package</h4>
                    <p>
                        Lorem ipsum dolor sit amet, nec te mollis utroque honestatis, ut utamur molestiae vix, graecis eligendi ne.
                    </p>
                    </div>
                </div>
                </div>
                <div class="col-sm-3 col-md-3">
                <div class="wow fadeInUp" data-wow-delay="0.7s">
                    <div class="box text-center">
                    <i class="fa fa-user-md fa-3x bg-skin"></i>
                    <h4>Help by specialist</h4>
                    <p>
                        Lorem ipsum dolor sit amet, nec te mollis utroque honestatis, ut utamur molestiae vix, graecis eligendi ne.
                    </p>
                    </div>
                </div>
                </div>
                <div class="col-sm-3 col-md-3">

                <div class="wow fadeInUp" data-wow-delay="0.9s">
                    <div class="box text-center">

                    <i class="fa fa-hospital-o fa-3x bg-skin"></i>
                    <h4>Get diagnostic report</h4>
                    <p>
                        Lorem ipsum dolor sit amet, nec te mollis utroque honestatis, ut utamur molestiae vix, graecis eligendi ne.
                    </p>
                    </div>
                </div>
                </div>
            </div>
            </div>

            </section>


            <section id="service" class="home-section nopadding paddingtop-60"style="height: 80%;" >
            <div class="container">

            <div class="row">
                <div class="col-sm-6 col-md-6">
                <div class="wow fadeInLeft" data-wow-delay="0.2s">
                    <img src="img/about-5.jpg" class="img-responsive" alt="" />
                </div>
                </div>
                <div class="col-sm-3 col-md-3">

                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <div class="service-box">
                    <div class="service-icon">
                        <span class="fa fa-stethoscope fa-3x" style="color:#0062cc"></span>
                    </div>
                    <div class="service-desc">
                        <h5 class="h-light">Medical checkup</h5>
                        <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                    </div>
                    </div>
                </div>

                <div class="wow fadeInRight" data-wow-delay="0.2s">
                    <div class="service-box">
                    <div class="service-icon">
                        <span class="fa fa-wheelchair fa-3x" style="color:#0062cc"></span>
                    </div>
                    <div class="service-desc">
                        <h5 class="h-light">Nursing Services</h5>
                        <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                    </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.3s">
                    <div class="service-box">
                    <div class="service-icon">
                        <span class="fa fa-plus-square fa-3x" style="color:#0062cc"></span>
                    </div>
                    <div class="service-desc">
                        <h5 class="h-light">Pharmacy</h5>
                        <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                    </div>
                    </div>
                </div>


                </div>
                <div class="col-sm-3 col-md-3">

                <div class="wow fadeInRight" data-wow-delay="0.1s">
                    <div class="service-box">
                    <div class="service-icon">
                        <span class="fa fa-h-square fa-3x" style="color:#0062cc"></span>
                    </div>
                    <div class="service-desc">
                        <h5 class="h-light">Gyn Care</h5>
                        <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                    </div>
                    </div>
                </div>

                <div class="wow fadeInRight" data-wow-delay="0.2s">
                    <div class="service-box">
                    <div class="service-icon">
                        <span class="fa fa-filter fa-3x" style="color:#0062cc"></span>
                    </div>
                    <div class="service-desc">
                        <h5 class="h-light">Neurology</h5>
                        <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                    </div>
                    </div>
                </div>
                <div class="wow fadeInRight" data-wow-delay="0.3s">
                    
                    <div class="service-box">
                    <div class="service-icon">
                        <span class="fa fa-heartbeat fa-3x"></span>
                    </div>
                    <div class="service-desc">
                        <h5 class="h-light">Sleep Center</h5>
                        <p>Vestibulum tincidunt enim in pharetra malesuada.</p>
                    </div>
                    </div>
                </div>

                </div>

            </div>
            </div>
            </section>
        <!-- About End -->


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