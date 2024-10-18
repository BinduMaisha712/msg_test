    <?php include('includes/header.php'); ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
            <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Pagination</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item"><span>UI Elements</span></li>
                                <li class="breadcrumb-item active"><span>Pagination</span></li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <!-- Summary Widget Start -->
                            <div class="summary--widget">
                                <div class="summary--item">
                                    <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,9,7,9,11,9,7,5,7,7,9,11</p>

                                    <p class="summary--title">This Month</p>
                                    <p class="summary--stats text-green">2,371,527</p>
                                </div>

                                <div class="summary--item">
                                    <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7</p>

                                    <p class="summary--title">Last Month</p>
                                    <p class="summary--stats text-orange">2,527,371</p>
                                </div>
                            </div>
                            <!-- Summary Widget End -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Page Header End -->

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Default Pagination</h3>
                    </div>

                    <div class="panel-content text-center pt-5">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Basic Pagination</h5>

                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                                </ul>

                                <p>Default pagination without next/previous.</p>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Pagination With Arrows</h5>

                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a href="#" class="page-link">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>

                                <p>Default pagination with next/previous icons.</p>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Pagination With Links</h5>

                                <ul class="pagination justify-content-center">
                                    <li class="page-item"><a href="#" class="page-link">Prev</a></li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                                </ul>

                                <p>Default pagination with next/previous links.</p>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Pagination With Links &amp; Arrows</h5>

                                <ul class="pagination justify-content-center">
                                    <li class="page-item">
                                        <a href="#" class="page-link">
                                            <i class="fa fa-angle-left"></i>
                                            Prev
                                        </a>
                                    </li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">
                                            Next
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>

                                <p>Default pagination with next/previous links and arrows.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Circular Pagination</h5>

                                <ul class="pagination pagination-circular justify-content-center">
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">4</a></li>
                                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                                </ul>

                                <p>Circular pagination without next/previous.</p>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Circular Pagination With Arrows</h5>

                                <ul class="pagination pagination-circular justify-content-center">
                                    <li class="page-item">
                                        <a href="#" class="page-link">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>

                                <p>Circular pagination with next/previous icons.</p>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Circular Pagination With Links</h5>

                                <ul class="pagination pagination-circular justify-content-center">
                                    <li class="page-item">
                                        <a href="#" class="page-link border-0">Prev</a>
                                    </li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item">
                                        <a href="#" class="page-link border-0">Next</a>
                                    </li>
                                </ul>

                                <p>Circular pagination with next/previous links.</p>
                            </div>

                            <div class="col-lg-3 col-md-6 mb-4">
                                <h5 class="h5 fw--600 mb-3">Pagination With Links &amp; Icons</h5>

                                <ul class="pagination pagination-circular justify-content-center">
                                    <li class="page-item">
                                        <a href="#" class="page-link border-0">
                                            <i class="fa fa-angle-left"></i>
                                            Prev
                                        </a>
                                    </li>
                                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                                    <li class="page-item active"><a href="#" class="page-link">2</a></li>
                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                    <li class="page-item">
                                        <a href="#" class="page-link border-0">
                                            Next
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>

                                <p>Circular pagination with next/previous links and icons.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           