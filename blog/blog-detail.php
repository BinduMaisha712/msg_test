<?php include('includes/header.php');

if (isset($_GET['blog'])) {
      $name = str_replace("_"," ","$_GET[blog]") ;
 
    $blogDetailsQ = mysqli_query($con, "SELECT b.*, bc.cat_name FROM blogs b, blog_category bc WHERE bc.id=b.blog_cat AND b.blog_title LIKE '%$name%';");
    $blogDetails = mysqli_fetch_array($blogDetailsQ);
     


//     $cate_id = $blogDetails['blog_cat'];
//     $catListquery = mysqli_query($con, "SELECT * FROM blog_category WHERE id='$cate_id' AND `status`='active' order by id DESC");
//     $catres = mysqli_fetch_array($catListquery);
}

?>




<section class="page-header mb-5">
    <div class="container-xl">
        <div class="text-center">
            <h1 class="mt-0 mb-2">Blog Detail</h1>
            <nav aria-label="">
                <ul class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog Detail</li>
                </ul>
            </nav>
        </div>
    </div>
</section>

<!-- section main content -->
<section class="main-content mt-3">
    <div class="container-xl">
        <div class="row gy-4">

            <div class="col-lg-12">
                <!-- post single -->
                <div class="post post-single">
                    <!-- post header -->
                    <div class="post-header">
                        <h1 class="title mt-0 mb-3"><?php echo $blogDetails['blog_title']; ?></h1>
                        <ul class="meta list-inline mb-0">
                            <!--<li class="list-inline-item"><img src="https://micodetest.com/msg_updated/asset/image/logo/110x110.png" width="50" class="author" alt="author" /> MSG</li>-->
                            <!--<li class="list-inline-item"><?php echo $blogDetails['cat_name']; ?></li>-->
                            <li class="list-inline-item"><?php echo $blogDetails['ins_date']; ?></li>
                        </ul>
                    </div>
                    <!-- featured image -->
                    <div class="featured-image">
                        <img src="upload/blog_cover/<?php echo $blogDetails['blog_img']; ?>" alt="post-title" />
                    </div>
                    <!-- post content -->
                    <div class="post-content clearfix">
                        <?php echo $blogDetails['blog_desc']; ?>
                    </div>
                    <div class="widget-content">
                        <div class="py-3" >
                        <h5 class="p-0 m-0 ">Tags :</h5>
                        <img src="images/wave.svg" class="wave" alt="wave" />
                        </div>
                        <?php
                        $get_tag = explode(",", $blogDetails['blog_tags']);
                        foreach ($get_tag as $tag) {
                            $sql_tag = mysqli_query($con, "select * from blog_tags where id='$tag'");
                            $var_tag = mysqli_fetch_array($sql_tag);
                             
                                $tagId = $var_tag['id'];
                                echo " <a href='javascript:void(0);' class='tag'>" . ucwords($var_tag['tag_name']) . "</a>";
                            
                        } ?>

                        
                        
                    </div>

                </div>

                <div class="spacer" data-height="50"></div>


            </div>

            <div class="col-lg-4">

                <!-- sidebar -->
                <div class="sidebar">


                 

                    <!-- widget categories -->
                 <!--   <div class="widget rounded">
                        <div class="widget-header text-center">
                            <h3 class="widget-title">Explore More Cate</h3>
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

            </div>-->

        </div>

    </div>
</section>


<?php include('includes/footer.php'); ?>