 <!--Confirm box-->
 <div class="modal fade" id="alertBox">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">

             <div class="modal-header">
                 <input type="hidden" class="close" id="closeModelBox" data-dismiss="modal" />
             </div>

             <div class="modal-body">
                 <img src="assets/img/alertimg.png" alt="alertinfo">
                 <div id="descrip">
                 </div>
             </div>
    
             <div class="modal-footer">
                 <button type="submit" class="btn btn-primary btn-rounded btn-icon-right" data-dismiss="modal">Ok</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="confirmModal" style="display: none; z-index: 1050;">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-img" style="text-align:center;">
                 <img src="assets/img/alertimg.png" alt="alertinfo" style="width:200px;margin-top:5px;">
             </div>
             <div class="modal-body" id="confirmMessage">
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-primary btn-rounded btn-icon-right" id="confirmOk">Ok</button>
                 <button type="button" class="btn btn-primary btn-rounded btn-icon-right" id="confirmCancel">Cancel</button>
             </div>
         </div>
     </div>
 </div>



<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="showItems">
        ...
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" href="index.php">Browse More</a>
        <a type="button" class="btn btn-primary" id="modalProceedBtn" href="checkout.php">Proceed wihtout these</a>
      </div>
    </div>
  </div>
</div>

 <div id="snackbarDefaultNew"></div>
 <footer>
     <div class="footer-area gray-bg">
         <div class="container">
             <div class="row justify-content-between">
                 <div class="col-xl-3 col-lg-4 col-md-6">
                     <div class="footer-widget mb-50">
                         <div class="footer-logo mb-25">
                             <?php
                                //show logo
                                $logo = $homePage->logo();
                                ?>
                             <a href="index.php"><img src="asset/image/logo/<?= $logo['logo'] ?>" alt="" width="170px"></a>
                         </div>
                         <div class="footer-contact-list">
                             <ul>
                                 <li>
                                     <div class="icon"><i class="flaticon-place"></i></div>
                                     <a href="https://maps.app.goo.gl/X9AEzGQ33hotSuwy6" target="_blank"><p><?= $homePage->contactInfo('address'); ?></p></a>
                                 </li>
                                 <li>
                                     <div class="icon"><i class="flaticon-telephone-1"></i></div>
                                     <h5 class="number"><a href="tel:<?= $homePage->contactInfo('phone'); ?>"><?= $homePage->contactInfo('phone'); ?></a></h5>
                                 </li>

                                 <li>
                                     <div class="icon"><i class="flaticon-wall-clock"></i></div>
                                     <p>Week 7 days from 7:00 to 20:00</p>
                                 </li>
                             </ul>
                         </div>
                         <div class="footer-social">
                             <ul>
                                 <?php
                                    $social_media = mysqli_query($con, "SELECT * FROM social_media WHERE url != '' AND status ='Active'");
                                    while ($url = mysqli_fetch_assoc($social_media)) { ?>
                                     <li><a href="<?= $url['url']; ?>" target="_blank"><i class="<?= $url['icon']; ?>"></i></a></li>
                                 <?php } ?>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                     <div class="footer-widget mb-50">
                         <div class="fw-title">
                             <h5 class="title">Company</h5>
                         </div>
                         <div class="fw-link">
                             <ul>
                                 <li><a href="about.php">About Us</a></li>
                                 <li><a href="contact.php">Contact Us</a></li>
                                 <li><a href="https://micodetest.com/msg_updated/blog">Blogs</a></li>
                                 <!-- <li><a href="faq.php">FAQ</a></li> -->
                                 <li><a href="privacy-and-policy.php">Privacy Policy</a></li>
                                 <li><a href="term-and-condition.php">Terms & Conditions</a></li>
                                 <li><a href="return-refund.php">Shipping & Delivery Policy</a></li>
                                 
                                <?php if (USER::isLoggedIn()) { ?>
                                <?php
                                if (isset($_SESSION['loginid'])) {
                                    $loginId = $_SESSION['loginid'];
                                } else {
                                    $loginId = 0;
                                }
                                $result = mysqli_query($con, "SELECT * FROM user WHERE id = '$loginId' AND role='User'");
                                $row_count = mysqli_num_rows($result);

                                if ($row_count > 0) {
                                ?>
                                     <li><a href="dashboard.php?order">Track Your Orders</a></li>
                                <?php } else {
                                ?>
                                    <li><a href="agent/agent_track_order.php">Track Your Orders</a></li>
                                <?php } ?>

                            <?php } else { ?>
                                 <li><a href="account.php">Track Your Orders</a></li>
                            <?php } ?>
                                 
                                 <?php 
                                    if ($login_count == '') {
                                    ?>
                                        <!--<li><a href="account.php">Track Your Orders</a></li>-->
                                    <?php
                                    } elseif ($login_count == 1) {
                                    ?>
                                        <!--<li><a href="dashboard.php">Track Your Orders</a></li>-->
                                    <?php
                                    } elseif ($login_count == 0)  {
                                    ?>
                                        <!--<li><a href="agent/index.php">Track Your Orders</a></li>-->
                                    <?php
                                    }
                                    ?>

                                 <li><a href="agent-account.php">Agent Login</a></li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                     <div class="footer-widget mb-50">
                         <div class="fw-title">
                             <h5 class="title">Shop</h5>
                         </div>
                         <div class="fw-link">
                             <ul>
                                 <?php
                                    // show menu
                                    //print_r($homePage->menu());
                                    $ab = 1;
                                    foreach ($homePage->menu() as $mainMenu) {
                                        if ($mainMenu['subMenu'] == 0) {
                                    ?>
                                         <li><a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&<?= $mainMenu['condition']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $mainMenu['cat_name']; ?></a></li>
                                     <?php } else { ?>
                                         <li>
                                             <a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&<?= $mainMenu['condition']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $mainMenu['cat_name']; ?><span class="toggle-btn"></span></a>
                                             <ul class=" d-none">
                                                 <?php
                                                    foreach ($mainMenu['subMenu'] as $subMenu) {
                                                    ?>
                                                     <li><a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&id=subcat_id@<?= $subMenu['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $subMenu['sub_cat_name']; ?></a></li>
                                                 <?php } ?>
                                             </ul>
                                         </li>
                                 <?php }
                                        if ($ab == 7) {
                                            ?>
                                            <li><a href="listing.php">View More</a></li>
                                            <?php 
                                            break;
                                        }
                                        $ab++;
                                    } ?>

                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-4 col-lg-4 col-md-6">
                     <div class="footer-widget footer-box-widget mb-50">
                         <!--<div class="f-download-wrap">-->
                         <!--    <div class="fw-title">-->
                         <!--        <h5 class="title">Download App</h5>-->
                         <!--    </div>-->
                         <!--    <div class="download-btns">-->
                         <!--        <a href="javascript:;"><img src="assets/img/icon/g_play.png" alt=""></a>-->
                         <!--        <a href="javascript:;"><img src="assets/img/icon/app_store.png" alt=""></a>-->
                         <!--    </div>-->
                         <!--</div>-->
                         <div class="f-newsletter">
                             <div class="fw-title">
                                 <h5 class="title">Newsletter</h5>
                             </div>
                             <form id="subscribeForm" class="newsletter-form footer-form">
                                 <input type="email" placeholder="Your emaill address" name="userEmail" class="form-control" required />
                                 <button id="subscribe_btn" class="btn-solid submit-button" type="submit" name="email_to_subscribe"><i class="flaticon-send"></i></button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row justify-content-center py-3">
                 <div class="col-lg-12 text-center">
                     Designed &amp; Developed By <a href="https://www.maishainfotech.com" target="_blank">Maisha Infotech Pvt. Ltd.</a>

                 </div>
             </div>
         </div>
     </div>
     <div class="menubar-footer footer-fixed">
         <ul class="inner">
             <li class="active">
                 <a href="index.php"><span class="fas fa-home"></span> Home</a>
             </li>
             <li>
                 <a href="javascript:;" class="mobile-nav-toggler"><span class="fas fa-bars"></span>Category</a>
             </li>
             <li class="cart_boot">
                 
                 <a href="cart.php"><span class="fas fa-cart-plus"></span> Cart
                     <span class="cart-items cart-add"><?php echo $cart->totalItemInCart(); ?></span>
                 </a>
             </li>

             <li>
                 <?php if (USER::isLoggedIn()) { ?>
                     <a href="dashboard.php"><span class="fas fa-user"></span><?= $user->headerUser(); ?></a>
                 <?php } else { ?>
                     <a href="account.php"><span class="fas fa-user"></span> Profile</a>
                 <?php } ?>
             </li>
         </ul>
     </div>
     <div class="copyright-wrap">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-md-6">
                     <div class="copyright-text">
                         <p>Copyright &copy; <?= date('Y') ?> MSG All Rights Reserved</p>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="payment-accepted text-center text-md-right">
                         <img src="assets/img/images/payment_card.png" alt="">
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- footer-area-end -->
 <script type="text/javascript">
     var max = 0;
 </script>
 
<div class="header-cart-wrap_hny12" id="headerCartWrap">               
       <div id='google_translate_element'></div>
</div>

 <div id="snackbar">Product Added to cart...</div>
 <div id="snackbar1">Product Added to Wishlist...</div>
 <div id="snackbarDefault">Error Occur...</div>

 <script type="text/javascript">
     var currentPage = '<?= $currentPage ?>';
     var currency = '<?= $currency; ?>';
 </script>
 <!--Jquery 1.12.4-->
 <script src="https://code.jquery.com/jquery-latest.js"></script>

 <!--Popper-->
 <script src="js/popper.min.js"></script>

 <!--Imagesloaded-->
 <script src="js/imagesloaded.pkgd.min.js"></script>
 <!--Isotope-->
 <script src="js/isotope.pkgd.min.js"></script>
 <!--Ui js-->
 <script src="js/jquery-ui.min.js"></script>
 <!--Countdown-->
 <script src="js/jquery.countdown.min.js"></script>
 <!--Counterup-->
 <script src="js/jquery.counterup.min.js"></script>
 <!--ScrollUp-->
 <script src="js/jquery.scrollUp.min.js"></script>
 <!--Chosen js-->
 <script src="js/chosen.jquery.js"></script>
 <!--Meanmenu js-->
 <script src="js/jquery.meanmenu.min.js"></script>
 <!--Instafeed-->
 <script src="js/instafeed.min.js"></script>
 <!--EasyZoom-->
 <script src="js/easyzoom.min.js"></script>
 <!--Fancybox-->
 <script src="js/jquery.fancybox.pack.js"></script>
 <!--Nivo Slider-->
 <script src="js/jquery.nivo.slider.js"></script>
 <!--Waypoints-->
 <script src="js/waypoints.min.js"></script>
 <!--Carousel-->
 <script src="js/owl.carousel.min.js"></script>
 <!--Slick-->
 <script src="js/slick.min.js"></script>
 <!--Wow-->
 <script src="js/wow.min.js"></script>
 <!--Plugins-->
 <script src="js/plugins.js"></script>
 <!--Main Js-->
 <script src="js/main.js"></script>
 <script src="js/image-uploader.min.js"></script>
 <script src="record-process/js/record-process.js?v=2.8"></script>
 <script type="text/javascript" src="js/themejs/addtocart.js"></script>
 <script src="assets/js/sweetalert2.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>




 <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
 <script src="assets/js/isotope.pkgd.min.js"></script>
 <script src="assets/js/imagesloaded.pkgd.min.js"></script>
 <script src="assets/js/jquery.magnific-popup.min.js"></script>
 <script src="assets/js/jquery.countdown.min.js"></script>
 <script src="assets/js/jquery-ui.min.js"></script>
 <script src="assets/js/slick.min.js"></script>
 <script src="assets/js/ajax-form.js"></script>
 <script src="assets/js/wow.min.js"></script>
 <script src="assets/js/aos.js"></script>
 <script src="assets/js/plugins.js"></script>
 <script src="assets/js/main.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
 <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
 <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 10,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 50,
        },
      },
    });
    var swiper1 = new Swiper(".mySwiper1", {
      spaceBetween: 10,
      speed: 1000,
      freeMode: false,
      pagination: {
        el: ".swiper-pagination",
      },
      infinite: true,
      loop: true,
      autoplay: true,
      slidesPerView: 1,
      spaceBetween: 10,
      breakpoints: {
        640: {
          slidesPerView: 1,
          spaceBetween: 20,
        },
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 50,
        },
      },
    });
  </script>

    <script>
      $('.listing-filter').click(function() {
    $('.shop-sidebar').animate({left: "0%"}, 200);
    $('body').addClass('hddd');
  });
  $('.sidebar-close').click(function() {
    $('.shop-sidebar').animate({left: "-100%"}, 200);
    $('body').removeClass('hddd');

  });
   </script>
 <script>
     var currency = '<?= $currency; ?>';

     function userNotLoginAlert() {
         Swal.fire({
             title: 'You are not logged in!',
             text: "Please log in to continue.",
             icon: "warning",
             buttons: ["Cancel", "Log in"],
         }).then((result) => {
             if (result.isConfirmed) {
                 window.location.href = "./account.php?";
             }
         });
     }
 </script>
 <script>
     function openOrderTabSection() {
         $('#my_order_tab_li').addClass('active');
         $("#my_order_tab").click();
     }

     var urlParams = new URLSearchParams(window.location.search);
     var trackorderParam = urlParams.get('trackorder');
     if (trackorderParam === 'y') {

         Swal.fire({
             title: 'TRACK YOUR ORDER',
             html: "<h5>Order Track Instruction</h5><ul><li>1 .Open the 'Orders' tab. If you're not sure where it is, please locate and click on the 'Orders' tab.</li><li>2. If you have purchased a product, a list of products will be displayed. Find the product that you want to track.</li><li>3. Click on the product that you want to track.</li></ul>",
             showCancelButton: false,
             showConfirmButton: true,
             onOpen: function() {
                 Swal.showLoading()
             }
         }).then(function() {
             openOrderTabSection();
         });
         // Get the current URL
         const currentUrl = window.location.href;
         // Remove the "trackorder" parameter from the query string
         const updatedUrl = currentUrl.replace(/[\?&]trackorder=y/, '');
         // Replace the current URL with the updated URL
         history.replaceState(null, null, updatedUrl);
     }
 </script>
 <script>
     function googleTranslateElementInit() {
         new google.translate.TranslateElement({
             pageLanguage: 'en',
             autoDisplay: 'true',
             includedLanguages:'hi,en,bn,ar,ja,iw', 
             layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
         }, 'google_translate_element');
     }
</script>
<script>

document.addEventListener("DOMContentLoaded", function() {
    const headerCartWrap = document.getElementById("headerCartWrap");

    window.addEventListener("scroll", function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Show the div only if the user is at the very top of the page
        if (scrollTop === 0) {
            headerCartWrap.classList.remove("hidden");
        } else {
            headerCartWrap.classList.add("hidden");
        }
    });
});

</script>

<script>
    $(document).ready(function() {
        var url = "header.php";
        
        $("#maindin").load(url + " #secndin", function() {
            $('.mini-cart-wrap').click(function() {
                $('.newhidds').animate({right: "0%"}, 200);
                $('body').addClass('hddd');
            });

            $('.hny_close_cart').click(function() {
                $('.newhidds').animate({right: "-100%"}, 200);
                $('body').removeClass('hddd');
            });
             $('.hny_close_cart').on('click', function() {
                location.reload();
            });
        });
    });
</script>


 </body>

 </html>