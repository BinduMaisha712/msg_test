<!DOCTYPE html>
<html lang="en-US">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<?php
include('../config.php');
?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>MSG Blogs</title>
	<meta name="description" content="Maishainfotech Blogs">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="https://micodetest.com/msg_updated/asset/image/logo/110x110.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
</head>

<body>

	<!-- preloader -->
	<div id="preloader">
		<div class="book">
			<div class="inner">
				<div class="left"></div>
				<div class="middle"></div>
				<div class="right"></div>
			</div>
			<ul>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
	</div>
	<div class="site-wrapper">

		<div class="main-overlay"></div>

		<!-- header -->
		<header class="header-personal">
			<div class="container-xl header-top">
				<div class="row align-items-center">

					<!--<div class="col-4 d-none d-md-block d-lg-block">-->
					
					<!--	<ul class="social-icons list-unstyled list-inline mb-0">-->
					<!--		<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>-->
					<!--		<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>-->
					<!--		<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>-->
					<!--		<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-pinterest"></i></a></li>-->
					<!--		<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-medium"></i></a></li>-->
					<!--		<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-youtube"></i></a></li>-->
					<!--	</ul>-->
					<!--</div>-->

					<div class=" text-center">
						<!-- site logo -->
						<a class="navbar-brand" href="index.php"><img src="https://micodetest.com/msg_updated/asset/image/logo/110x110.png" class="pb-3" width="80" alt="logo" /></a>
						<a class="d-block text-logo">MSG Blogs</a>
                        <a class="nav-link " href="https://micodetest.com/msg_updated/"><i class="fa fa-home"></i> Home</a>
                            
					</div>

					<!--<div class="col-md-4 col-sm-12 col-xs-12">-->
					<!--	<div class="header-buttons float-md-end mt-4 mt-md-0">-->

					<!--		<button class="burger-menu icon-button ms-2 float-end float-md-none">-->
					<!--			<span class="burger-icon"></span>-->
					<!--		</button>-->
					<!--	</div>-->
					<!--</div>-->

				</div>
			</div>


		</header>
		<?php
		$blogCountWork = mysqli_query($con, "SELECT * FROM blogs WHERE `status`='active' AND `publish`='published' ");
		$blogCont = mysqli_num_rows($blogCountWork);

		if ($blogCont > 0) {


		?>



			<!-- hero section -->
			<section id="hero">

				<div class="container-xl">

					<div class="row gy-4">

						<div class="">

							<?php
							$blog_first_home_q = mysqli_query($con, "SELECT * FROM `blogs` WHERE `publish`='published' AND `status`='active' ORDER BY id DESC LIMIT 0,1");

							$blog_first_home_r = mysqli_fetch_array($blog_first_home_q);

							$blogPostCat = mysqli_query($con, "SELECT * FROM blog_category WHERE `id`='$blog_first_home_r[blog_cat];' AND `status`='active' ");
							$catres = mysqli_fetch_array($blogPostCat);

							 




							?>

							<!-- featured post large -->
							<div class="post featured-post-lg">
								<div class="details clearfix">
									<!--<a href="blog-list.php?<?= $urltoken; ?>=<?= $urltoken; ?>&&id=<?php echo $catres['id'] ?>&&<?= $urltoken; ?>=<?= $urltoken; ?>" class="category-badge">-->
									<!--	<?php echo $catres['cat_name']; ?>-->
									<!--</a>-->
									<h2 class="post-title"><a href="blog-detail.php?blog=<?= str_replace(" ","_","$blog_first_home_r[blog_title]") ?>"><?php echo $blog_first_home_r['blog_title']; ?></a></h2>
									<ul class="meta list-inline mb-0">
										<!--<li class="list-inline-item"> MSG </li>-->
										<li class="list-inline-item"><?php echo $blog_first_home_r['ins_date']; ?></li>
									</ul>
								</div>
								<a href="blog-detail.php?blog=<?= str_replace(" ","_","$blog_first_home_r[blog_title]") ?>">
									<div class="thumb rounded">
										<div class="inner data-bg-image" data-bg-image="upload/blog_cover/<?php echo $blog_first_home_r['blog_img']; ?>"></div>
									</div>
								</a>
							</div>

						</div>

						<!--<div class="col-lg-4">

							<div class="widget rounded srb-wid-h">
								<div class="widget-header text-center">
									<h3 class="widget-title">Service Category</h3>
									<img src="images/wave.svg" class="wave" alt="wave" />
								</div>
								<div class="widget-content">
									<ul class="list" id="srbscroll">
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

						</div>-->

					</div>

				</div>

			</section>

			<!-- section main content -->
			<section class="main-content">
				<div class="container-xl">

					<div class="row gy-4">

						<div class="col-lg-12">



							<!-- section header -->
							<div class="section-header">
								<h3 class="section-title">Trending Blogs</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>

							<div class="padding-30 rounded bordered">
								<div class="row gy-5">

									<?php

									$blog_que = mysqli_query($con, "SELECT * FROM blogs WHERE `status`='active' AND  `publish`='published'");

									while ($blog_res = mysqli_fetch_array($blog_que)) {

										$blog_res_cat = $blog_res['blog_cat']; 

										$get_cat_b = mysqli_query($con, "SELECT * FROM blog_category WHERE `id`='$blog_res_cat'");
										$get_cat_b_res = mysqli_fetch_array($get_cat_b); 

									?>

										<div class="col-sm-4">
											<!-- post large -->
											<div class="post">
												<div class="thumb rounded">
													<!--<a href="blog-list.php?<?= $urltoken; ?>=<?= $urltoken; ?>&&id=<?php echo $get_cat_b_res['id'] ?>&&<?= $urltoken; ?>=<?= $urltoken; ?>" class="category-badge position-absolute"><?php echo $get_cat_b_res['cat_name']; ?></a>-->
													<span class="post-format">
														<i class="fa fa-image"></i>
													</span>
													<a href="blog-detail.php?blog=<?= str_replace(" ","_","$blog_res[blog_title]") ?>">
														<div class="inner">
															<!--<img src="images/posts/trending-lg-1.jpg" alt="post-title" />-->

															 <img src="upload/blog_cover/<?php echo $blog_res['blog_img']; ?>" alt="post-title" /> 
														</div>
													</a>
												</div>
												<ul class="meta list-inline mt-4 mb-0">
													<!--<li class="list-inline-item"><img src="https://micodetest.com/msg_updated/asset/image/logo/110x110.png" width="40" class="author authorsrb" alt="author" />MSG</li>-->
													<li class="list-inline-item"><?php echo $blog_res['ins_date']; ?></li>
												</ul>
												<h5 class="post-title mb-3 mt-3"><a href="blog-detail.php?blog=<?= str_replace(" ","_","$blog_res[blog_title]") ?>"><?php echo $blog_res['blog_title']; ?></a></h5>
												<div class="excerpt mb-0 srb-hom-dec"><?php echo implode(' ', array_slice(explode(' ', $blog_res['blog_desc']), 0, 30)) ?></div>
											</div>

										</div>

									<?php
									}
									?>

								</div>
							</div>


						</div>


					</div>

				</div>
			</section>



		<?php
		} else {
		?>
			<style>
				.no-blog {
					display: flex;
					padding: 60px 0 0;
					align-items: center;
					justify-content: center;
				}

				.tet {
					padding-left: 35px;
				}

				.tet h3 {
					padding: 0;
					margin: 0;
				}
			</style>
			<div class="no-blog">
				<img src="images/aww.png" width="200" alt="">
				<div class="tet">
					<h3>Blog Not Found Yet !!</h3>
					<p>Stay Connected</p>
				</div>
			</div>


		<?php
		}
		?>
		<!-- footer -->
		<footer>
			<div class="container-xl">
				<div class="footer-inner">
					<div class="row d-flex align-items-center gy-4">
						<!-- copyright text -->
						<div class="col-md-8">
							<span class="copyright">© 2024 MSG. Designed &amp; Developed by <a href="https://maishainfotech.com/" target="_blank">Maisha Infotech Pvt Ltd</a>.</span>
						</div>



						<!-- go to top button -->
						<div class="col-md-4">
							<a href="javascript:void(0);" id="return-to-top" class="float-md-end"><i class="icon-arrow-up"></i>Back to Top</a>
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div>
	<!-- canvas menu -->
	<div class="canvas-menu d-flex align-items-end flex-column">
		<!-- close button -->
		<button type="button" class="btn-close" aria-label="Close"></button>

		<!-- logo -->
		<div class="logo">
			<img src="https://micodetest.com/msg_updated/asset/image/logo/110x110.png" width="130" alt="Katen" />
		</div>

		<!-- menu -->
		<nav>
			<ul class="vertical-menu">

				<li class="active">
					<a href="index.php">Home</a>

				</li>
				<!--<li><a href="https://maishainfotech.com/about.php">About</a></li>-->

				<!--<li>-->
				<!--	<a href="Javascript:void(0);">Services</a>-->
				<!--	<ul class="submenu">-->
				<!--		<li><a href="https://maishainfotech.com/mobile-app-development.php">Mobile Apps Development</a></li>-->
				<!--		<li><a href="https://maishainfotech.com/e-commerce-development.php">E-Commerce Development</a></li>-->
				<!--		<li><a href="https://maishainfotech.com/website-designing.php">Website Designing</a></li>-->
				<!--		<li><a href="https://maishainfotech.com/digital-marketing.php">Digital Marketing</a></li>-->
				<!--		<li><a href="https://maishainfotech.com/website-development.php">Website Development</a></li>-->
				<!--		<li><a href="https://maishainfotech.com/domainandhosting.php"> Domain & Hosting Registration</a></li>-->
				<!--		<li><a href="https://maishainfotech.com/graphic-video-development.php"> Graphic And Video Development</a></li>-->
				<!--	</ul>-->
				<!--</li>-->
				<!--<li><a href="https://maishainfotech.com/contact.php">Contact</a></li>-->

			</ul>
		</nav>

		<!-- social icons -->
		<!--<ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">-->
		<!--	<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>-->
		<!--	<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>-->
		<!--	<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>-->
		<!--	<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-pinterest"></i></a></li>-->
		<!--	<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-medium"></i></a></li>-->
		<!--	<li class="list-inline-item"><a href="javascript:void(0);"><i class="fab fa-youtube"></i></a></li>-->
		<!--</ul>-->
	</div>

	<!-- JAVA SCRIPTS -->
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/jquery.sticky-sidebar.min.js"></script>
	<script src="js/custom.js"></script>

	<script>
		$(document).ready(function() {
			$(document).keydown(function(event) {
				if (event.ctrlKey == true && (event.which == '107' || event.which == '109')) {
					alert('disabling zooming ! ');
					event.preventDefault();
				}
			});
		})
	</script>
	<script>
document.getElementById('return-to-top').addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
</body>

</html>