<?php

include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/css/custom.css">
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Add Blog</h6>
                <div id="loader" style="display: none;">
                    <div class="lds-dual-ring">
                        <div class="overlay">
                        </div>
                    </div>
                </div>
                <form action="javascript:;" id="blogPublishedForm" method="POST">
                    <!--start breadcrumb-->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                       
                        <div class="ms-auto">
                            <div class="col">                             

                                <button type="button" data-token="<?php echo $blogView['blog_token']; ?>" id="blogPublish" class="btn btn-outline-success px-5 mt-2 rounded-0" name="blogPublish">Publish Blog</button> 
                            </div>
                        </div>
                    </div>
                    <!--end breadcrumb-->

                    <?php
                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];
                    }
                    $query = mysqli_query($conn, "SELECT * FROM blogs where blog_token='$token'");
                    $blogView = mysqli_fetch_array($query);

                    ?>
                    <!--start product detail-->
                    <section class="blog-viw">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-0">
                                        <div class="col-12 col-lg-12 blogview-image">
                                            <img src="../blog/upload/blog_cover/<?php echo $blogView['blog_img']; ?>" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-12 col-lg-12 mt-3">
                                            <div class="blog-info-section p-3">
                                                <div class="mt-3 mt-lg-0 blog-top">

                                                    <div class="d-flex">
                                                        <h1 class=" mb-2 blog-title"><?php echo $blogView['blog_title']; ?></h1>

                                                    </div>



                                                    <div class="blog-su">
                                                        <ul>
                                                            <li class="blog-author">By : <span> MSG</span></li>
                                                            <li class="blog-time">
                                                                <ion-icon name="calendar-number-outline"></ion-icon> <?php echo $blogView['date_time']; ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="mt-3 blog-desc">
                                                    <?php echo $blogView['blog_desc']; ?>
                                                </div>
                                                <hr>
                                                <div class="blog-tags">
                                                    <p><strong>BLOG TAG</strong></p>
                                                    <div class="tags-box w-70">

                                                        <?php
                                                        $get_tag = explode(",", $blogView['blog_tags']);
                                                        foreach ($get_tag as $tag) {
                                                            $sql_tag = mysqli_query($conn, "select * from blog_tags where id='$tag'");
                                                            // print_r("select * from blog_tags where id='$tag'");
                                                            $var_tag = mysqli_fetch_assoc($sql_tag);
                                                            echo "<a href='javascript:void(0);' class='tag-link'>" . ucwords($var_tag['tag_name']) . "</a>";
                                                        } ?>

                                                    </div>
                                                </div>
                                                <hr>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--end product detail-->
                    <div class="m-auto text-center">
                        <div class="col">
                            <!-- <a href="add-blog.php" class="btn btn-outline-secondary px-5 rounded-0">Not Now</a> -->

                            <button type="button" data-token="<?=$blogView['blog_token']; ?>" id="blogPublish" class="btn btn-outline-success px-5 mt-2 rounded-0" name="blogPublish">Publish Blog</button> 
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</div>
    </section>
<?php include('includes/footer.php'); ?>
<script src="js/blog-action.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script>

        function srbSweetAlret(msg, swicon) {
    msg = msg;
    swicon = swicon;
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: swicon,
        title: msg
    })
}
    </script>
