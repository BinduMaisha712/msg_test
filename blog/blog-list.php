
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $blogListQ = mysqli_query($con, "SELECT * FROM blogs WHERE `blog_cat`='$id'");
}

?>

<section class="page-header mb-5">
    <div class="container-xl">
        <div class="text-center">
            <h1 class="mt-0 mb-2">Blog List</h1>
            <nav aria-label="">
                <ul class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active" aria-current="page">Blog List</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- section main content -->
<section class=" ">
    <div class="container-xl">

        <div class="row gy-4">

            <div class="col-lg-8">

                <div class="row gy-4">

                    <?php
                    while ($blogList = mysqli_fetch_array($blogListQ)) {


                        $cate_id = $blogList['blog_cat'];
                        $catListquery = mysqli_query($con, "SELECT * FROM blog_category WHERE id='$cate_id' AND `status`='active' order by id DESC");
                        $catres = mysqli_fetch_array($catListquery);
                    ?>
                        <div class="col-sm-6">
                            <div class="post">
                                <div class="thumb rounded">
                                    <a href="blog-list.php?<?= $urltoken; ?>=<?= $urltoken; ?>&&id=<?php echo $catres['id'] ?>&&<?= $urltoken; ?>=<?= $urltoken; ?>" class="category-badge position-absolute"><?php echo $catres['cat_name']; ?></a>
                                    <span class="post-format">
                                        <i class="fa fa-image"></i>
                                    </span>
                                    <a href="blog-detail.php?blog=<?= str_replace(" ", "_", "$blogList[blog_title]") ?>">
                                        <div class="inner">
                                            <!--<img src="images/posts/trending-lg-1.jpg" alt="post-title" />-->

                                            <img src="upload/blog_cover/<?php echo $blogList['blog_img']; ?>" alt="post-title" />
                                        </div>
                                    </a>
                                </div>
                                <ul class="meta list-inline mt-4 mb-0">
                                    <li class="list-inline-item"><img src="https://micodetest.com/msg_updated/asset/image/logo/110x110.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>
                                    <li class="list-inline-item"><?php echo $blogList['ins_date']; ?></li>
                                </ul>
                                <h5 class="post-title mb-3 mt-3"><a href="blog-detail.php?blog=<?= str_replace(" ", "_", "$blogList[blog_title]") ?>"><?php echo $blogList['blog_title']; ?></a></h5>
                                <div class="excerpt mb-0 srb-hom-dec"><?php echo implode(' ', array_slice(explode(' ', $blogList['blog_desc']), 0, 30)) ?></div>
                            </div>

                        </div>

                    <?php
                    }
                    ?>


                </div>



            </div>
            <div class="col-lg-4">

                <!-- sidebar -->
                <div class="sidebar">



                    <!-- widget categories -->
                    <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Explore More Category</h3>
                            <img src="images/wave.svg" class="wave" alt="wave" />
                        </div>
                        <div class="widget-content">
                            <ul class="list">
                                <?php

                                $catr_que = mysqli_query($con, "SELECT * FROM blog_category WHERE `status`='active' ");

                                while ($catr_res = mysqli_fetch_array($catr_que)) {

                                    $catr_count_q = mysqli_query($con, "SELECT * FROM blogs WHERE blog_cat='$catr_res[id]'");
                                    $catr_count_r = mysqli_num_rows($catr_count_q);

                                    if ($catr_count_r) {
                                ?>
                                        <li><a href="blog-list.php?<?= $urltoken; ?>=<?= $urltoken; ?>&&id=<?php echo $catr_res['id'] ?>&&<?= $urltoken; ?>=<?= $urltoken; ?>"><?php echo $catr_res['cat_name']; ?></a><span>(<?php echo $catr_count_r; ?>)</span></li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<?php include('includes/footer.php'); ?>