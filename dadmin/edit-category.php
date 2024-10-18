<?php include('includes/header.php');
include('blog-header.php');
if(isset($_GET['catid'])){
    $catID = $_GET['catid'];
    $getQuryData = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `blog_category` WHERE `id`='$catID'"));
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

                <h6 class="card-title">Add Category</h6>
                <div id="loader" style="display: none;">
                    <div class="lds-dual-ring">
                        <div class="overlay">
                        </div>
                    </div>
                </div>
                <form action="javascript:;" id="blogCatEditForms" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Category Title <span>*</span> : </label>
                        <input class="form-control form-control-lg" type="text" value="<?=$getQuryData['cat_name'];?>" placeholder="Enter Category Title" name="Categoryname" required="">
                        <div class="invalid-feedback" style="display: block;"></div>
                    </div>



                    <div class="mb-4">
                        <label for="" class="form-label ">Category Image <span>*</span></label>
                        <div class="d-flex w-100">
                        <img width="140px" height="140px" class="me-2" src="../blog/upload/blog_cat/<?=$getQuryData['cat_thumb'];?>" alt="">
                        <div>
                        <input class="form-control dropFile" type="file" name="CategoryImg" onchange="catImageFunction(this)" id="CategoryImg" >
                        <small class="form-small"> Note : Please upload image size with width between 400px-500px & Height between 400px-500px </small>
                        </div>
                        </div>
                    </div>



                    <div>
                        <input type="hidden" id="formType" name="formType" value="EditblogCattype">
                        <input type="hidden" id="catid" name="catid" value="<?=$getQuryData['id'];?>">
                        <button class="btn btn-primary" type="submit" name="EditBlogCat" id="EditBlogCat">Save Category</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/blog-action.js"></script>
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
 