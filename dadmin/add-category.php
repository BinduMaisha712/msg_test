<?php include('includes/header.php'); 
include('blog-header.php');?>

<link rel="stylesheet" href="assets/css/inner.css">


        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">Category Add </h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                    <div class="panel-content">
                <form action="javascript:;" id="blogCatForms" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Category Title <span>*</span> : </label>
                        <input class="form-control form-control-lg" type="text" placeholder="Enter Category Title" name="Categoryname" required="">
                        <div class="invalid-feedback" style="display: block;"></div>
                    </div>



                    <div class="mb-4">
                        <label for="" class="form-label ">Category Image <span>*</span></label>
                        <input class="form-control dropFile" type="file" name="CategoryImg" onchange="catImageFunction(this)" id="CategoryImg" required="">
                        <small class="form-small"> Note : Please upload image size with width between 400px-500px & Height between 400px-500px </small>
                    </div>



                    <div>
                        <input type="hidden" id="formType" name="formType" value="addblogCattype">
                        <button class="btn btn-primary" type="submit" name="addBlogCat" id="addBlogCat">Add Category</button>
                    </div>
                </form>

         </div>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                    <!-- Edit Product End -->
                </div>
            </section>
            <!-- Main Content End -->


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
 