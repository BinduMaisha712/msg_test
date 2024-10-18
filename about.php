<?php include('header.php') ?>
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">About Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->
    <!-- sdgh -->
    <!-- ingredients-area -->
    <section class="ingredients-area pt-90 pb-90">
        <div class="container">
            <div class="ingredients-inner-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-12">
                        <div class="ingredients-img">
                            <img src="assets/img/images/ingredients_img.jpg" alt="" class="img-fluid">
                            <div class="active-years">
                                <h2 class="title">10+ <span>Years</span></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="ingredients-content-wrap">
                            <div class="ingredients-section-title">
                                <span class="sub-title">About Us</span>
                                <h2 class="title">Welcome to Messenger of God</h2>
                            </div>
                            <?php
                            // Show about us
                            $query = "SELECT * FROM aboutus WHERE id = '1'";
                            $querydb = mysqli_query($con, $query);
                            $data = mysqli_fetch_array($querydb);

                            ?>
                            <p style="text-align: justify;"><?php echo $data['aboutus']; ?></p>
                            <div class="ingredients-fact">
                                <ul>
                                    <li>
                                        <div class="icon"><img src="assets/img/icon/ing_icon01.png" alt=""></div>
                                        <div class="content">
                                            <h4>128+</h4>
                                            <span>Awards Winner</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><img src="assets/img/icon/ing_icon02.png" alt=""></div>
                                        <div class="content">
                                            <h4>35k+</h4>
                                            <span>Active Volunteers</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ingredients-area-end -->

    <!-- services-area -->
    <section class="services-area services-bg">
        <div class="container">
            <div class="container-inner-wrap">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9">
                        <div class="services-section-title text-center mb-55">
                            <h2 class="title">Future of Excellence and Inclusion</h2>
                            <p>Creating a bright, united future by embracing diversity, where everyone's unique contributions lead to prosperity and inclusion</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
         
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="services-item">
                            
                            <div class="icon"><i class="flaticon-delivery"></i></div>
                            <div class="content">
                                <h5>Our Mission</h5>
                                <p style="text-align: justify;"><?php echo $data['mission']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="services-item">
                            
                            <div class="icon"><i class="flaticon-like-1"></i></div>
                            <div class="content">
                                <h5>Our Vision</h5>
                                <p style="text-align: justify;"><?php echo $data['vision']; ?></p>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </section>
    <!-- services-area-emd -->

</main>
<!-- main-area-end -->
<?php include('include/footer.php') ?>