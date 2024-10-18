    <?php include('includes/header.php'); ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
            <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Search Results</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>Search Results</span></li>
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
                        <h3 class="panel-title">Search Results</h3>
                    </div>

                    <div class="panel-content">
                        <!-- Search Box Start -->
                        <div class="search--box">
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Type to search..." required>

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-rounded btn-info"><i class="fa fa-search mr-1"></i> Search</button>
                                    </div>
                                </div>
                            </form>

                            <ul class="options">
                                <li class="active"><a href="#">All</a></li>
                                <li><a href="#">Users</a></li>
                                <li><a href="#">Messages</a></li>
                            </ul>
                        </div>
                        <!-- Search Box End -->

                        <!-- Search Results Start -->
                        <div class="search--results">
                            <p class="stats">11 Results Found For: <strong>Keyword</strong></p>

                            <ul class="results list-unstyled">
                                <li>
                                    <a href="#">
                                        <h4 class="h4 title">Inbox</h4>

                                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero dolores accusantium aperiam neque consequatur ad iusto quae repellendus ab saepe atque, eaque qui reprehenderit voluptatum natus esse sed beatae ducimus.</p>

                                        <span class="link">http://example.com/page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h4 class="h4 title">UI Elements</h4>

                                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero dolores accusantium aperiam neque consequatur ad iusto quae repellendus ab saepe atque, eaque qui reprehenderit voluptatum natus esse sed beatae ducimus.</p>

                                        <span class="link">http://example.com/page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h4 class="h4 title">Data Validation</h4>

                                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero dolores accusantium aperiam neque consequatur ad iusto quae repellendus ab saepe atque, eaque qui reprehenderit voluptatum natus esse sed beatae ducimus.</p>

                                        <span class="link">http://example.com/page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h4 class="h4 title">Notes</h4>

                                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero dolores accusantium aperiam neque consequatur ad iusto quae repellendus ab saepe atque, eaque qui reprehenderit voluptatum natus esse sed beatae ducimus.</p>

                                        <span class="link">http://example.com/page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h4 class="h4 title">Timeline</h4>

                                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero dolores accusantium aperiam neque consequatur ad iusto quae repellendus ab saepe atque, eaque qui reprehenderit voluptatum natus esse sed beatae ducimus.</p>

                                        <span class="link">http://example.com/page</span>
                                    </a>
                                </li>
                            </ul>

                            <ul class="pagination pagination-sm justify-content-end mt-3">
                                <li class="page-item">
                                    <a href="#" class="page-link"><i class="fa fa-angle-left"></i></a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">1</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">2</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">3</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">4</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link">5</a>
                                </li>
                                <li class="page-item">
                                    <a href="#" class="page-link"><i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                        <!-- Search Results End -->
                    </div>
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           