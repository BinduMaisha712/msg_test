<?php include('includes/header.php');
include('blog-header.php');
$blogCatQuer = mysqli_query($conn, "SELECT * FROM `blog_category` WHERE `status`='active' ");
$blogTag = mysqli_query($conn, "SELECT * FROM `blog_tags`");

if (isset($_GET['token'])) {
    $blog_token = $_GET['token'];
    $getBT = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `blogs` WHERE `blog_token`='$blog_token' "));
}

?>
<link rel="stylesheet" href="assets/css/inner.css">
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">

<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Edit Blog</h6>
                <div id="loader" style="display: none;">
                    <div class="lds-dual-ring">
                        <div class="overlay">
                        </div>
                    </div>
                </div>
                <form action="javascript:;" id="EditblogForms" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Blog Title <span>*</span> : </label>
                        <input class="form-control form-control-lg" type="text" value="<?= $getBT['blog_title']; ?>" placeholder="Enter Blog Title" name="bloGname" required="">
                        <div class="invalid-feedback" style="display: block;"></div>
                    </div>

                    <!--<div class="mb-3">
                        <label class="form-label">Blog Category <span>*</span> : </label>
                        <div class="input-field">
                            <select class="js-example-basic-single form-select ct" name="blogCategory" data-width="100%" required>
                                <option></option>
                                <?php

                                while ($blogCatQuerR = mysqli_fetch_array($blogCatQuer)) {
                                ?>
                                    <option value="<?= $blogCatQuerR['id'] ?>" <?= ($getBT['blog_cat'] = $blogCatQuerR['id']) ? 'selected' : ''; ?>><?= $blogCatQuerR['cat_name'] ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                    </div>-->

                    <div class="mb-3">
                        <label class="form-label">Blog Keywords <span>*</span> : </label>
                        <div class="input-field">
                            <select class="form-select tagging2" name="blogKeyword[]" multiple data-width="100%" required>
                                <option></option>
                                <?php

                                while ($blogTagR = mysqli_fetch_array($blogTag)) {
                                    $get_tag = explode(",", $getBT['blog_tags']);
                                    $tagSts = "";
                                    foreach ($get_tag as $tag) {
                                        if ($tag == $blogTagR['id']) {
                                            $tagSts="selected";
                                        }
                                    }
                                ?>
                                    <option value="<?= $blogTagR['id'] ?>" <?=$tagSts?>><?= $blogTagR['tag_name'] ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>

                    </div>

                    <div class="mb-4">
                        <label for="" class="form-label ">Blog Image <span>*</span></label>
                        <div class="d-flex">
                        <img class="me-3" src="../blog/upload/blog_cover/<?=$getBT['blog_img'];?>" width="125px" height="125px" alt="">
                        <input class="form-control dropFile" type="file" name="blogImg" onchange="blogImageFunction(this)" id="blogImg" >
                        </div>
                        <small class="form-small"> Note : Please upload image size with width between 600px-700px & Height between 400px-500px </small>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Blog Content <span>*</span> : </label>
                        <textarea id="myDesc_two" name="blogContent" class="editor"><?=$getBT['blog_desc'];?></textarea>
                    </div>



                    <div>
                        <input type="hidden" id="formType" name="formType" value="Editblogtype">
                        <input type="hidden" id="blogToken" name="blogToken" value="<?=$getBT['blog_token'];?>">
                        <button class="btn btn-primary" type="submit" name="EditBlog" id="EditBlog">Save Blog's Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
</div>
    </section>
<div id="snackbar"></div>

<?php include('includes/footer.php'); 
include('blog-footer.php');?> 
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/super-build/ckeditor.js"></script>
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