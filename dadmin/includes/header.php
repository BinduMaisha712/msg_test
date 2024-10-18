 <?php   session_start(); 
if ($_SESSION['user'] == '') {
    header('location:login.php');
}
    include('config/connection.php');
    $query = 'SELECT * FROM currency WHERE id=1';
    
    $query1 = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($query1);
    $currency=$result['currency'] ?? '';
//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

?>


 <!DOCTYPE html>
 <html dir="ltr" lang="en" class="no-outlines">

 <head>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- ==== Document Title ==== -->
     <title>Dashboard - MSG</title>

     <!-- ==== Document Meta ==== -->
     <meta name="author" content="">
     <meta name="description" content="">
     <meta name="keywords" content="">

     <!-- ==== Favicon ==== -->
     <?php
$query = 'SELECT * FROM fav_icon WHERE id=1';
    
    $query1 = mysqli_query($conn,$query);
    $favIcon = mysqli_fetch_assoc($query1)['icon'];
    ?>
     <link rel="icon" href="../asset/image/favIcon/<?=$favIcon;?>" type="image/x-icon">

     <!-- ==== Google Font ==== -->
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

     <!-- Stylesheets -->
     <link rel="stylesheet" href="assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
     <link rel="stylesheet" href="assets/css/perfect-scrollbar.min.css">
     <link rel="stylesheet" href="assets/css/morris.min.css">
     <link rel="stylesheet" href="assets/css/select2.min.css">
     <link rel="stylesheet" href="assets/css/jquery-jvectormap.min.css">
     <link rel="stylesheet" href="assets/css/horizontal-timeline.min.css">
     <link rel="stylesheet" href="assets/css/weather-icons.min.css">
     <link rel="stylesheet" href="assets/css/dropzone.min.css">
     <link rel="stylesheet" href="assets/css/ion.rangeSlider.min.css">
     <link rel="stylesheet" href="assets/css/ion.rangeSlider.skinFlat.min.css">
     <link rel="stylesheet" href="assets/css/datatables.min.css">
     <link rel="stylesheet" href="assets/css/fullcalendar.min.css">
     <link rel="stylesheet" href="assets/css/style.css">
     <link rel='stylesheet'
         href='https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.0.3/dist/css/bootstrap-colorpicker.min.css'>
     <!--<link rel="stylesheet" href="./style.css">-->
     <script src="https://code.jquery.com/jquery-2.2.4.js"
         integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
         
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
     <!-- Page Level Stylesheets -->

 </head>

 <body>

     <style>
     .logo img {
         width: 25%;
     }
     </style>
     <!-- Wrapper Start -->
     <div class="wrapper">
         <!-- Navbar Start -->
         <header class="navbar navbar-fixed">
             <!-- Navbar Header Start -->
             <div class="navbar--header">
                 <!-- Logo Start -->
                 <a href="index.php" class="logo">
                     <?php
                    $query = 'select * from `logo` where id="1"';
      $query = mysqli_query($conn,$query);
      $logo = mysqli_fetch_array($query);
                        // $sql_logo=mysqli_query($conn,"select * from logo where id='1'");
                        // $var_logo=mysqli_fetch_assoc($sql_logo); 
                        ?>
                     <img src="../asset/image/logo/<?=$logo['logo']?>" alt="">
                 </a>
                 <!-- Logo End -->

                 <!-- Sidebar Toggle Button Start -->
                 <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                     <i class="fa fa-bars"></i>
                 </a>
                 <!-- Sidebar Toggle Button End -->
             </div>
             <!-- Navbar Header End -->

             <!-- Sidebar Toggle Button Start -->
             <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                 <i class="fa fa-bars"></i>
             </a>
             <!-- Sidebar Toggle Button End -->

             <!-- Navbar Search Start -->
             <!--<div class="navbar--search">
                <form action="search-results.php">
                    <input type="search" name="search" class="form-control" placeholder="Search Something..." required>
                    <button class="btn-link"><i class="fa fa-search"></i></button>
                </form>
            </div>-->
             <!-- Navbar Search End -->

             <div class="navbar--nav ml-auto">
                 <ul class="nav">


                     <!-- Nav User Start -->
                     <li class="nav-item dropdown nav--user online">
                         <a href="#" class="nav-link" data-toggle="dropdown">
                             <span>Profile</span>
                             <i class="fa fa-angle-down"></i>
                         </a>

                         <ul class="dropdown-menu">
                             <li><a href="#"><i class="far fa-user"></i>Profile</a></li>
                             <li><a href="change-password.php"><i class="fa fa-key"></i>Change Password </a></li>
                             <li><a href="logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
                         </ul>
                     </li>
                     <!-- Nav User End -->
                 </ul>
             </div>
         </header>
         <!-- Navbar End -->

         <!-- Sidebar Start -->
         <aside class="sidebar" data-trigger="scrollbar">
             <!-- Sidebar Profile Start -->
             <!--           <div class="sidebar--profile">
                <div class="profile--img">
                    <a href="#">
                        <img src="assets/img/avatars/01_80x80.png" alt="" class="rounded-circle" style="background-color: #d0c7de;">
                    </a>
                </div>

                <div class="profile--name">
                    <a href="#" class="btn-link">Consta Shop</a>
                </div>

                <div class="profile--nav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="User Profile">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="Lock Screen">
                                <i class="fa fa-lock"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="Messages">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="Logout">
                                <i class="fa fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>-->
             <!-- Sidebar Profile End -->

             <!-- Sidebar Navigation Start -->
             <div class="sidebar--nav">
                 <ul>
                     <li class="mb-0">
                         <ul class="pb-0">
                             <li class="">
                                 <a href="index.php">
                                     <i class="fa fa-home"></i>
                                     <span>Dashboard</span>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <li>
                         <a href="#" class="srb-sidebar-head-bg">ADMIN</a>

                         <ul>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>CATEGORY</span>
                                 </a>

                                 <ul>
                                     <li><a href="category-add.php">Add Category</a></li>
                                     <!--<li><a href="sub-category-add.php">Add Subcategory</a></li>-->
                                     <li><a href="view.php">View</a></li>

                                 </ul>
                             </li>
                             <!---<li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>HOT DEALS</span>
                                </a>

                                <ul>
                                    <li><a href="hot-deals-add.php"> Add Hot Deals </a></li>
                                    <li><a href="hot-deals-view.php">View Hot Deals </a></li>

                                </ul>
                            </li>---->
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Class</span>
                                 </a>

                                 <ul>
                                     <li><a href="view-classtype.php">View Class Type</a></li>


                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Products</span>
                                 </a>

                                 <ul>
                                     <li><a href="add-products.php">Add Products</a></li>
                                     <!-- <li><a href="view-products.php">Views Products</a></li> -->
                                     <li><a href="view-all-products.php">Views Products</a></li>
                                     <!--<li><a href="upload-image.php">Upload Products Images</a></li>-->
                                     <!--<li><a href="upload-products.php">Upload Products</a></li>-->
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Add Delivery Times for checkout</span>
                                 </a>

                                 <ul>
                                     <li><a href="add-timigs.php">Add Timings</a></li>
                                     <li><a href="view-timigs.php">Views Timings</a></li>

                                 </ul>
                             </li>
                             <!-- <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Today's Deal</span>
                                </a>

                                <ul>
                                    
                                    <li><a href="#">Views </a></li>
                                   
                                </ul>
                            </li> -->
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span> View All Order</span>
                                 </a>

                                 <ul>

                                     <li><a href="view-order.php">View Order</a></li>
                                     <li><a href="refundorder.php">View Refund Order</a></li>
                                 </ul>
                             </li>


                             <!-- <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span> Notify Me</span>
                                </a>

                                <ul>
                                   <li><a href="#">View</a></li>
                                </ul>
                            </li> -->

                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Promo Code</span>
                                 </a>

                                 <ul>
                                     <li><a href="promo-code-add.php">Add Promo Code</a></li>
                                     <li><a href="promo-code-view.php">View Promo Code</a></li>
                                 </ul>
                             </li>

                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span> Delivery Men</span>
                                 </a>

                                 <ul>
                                     <li><a href="delivery-men-add.php">Add Deliverymen</a></li>
                                     <li><a href="delivery-men-view.php">View Deliverymen</a></li>
                                 </ul>
                             </li>
                             <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Trash</span>
                                </a>

                                <ul>
                                   <li><a href="category-trash-view.php">Views Category</a></li>
                                   <li><a href="product-trash-view.php">Views Products</a></li>
                                   <li><a href="deliverymen-trash-view.php">View Deliverymen</a></li>
                                   <li><a href="promocode-trash-view.php">View Promo code</a></li>
                                </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span> Agent</span>
                                 </a>

                                 <ul>
                                     <li><a href="add-agent.php">Add Agent</a></li>
                                     <li><a href="agent-payment-confirmation.php">Agent Payment Verfication</a></li>
                                     <li><a href="agent-list.php">Agent List</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Rewards & Achievements</span>
                                 </a>

                                 <ul>
                                     <li><a href="reward-structure.php">Reward Structure</a></li>
                                     <li><a href="change-reward-structure.php">Change Reward Structure</a></li>
                                     <li><a href="achievement-structure.php">Achievement Structure</a></li>
                                     <li><a href="change-achievement-structure.php">Change Achievement Structure</a></li>
                                     <li><a href="reward-claim-history.php">Reward Claim History</a></li>
                                     <li><a href="commission-claim-history.php">Commission Claim History</a></li>
                                     <li><a href="rewards-record.php">Rewards Record</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li>
                         <a href="#" class="srb-sidebar-head-bg">Website</a>

                         <ul>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Users</span>
                                 </a>

                                 <ul>

                                     <li><a href="view-users.php">View Users</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Contact </span>
                                 </a>
                                 <ul>
                                     <li><a href="subscribe.php">Newsletter Subscription</a></li>

                                     <li><a href="contact.php">Contact Form</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Slider</span>
                                 </a>

                                 <ul>
                                     <li><a href="slider-add.php">Add Main Slider</a></li>
                                     <li><a href="slider-view.php">View Main Slider</a></li>
                                     <li><a href="oslider-add.php">Add Offer Slider</a></li>
                                     <li><a href="oslider.php">View Offer Slider</a></li>
                                 </ul>
                             </li>

                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Advertisement Image</span>
                                 </a>
                                 <ul>
                                     <li><a href="header-image.php">Add Advertisement Image</a></li>
                                     <li><a href="view-header-image.php">View Advertisement Image</a></li>
                                 </ul>
                             </li>

                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Footer </span>
                                 </a>
                                 <ul>
                                     <li><a href="edit-contact.php">Edit Contact Info and Social Links</a></li>
                                     <!--<li><a href="edit-footer-content.php">Edit Footer Content</a></li>-->
                                 </ul>
                             </li>


                             <!-- <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Home</span>
                                </a>
                                <ul>
                                     <li><a href="view-home-middle-images.php">Change Middle Images</a></li>
                                     <li><a href="edit-best-seller-image.php?id=1">Edit Best Seller Image 1 </a></li>
                                     <li><a href="edit-best-seller-image.php?id=2">Edit Best Seller Image 2 </a></li>
                                     <li><a href="edit-best-seller-image.php?id=3">Edit Best Seller Image 3 </a></li>
                                     <li><a href="edit-best-seller-image.php?id=4">Edit Best Seller Image 4 </a></li>
                                
                                     <li><a href="add-brands-logo.php">Add Brands Logo</a></li>
                                     <li><a href="view-brands-logo.php">View Brands Logo</a></li>
                                     <li><a href="edit-bottom-image.php?id=1">Edit Bottom Image 1</a></li>
                                     <li><a href="edit-bottom-image.php?id=2">Edit Bottom Image 2</a></li>
                                     
                                     </ul>
                            </li> -->

                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>About Us </span>
                                 </a>
                                 <ul>
                                     <li><a href="edit-aboutus.php">Edit About Us Content</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Blog & Testimonial</span>
                                 </a>
                                 <ul>
                                     <!--<li><a href="blog-category.php">Blog Category</a></li>-->
                                     <li><a href="view-blog.php">Website Blog</a></li>
                                     <li><a href="add-testimonial.php">Add Testimonial</a></li>
                                     <li><a href="testimonials.php">Testimonials</a></li>
                                 </ul>
                                 
                            </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>FAQ </span>
                                 </a>
                                 <ul>
                                     <li><a href="faq-add.php">Add FAQ</a></li>
                                     <li><a href="faq-view.php">View FAQ</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Terms and conditions</span>
                                 </a>
                                 <ul>
                                     <li><a href="terms-n-conditions.php">Add Terms&Conditions</a></li>
                                     <li><a href="terms-n-conditions-view.php">View Terms&Conditions</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Privacy And Policy</span>
                                 </a>
                                 <ul>
                                     <li><a href="privacy-policy-add.php">Add Privacy And Policy</a></li>
                                     <li><a href="privacy-policy-view.php">View Privacy And Policy</a></li>
                                 </ul>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>
                                         <!-- Cancellation & Returns -->Return & Exchange
                                     </span>
                                 </a>
                                 <ul>
                                     <li><a href="Exchange.php">Add Return & Exchange</a></li>
                                     <li><a href="Exchange-view.php">View Return & Exchange</a></li>
                                 </ul>

                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Disclaimer</span>
                                 </a>
                                 <ul>
                                     <li><a href="Disclaimer.php">Add Disclaimer</a></li>
                                     <li><a href="Disclaimer-view.php">View Disclaimer</a></li>
                                 </ul>

                             </li>

                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Configuration</span>
                                 </a>
                                 <ul>
                                     <li><a href="order-config.php">Order</a></li>
                                     <li><a href="edit-logo.php">Logo</a></li>
                                     <li><a href="edit-favIcon.php">Fav Icon</a></li>
                                     <li><a href="edit-currency.php">Currency</a></li>
                                     <li><a href="home.php">Home Configuration</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>
                     <li>
                         <a href="#" class="srb-sidebar-head-bg">Seo</a>

                         <ul>
                             <li>

                                 <a href="view-seopage.php"><i class="fa fa-th"></i>Meta/title/key
                                 </a>
                             </li>
                             <li>
                                 <a href="google-analytic-code.php"><i class="fa fa-th"></i>Google Analytic Code
                                 </a>
                             </li>
                             <li>
                                 <a href="#">
                                     <i class="fa fa-th"></i>
                                     <span>Social Media</span>
                                 </a>
                                 <ul>
                                     <li><a href="add-socialMedia.php">Add Social Media</a></li>
                                     <li><a href="view-socialMedia.php">View Social Media</a></li>
                                 </ul>
                             </li>
                         </ul>
                     </li>

                 </ul>
             </div>
             <!-- Sidebar Navigation End -->
         </aside>
         <!-- Sidebar End -->