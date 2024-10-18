<link rel="stylesheet" href="assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/flatpickr/flatpickr.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.min.css">
    <!-- End layout styles -->

    <link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <?php 
    
$blogCatQuer = mysqli_query($conn, "SELECT * FROM `blog_category`");
$blogCatQuerCount = mysqli_num_rows($blogCatQuer);


$blogQuer = mysqli_query($conn, "SELECT * FROM `blogs`");
$blogQuerCount = mysqli_num_rows($blogQuer);

$BlogTagquery = mysqli_query($conn, "SELECT * FROM `blog_tags`");
$BlogTagCount = mysqli_num_rows($BlogTagquery);
?>