    <?php include('includes/header.php'); ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
            <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Compose</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>Compose</span></li>
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
                    <!-- App Start -->
                    <div class="app_wrapper row">
                        <!-- App Sidebar Start -->
                        <div class="app_sidebar col-lg-3">
                            <!-- Toolbar Start -->
                            <div class="toolbar">
                                <a href="mailbox_compose.php" class="btn btn-block btn-rounded btn-danger fw--600">Compose</a>
                            </div>
                            <!-- Toolbar End -->

                            <!-- Mailbox Navigation Start -->
                            <ul class="navigation navigation-highlighted">
                                <li class="title">MAILBOX</li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-envelope"></i>
                                        <span>Inbox</span>
                                        <span class="badge text-white bg-blue">3</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-paper-plane"></i>
                                        <span>Sent</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="has-unread">
                                        <i class="far fa-edit"></i>
                                        <span>Draft</span>
                                        <span class="badge text-white bg-blue">1</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-star"></i>
                                        <span>Important</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-tags"></i>
                                        <span>Tags</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-trash-alt"></i>
                                        <span>Trash</span>
                                    </a>
                                </li>

                                <li class="title">LABELS</li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-circle text-blue"></i>
                                        <span>Work</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-circle text-green"></i>
                                        <span>Family</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-circle text-orange"></i>
                                        <span>Friends</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-circle text-red"></i>
                                        <span>Others</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Mailbox Navigation End -->
                        </div>
                        <!-- App Sidebar End -->
                        
                        <!-- App Content Start -->
                        <div class="app_content col-lg-9">
                            <!-- Mail Compose Start -->
                            <div class="mail-compose">
                                <h3 class="mail-compose__title">Compose New Message</h3>

                                <form action="#" method="post">
                                    <div class="form-group">
                                        <input type="email" name="mail_to" placeholder="To:" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="email" name="mail_cc" placeholder="Cc:" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="mail_subject" placeholder="Subject:" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <textarea name="mail_message" class="form-control" data-trigger="summernote"></textarea>
                                    </div>

                                    <div class="btn-list pt-3">
                                        <button type="submit" class="btn btn-sm btn-rounded btn-success">Send <i class="far fa-paper-plane"></i></button>

                                        <button type="button" class="btn btn-sm btn-rounded btn-default">Discard</button>

                                        <button type="button" class="btn btn-sm btn-rounded btn-default">Draft</button>
                                    </div>
                                </form>
                            </div>
                            <!-- Mail Compose End -->
                        </div>
                        <!-- App Content End -->
                    </div>
                    <!-- App Sidebar End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
            