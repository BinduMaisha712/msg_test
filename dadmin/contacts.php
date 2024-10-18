    <?php 
        include('includes/header.php');
    ?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Page Header Start -->
            <section class="page--header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Page Title Start -->
                            <h2 class="page--title h5">Contacts</h2>
                            <!-- Page Title End -->

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active"><span>Contacts</span></li>
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
                                <a href="#" class="btn btn-block btn-rounded btn-warning fw--600">Create New Contact</a>
                            </div>
                            <!-- Toolbar End -->

                            <!-- Contacts Navigation Start -->
                            <ul class="navigation">
                                <li class="active">
                                    <a href="#">
                                        <i class="far fa-circle"></i>
                                        <span>All Contacts</span>
                                    </a>
                                </li>
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
                            <!-- Contacts Navigation End -->
                        </div>
                        <!-- App Sidebar End -->

                        <!-- App Sidebar Start -->
                        <div class="app_sidebar col-lg-3">
                            <!-- Toolbar Start -->
                            <div class="toolbar">
                                <!-- App Search Bar Start -->
                                <form action="#" method="get" class="app_searchBar w-100">
                                    <input type="search" name="contacts" placeholder="Search Contacts..." class="form-control" required>

                                    <button type="submit" class="btn btn-rounded">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                                <!-- App Search Bar End -->
                            </div>
                            <!-- Toolbar End -->

                            <!-- User List Start -->
                            <div class="user--list-w" data-trigger="scrollbar">
                                <ul class="user--list">
                                    <li>
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <img src="assets/img/avatars/01_80x80.png" alt="">
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">John Doe</span>
                                                    <span class="label label-blue">Work</span>
                                                </h4>

                                                <p class="subtitle">Front-End Developer</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <img src="assets/img/avatars/02_80x80.png" alt="">
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">Wales Hue</span>
                                                    <span class="label label-green">Family</span>
                                                </h4>

                                                <p class="subtitle">Illustrator</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <img src="assets/img/avatars/03_80x80.png" alt="">
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">Jane Doe</span>
                                                    <span class="label label-orange">Friends</span>
                                                </h4>

                                                <p class="subtitle">Publishing Editor</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <img src="assets/img/avatars/04_80x80.png" alt="">
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">Dr. Bravestone</span>
                                                    <span class="label label-red">Others</span>
                                                </h4>

                                                <p class="subtitle">Archaeologist</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <span class="avatar-text bg-blue">J</span>
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">John V. Victor</span>
                                                    <span class="label label-blue">Work</span>
                                                </h4>

                                                <p class="subtitle">Commercial Leader</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <img src="assets/img/avatars/02_80x80.png" alt="">
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">Wales Hue</span>
                                                    <span class="label label-green">Family</span>
                                                </h4>

                                                <p class="subtitle">Illustrator</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <span class="avatar-text bg-orange">G</span>
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">Gina E. Stenberg</span>
                                                    <span class="label label-orange">Friends</span>
                                                </h4>

                                                <p class="subtitle">Technical Recruiter</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="list-link">
                                            <div class="avatar">
                                                <img src="assets/img/avatars/04_80x80.png" alt="">
                                            </div>

                                            <div class="info">
                                                <h4 class="title">
                                                    <span class="title-text">Dr. Bravestone</span>
                                                    <span class="label label-red">Others</span>
                                                </h4>

                                                <p class="subtitle">Archaeologist</p>

                                                <p class="desc">
                                                    <span class="desc-text">Lorem Company Inc.</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- User List End -->
                        </div>
                        <!-- App Sidebar End -->
                        
                        <!-- App Content Start -->
                        <div class="app_content col-lg-6">
                            <!-- Toolbar Start -->
                            <div class="toolbar">
                                <a href="#" class="btn btn-sm btn-rounded btn-outline-secondary">Edit</a>

                                <a href="#" class="btn btn-sm btn-rounded btn-outline-secondary ml-auto"><i class="fa fa-times mr-1"></i> Delete</a>
                            </div>
                            <!-- Toolbar End -->

                            <!-- Contact View Start -->
                            <div class="contact--view">
                                <div class="contact--view__avatar">
                                    <img src="assets/img/avatars/03_150x150.png" alt="">
                                </div>

                                <div class="contact--view__info">
                                    <h3 class="contact--view__name">Jane Doe</h3>

                                    <p class="contact--view__role">Publishing Editor</p>
                                    <p class="contact--view__work">Lorem Company Inc.</p>

                                    <table class="contact--view__extra">
                                        <tr>
                                            <td>Location</td>
                                            <td>ABC Ave, Suite 14, Lorem Street, Australia.</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td><a href="tel:+123456123456" class="btn-link">+123 456 123456</a></td>
                                        </tr>
                                        <tr>
                                            <td>Home</td>
                                            <td><a href="tel:123456123456" class="btn-link">(123) 456 123456</a></td>
                                        </tr>
                                        <tr>
                                            <td>Work</td>
                                            <td><a href="tel:456123123456" class="btn-link">(456) 123 123456</a></td>
                                        </tr>
                                    </table>

                                    <div class="contact--view__social">
                                        <ul class="nav">
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-skype"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Contact View End -->
                        </div>
                        <!-- App Content End -->
                    </div>
                    <!-- App Sidebar End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
           <?php
            include('includes/footer.php');

            ?>
      