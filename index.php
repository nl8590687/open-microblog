
<?php
require 'includes/sqlmng.php';
$weburl='weibo_ailemon_wang';

$con = mysqli_connect($sql_host,$sql_username,$sql_pswd);
mysqli_set_charset($con, 'utf8');
if (!$con)
{
  die('Could not connect: ' . mysqli_error());
}
mysqli_set_charset($con, 'utf8');
//选取数据库 open_microblog
mysqli_select_db($con,"open_microblog");

//$islogin = true;

$islogin = False;

$uPwd='';
$username = "UserName";
$userid = 'userid';

require 'includes/checklogin.php';

$count_weibo = 16;
$count_following = 9;
$count_follower = 12;

if($islogin==True)
{
	//查询用户名
	$sql = "
	SELECT USERNAME FROM USERINFO WHERE USERID='" . $userid . "';
	";
	$r = mysqli_query($con,$sql);
	while( $row = mysqli_fetch_array( $r ) )
	{
		$username = $row["USERNAME"];
		//echo $username;
	}
	
	//获取粉丝数
	$sql = "
	SELECT COUNT(USERID0) COUNT_FOLLOWERS FROM FOLLOWS WHERE USERID1='" . $userid . "';
	";
	$r = mysqli_query($con,$sql);
	while( $row = mysqli_fetch_array( $r ) )
	{
		$count_follower = $row["COUNT_FOLLOWERS"];
	}
	
	//获取关注数
	$sql = "
	SELECT COUNT(USERID1) COUNT_FOLLOWING FROM FOLLOWS WHERE USERID0='" . $userid . "';
	";
	$r = mysqli_query($con,$sql);
	while( $row = mysqli_fetch_array( $r ) )
	{
		$count_following = $row["COUNT_FOLLOWING"];
	}
	
	//获取微博数
	$sql = "
	SELECT COUNT(WEIBOID) COUNT_WEIBO FROM WEIBO WHERE USERID='" . $userid . "';
	";
	$r = mysqli_query($con,$sql);
	while( $row = mysqli_fetch_array( $r ) )
	{
		$count_weibo = $row["COUNT_WEIBO"];
	}
}



?>

<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

	<head>
		<meta charset=\"utf-8\">
		<title>Open MicroBlog</title>
		<meta name="description\" content="iDea a Bootstrap-based, Responsive HTML5 Template">
		<meta name="author" content="htmlcoder.me">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Web Fonts -->

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Font Awesome CSS -->
		<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Fontello CSS -->
		<link href="fonts/fontello/css/fontello.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="css/animations.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">

		<!-- iDea core CSS file -->
		<link href="css/style.css" rel="stylesheet">

		<!-- Color Scheme (In order to change the color scheme, replace the red.css with the color scheme that you prefer)-->
		<link href="css/skins/blue.css" rel="stylesheet">

		<!-- Custom css --> 
		<link href="css/custom.css" rel="stylesheet">
	</head>


	<!-- body classes: 
			"boxed": boxed layout mode e.g. <body class="boxed">
			"pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> 
	-->
	<body>
		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">

			<!-- header-top start -->
			<!-- ================ -->
			<div class="header-top">
				<div class="container">
					<div class="row">
						<div class="col-xs-2  col-sm-6">

							<!-- header-top-first start -->
							<!-- ================ -->
							<div class="header-top-first clearfix">
								<ul class="social-links clearfix hidden-xs">
									<li class="twitter"><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
									<li class="skype"><a target="_blank" href="#"><i class="fa fa-skype"></i></a></li>
									<li class="linkedin"><a target="_blank" href="#"><i class="fa fa-linkedin"></i></a></li>
									<li class="googleplus"><a target="_blank" href="#"><i class="fa fa-google-plus"></i></a></li>
									<li class="youtube"><a target="_blank" href="#"><i class="fa fa-youtube-play"></i></a></li>
									<li class="flickr"><a target="_blank" href="#"><i class="fa fa-flickr"></i></a></li>
									<li class="facebook"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
									<li class="pinterest"><a target="_blank" href="#"><i class="fa fa-pinterest"></i></a></li>
								</ul>
								<div class="social-links hidden-lg hidden-md hidden-sm">
									<div class="btn-group dropdown">
										<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-share-alt"></i></button>
										<ul class="dropdown-menu dropdown-animation">
											<li class="twitter"><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
											<li class="skype"><a target="_blank" href="#"><i class="fa fa-skype"></i></a></li>
											<li class="linkedin"><a target="_blank" href="#"><i class="fa fa-linkedin"></i></a></li>
											<li class="googleplus"><a target="_blank" href="#"><i class="fa fa-google-plus"></i></a></li>
											<li class="youtube"><a target="_blank" href="#"><i class="fa fa-youtube-play"></i></a></li>
											<li class="flickr"><a target="_blank" href="#"><i class="fa fa-flickr"></i></a></li>
											<li class="facebook"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
											<li class="pinterest"><a target="_blank" href="#"><i class="fa fa-pinterest"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
							<!-- header-top-first end -->

						</div>
						<div class="col-xs-10 col-sm-6">

							<!-- header-top-second start -->
							<!-- ================ -->
							<div id="header-top-second"  class="clearfix">

								<!-- header top dropdowns start -->
								<!-- ================ -->
								<div class="header-top-dropdown">
									<div class="btn-group dropdown">
										<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i> Search</button>
										<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
											<li>
												<form role="search" class="search-box">
													<div class="form-group has-feedback">
														<input type="text" class="form-control" placeholder="Search">
														<i class="fa fa-search form-control-feedback"></i>
													</div>
												</form>
											</li>
										</ul>
									</div>
									<?php
									if($islogin==False)
									{
									?>
									<div class="btn-group dropdown">
										<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Login</button>
										<ul class="dropdown-menu dropdown-menu-right dropdown-animation">
											<li>
												<form class="login-form" id="dw__login" action="login.php" method="post" accept-charset="utf-8">
													<div class="form-group has-feedback">
														<label class="control-label">UserID</label>
														<input id="uidbox" name="uID" type="text" class="form-control" placeholder="">
														<i class="fa fa-user form-control-feedback"></i>
													</div>
													<div class="form-group has-feedback">
														<label class="control-label">Password</label>
														<input id="pswdbox" name="uPwd" type="password" class="form-control" placeholder="">
														<i class="fa fa-lock form-control-feedback"></i>
													</div>
													<button id="bt_login" type="submit" class="btn btn-group btn-dark btn-sm" onclick="func_login()">Log In</button>
													<span>or</span>
													<button type="button" class="btn btn-group btn-default btn-sm" onclick="location.replace (\'signup.php\')">Sing Up</button>
													<ul>
														<li><a href="#">Forgot your password?</a></li>
													</ul>
													<div class="divider"></div>
													<span class="text-center">Login with</span>
													<ul class="social-links clearfix">
														<li class="facebook"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
														<li class="twitter"><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
														<li class="googleplus"><a target="_blank" href="#"><i class="fa fa-google-plus"></i></a></li>
													</ul>
												</form>
											</li>
										</ul>
									</div>
									<?php
									}
									else
									{
									?>
									<div class="btn-group dropdown">
										<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $username ?></button>
										<ul class="dropdown-menu dropdown-menu-right dropdown-animation cart">
											<li>
												<table class="table table-hover">
													<thead>
														<tr>
															<th class="quantity">QTY</th>
															<th class="product">Product</th>
															<th class="amount">Subtotal</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="quantity">2 x</td>
															<td class="product"><a href="shop-product.html">Android 4.4 Smartphone</a><span class="small">4.7" Dual Core 1GB</span></td>
															<td class="amount">$199.00</td>
														</tr>
														<tr>
															<td class="quantity">3 x</td>
															<td class="product"><a href="shop-product.html">Android 4.2 Tablet</a><span class="small">7.3" Quad Core 2GB</span></td>
															<td class="amount">$299.00</td>
														</tr>
														<tr>
															<td class="quantity">3 x</td>
															<td class="product"><a href="shop-product.html">Desktop PC</a><span class="small">Quad Core 3.2MHz, 8GB RAM, 1TB Hard Disk</span></td>
															<td class="amount">$1499.00</td>
														</tr>
														<tr>
															<td class="total-quantity" colspan="2">Total 8 Items</td>
															<td class="total-amount">$1997.00</td>
														</tr>
													</tbody>
												</table>
												<div class="panel-body text-right">	
												<a href="shop-cart.html" class="btn btn-group btn-default btn-sm">View Cart</a>
												<a href="logout.php" class="btn btn-group btn-default btn-sm">注销登录</a>
												</div>
											</li>
										</ul>
									</div>
									<?php
									}
									?>

								</div>
								<!--  header top dropdowns end -->

							</div>
							<!-- header-top-second end -->

						</div>
					</div>
				</div>
			</div>
			<!-- header-top end -->

			<!-- header start (remove fixed class from header in order to disable fixed navigation mode) -->
			<!-- ================ --> 
			<header class="header fixed clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-3">

							<!-- header-left start -->
							<!-- ================ -->
							<div class="header-left clearfix">

								<!-- logo -->
								<div class="logo">
									<a href="index.html"><img id="logo" src="images/logo_red.png" alt="iDea"></a>
								</div>

								<!-- name-and-slogan -->
								<div class="site-slogan">
									Clean &amp; Powerful Bootstrap Theme
								</div>

							</div>
							<!-- header-left end -->

						</div>
						<div class="col-md-9">

							<!-- header-right start -->
							<!-- ================ -->
							<div class="header-right clearfix">

								<!-- main-navigation start -->
								<!-- ================ -->
								<div class="main-navigation animated">

									<!-- navbar start -->
									<!-- ================ -->
									<nav class="navbar navbar-default" role="navigation">
										<div class="container-fluid">

											<!-- Toggle get grouped for better mobile display -->
											<div class="navbar-header">
												<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
													<span class="sr-only">Toggle navigation</span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
													<span class="icon-bar"></span>
												</button>
											</div>

											<!-- Collect the nav links, forms, and other content for toggling -->
											<div class="collapse navbar-collapse" id="navbar-collapse-1">
												<ul class="nav navbar-nav navbar-right">
													<li class="dropdown active">
														<a href="index.html" class="dropdown-toggle" data-toggle="dropdown">主页</a>
														<ul class="dropdown-menu">
															<li><a href="index.html">Home - Default</a></li>
															<li><a href="index-2.html">Home - 2</a></li>
															<li><a href="index-3.html">Home - 3</a></li>
															<li><a href="index-4.html">Home - 4</a></li>
															<li><a href="index-5.html">Home - 5</a></li>
															<li><a href="index-one-page.html">One Page Version</a></li>
															<li><a href="index-boxed-slideshow.html">Home - Boxed Slider</a></li>
															<li><a href="index-no-slideshow.html">Home - Without Slider</a></li>
														</ul>
													</li>
													<!-- mega-menu start -->
													<li class="dropdown mega-menu">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">通知</a>
														<ul class="dropdown-menu">
															<li>
																<div class="row">
																	<div class="col-lg-4 col-md-3 hidden-sm">
																		<h4>Premium HTML5 Template</h4>
																		<p>iDea is perfectly suitable for corporate, business and company webpages.</p>
																		<img src="images/section-image-3.png" alt="iDea">
																	</div>
																	<div class="col-lg-8 col-md-9">
																		<h4>Pages</h4>
																		<div class="row">
																			<div class="col-sm-4">
																				<div class="divider"></div>
																				<ul class="menu">
																					<li><a href="page-about.html"><i class="icon-right-open"></i>About Us</a></li>
																					<li><a href="page-about-2.html"><i class="icon-right-open"></i>About Us 2</a></li>
																					<li><a href="page-about-3.html"><i class="icon-right-open"></i>About Us 3</a></li>
																					<li><a href="page-about-me.html"><i class="icon-right-open"></i>About Me</a></li>
																					<li><a href="page-team.html"><i class="icon-right-open"></i>Our Team - Options</a></li>
																					<li><a href="page-services.html"><i class="icon-right-open"></i>Services</a></li>
																				</ul>
																			</div>
																			<div class="col-sm-4">
																				<div class="divider"></div>
																				<ul class="menu">
																					<li><a href="page-contact.html"><i class="icon-right-open"></i>Contact</a></li>
																					<li><a href="page-contact-2.html"><i class="icon-right-open"></i>Contact 2</a></li>
																					<li><a href="page-coming-soon.html"><i class="icon-right-open"></i>Coming Soon Page</a></li>
																					<li><a href="page-404.html"><i class="icon-right-open"></i>404 error</a></li>
																					<li><a href="page-faq.html"><i class="icon-right-open"></i>FAQ page</a></li>
																					<li><a href="page-affix-sidebar.html"><i class="icon-right-open"></i>Sidebar - Affix Menu</a></li>
																				</ul>
																			</div>
																			<div class="col-sm-4">
																				<div class="divider"></div>
																				<ul class="menu">
																					<li><a href="page-left-sidebar.html"><i class="icon-right-open"></i>Left Sidebar</a></li>
																					<li><a href="page-right-sidebar.html"><i class="icon-right-open"></i>Right Sidebar</a></li>
																					<li><a href="page-two-sidebars.html"><i class="icon-right-open"></i>Two Sidebars</a></li>
																					<li><a href="page-no-sidebar.html"><i class="icon-right-open"></i>No Sidebars</a></li>
																					<li><a href="page-sitemap.html"><i class="icon-right-open"></i>Sitemap</a></li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
													</li>
													<!-- mega-menu end -->
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">私信</a>
														<ul class="dropdown-menu">
															<li><a href="features-typography.html">Typography</a></li>
															<li class="dropdown">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pricing tables</a>
																<ul class="dropdown-menu">
																	<li><a href="features-pricing-tables-1.html">Pricing Tables 1</a></li>
																	<li><a href="features-pricing-tables-2.html">Pricing Tables 2</a></li>
																	<li><a href="features-pricing-tables-3.html">Pricing Tables 3</a></li>
																</ul>
															</li>
															<li><a href="features-backgrounds.html">Backgrounds</a></li>											
															<li><a href="features-testimonials.html">Testimonials</a></li>
															<li class="dropdown">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown">Icons</a>
																<ul class="dropdown-menu">
																	<li><a href="features-icons-fontawesome.html">Font Awesome Icons</a></li>
																	<li><a href="features-icons-fontello.html">Fontello Icons</a></li>
																	<li><a href="features-icons-glyphicons.html">Glyphicons Icons</a></li>
																</ul>
															</li>
															<li class="dropdown">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown">Footer - Options</a>
																<ul class="dropdown-menu">
																	<li><a href="features-footer-1.html#footer">Footer 1 (Default)</a></li>
																	<li><a href="features-footer-2.html#footer">Footer 2</a></li>
																	<li><a href="features-footer-3.html#footer">Footer 3</a></li>
																	<li><a href="features-footer-4.html#footer">Footer 4</a></li>
																</ul>
															</li>
															<li class="dropdown">
																<a href="#" class="dropdown-toggle" data-toggle="dropdown">Header - Options</a>
																<ul class="dropdown-menu">
																	<li><a href="features-header-1.html">Header - Layout 1 (Default)</a></li>
																	<li><a href="features-header-2.html">Header - Layout 2</a></li>
																	<li><a href="features-header-3.html">Header - Layout 3</a></li>
																</ul>
															</li>
															<li><a href="features-grid.html">Grid System</a></li>
														</ul>
													</li>
													<!-- mega-menu start -->
													<li class="dropdown mega-menu">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">个人管理</a>
														<ul class="dropdown-menu">
															<li>
																<div class="row">
																	<div class="col-sm-4 col-md-6">
																		<h4>iDea - Powerful Bootstrap Theme</h4>
																		<p>iDea is a Clean and Super Flexible Bootstrap Theme with many Features and Unlimited options.</p>
																		<img src="images/section-image-1.png" alt="image-1">
																	</div>
																	<div class="col-sm-8 col-md-6">
																		<h4>Components</h4>
																		<div class="row">
																			<div class="col-sm-6">
																				<div class="divider"></div>
																				<ul class="menu">
																					<li><a href="components-tabs-and-pills.html"><i class="icon-right-open"></i>Tabs &amp; Pills</a></li>
																					<li><a href="components-accordions.html"><i class="icon-right-open"></i>Accordions</a></li>
																					<li><a href="components-social-icons.html"><i class="icon-right-open"></i>Social Icons</a></li>
																					<li><a href="components-buttons.html"><i class="icon-right-open"></i>Buttons</a></li>
																					<li><a href="components-forms.html"><i class="icon-right-open"></i>Forms</a></li>
																					<li><a href="components-progress-bars.html"><i class="icon-right-open"></i>Progress bars</a></li>
																					<li><a href="components-alerts-and-callouts.html"><i class="icon-right-open"></i>Alerts &amp; Callouts</a></li>
																					<li><a href="components-content-sliders.html"><i class="icon-right-open"></i>Content Sliders</a></li>
																				</ul>
																			</div>
																			<div class="col-sm-6">
																				<div class="divider"></div>
																				<ul class="menu">
																					<li><a href="components-lightbox.html"><i class="icon-right-open"></i>Lightbox</a></li>
																					<li><a href="components-icon-boxes.html"><i class="icon-right-open"></i>Icon Boxes</a></li>
																					<li><a href="components-image-boxes.html"><i class="icon-right-open"></i>Image Boxes</a></li>
																					<li><a href="components-video-and-audio.html"><i class="icon-right-open"></i>Video &amp; Audio</a></li>
																					<li><a href="components-modals.html"><i class="icon-right-open"></i>Modals</a></li>
																					<li><a href="components-animations.html"><i class="icon-right-open"></i>Animations</a></li>
																					<li><a href="components-counters.html"><i class="icon-right-open"></i>Counters</a></li>
																					<li><a href="components-tables.html"><i class="icon-right-open"></i>Tables</a></li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</li>
														</ul>
													</li>
													<!-- mega-menu end -->
													<li class="dropdown">
														<a href="portfolio-3col.html" class="dropdown-toggle" data-toggle="dropdown">Portfolio</a>
														<ul class="dropdown-menu">
															<li class="dropdown">
																<a href="portfolio-3col.html" class="dropdown-toggle" data-toggle="dropdown">Portfolio - Style 1</a>
																<ul class="dropdown-menu">
																	<li><a href="portfolio-2col.html">Portfolio - 2 columns</a></li>
																	<li><a href="portfolio-3col.html">Portfolio - 3 columns</a></li>
																	<li><a href="portfolio-4col.html">Portfolio - 4 columns</a></li>
																	<li><a href="portfolio-sidebar.html">Portfolio - With sidebar</a></li>
																</ul>
															</li>
															<li class="dropdown">
																<a href="portfolio-3col-2.html" class="dropdown-toggle" data-toggle="dropdown">Portfolio - Style 2</a>
																<ul class="dropdown-menu">
																	<li><a href="portfolio-2col-2.html">Portfolio - 2 columns</a></li>
																	<li><a href="portfolio-3col-2.html">Portfolio - 3 columns</a></li>
																	<li><a href="portfolio-4col-2.html">Portfolio - 4 columns</a></li>
																	<li><a href="portfolio-sidebar-2.html">Portfolio - With sidebar</a></li>
																</ul>
															</li>
															<li class="dropdown">
																<a href="portfolio-3col-3.html" class="dropdown-toggle" data-toggle="dropdown">Portfolio - Style 3</a>
																<ul class="dropdown-menu">
																	<li><a href="portfolio-2col-3.html">Portfolio - 2 columns</a></li>
																	<li><a href="portfolio-3col-3.html">Portfolio - 3 columns</a></li>
																	<li><a href="portfolio-4col-3.html">Portfolio - 4 columns</a></li>
																	<li><a href="portfolio-sidebar-3.html">Portfolio - With sidebar</a></li>
																</ul>
															</li>
															<li><a href="portfolio-full.html">Portfolio - Full width</a></li>
															<li><a href="portfolio-item.html">Portfolio single</a></li>
															<li><a href="portfolio-item-2.html">Portfolio single 2</a></li>
															<li><a href="portfolio-item-3.html">Portfolio single 3</a></li>
														</ul>
													</li>
													<li class="dropdown">
														<a href="shop-listing-3col.html" class="dropdown-toggle" data-toggle="dropdown">Shop</a>
														<ul class="dropdown-menu">
															<li><a href="shop-listing-3col.html">Shop - 3 Columns</a></li>
															<li><a href="shop-listing-4col.html">Shop - 4 Columns</a></li>
															<li><a href="shop-listing-sidebar.html">Shop - With Sidebar</a></li>
															<li><a href="shop-product.html">Product</a></li>
															<li><a href="shop-cart.html">Shopping Cart</a></li>
															<li><a href="shop-checkout.html">Checkout Page - Step 1</a></li>
															<li><a href="shop-checkout-payment.html">Checkout Page - Step 2</a></li>
															<li><a href="shop-checkout-review.html">Checkout Page - Step 3</a></li>
														</ul>
													</li>
													<li class="dropdown active">
														<a href="blog-right-sidebar.html" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
														<ul class="dropdown-menu">
															<li class="active"><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
															<li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
															<li><a href="blog-no-sidebar.html">Blog No Sidebars</a></li>
															<li><a href="blog-masonry.html">Blog Masonry</a></li>
															<li><a href="blog-masonry-sidebar.html">Blog Masonry - Sidebar</a></li>
															<li><a href="blog-timeline.html">Blog Timeline</a></li>
															<li><a href="blog-post.html">Blog post</a></li>
														</ul>
													</li>
												</ul>
											</div>

										</div>
									</nav>
									<!-- navbar end -->

								</div>
								<!-- main-navigation end -->

							</div>
							<!-- header-right end -->

						</div>
					</div>
				</div>
			</header>
			<!-- header end -->

			<!-- main-container start -->
			<!-- ================ -->
			<section class="main-container">

				<div class="container">
					<div class="row">

						<!-- main start -->
						<!-- ================ -->
						<div class="main col-md-8">
							
							<form role="form" id="dw_post" action="post.php" method="post" accept-charset="utf-8">
								<label>请输入要发布的微博内容</label>
								<textarea id="textarea_weibo" name="weibo_content" class="form-control" rows="3"></textarea>
								<button id="submit_weibo" type="submit" class="btn btn-default">发布</button>
							</form>
							<div class="separator-2"></div>
<?php
							
$count_weibo_index = 0;
//查询文章数量
$sql="";
if($islogin==True)
$sql = "
SELECT COUNT(WEIBO.WEIBOID) 
FROM WEIBO,FOLLOWS 
WHERE WEIBO.USERID='" . $userid . "' OR (FOLLOWS.USERID0='" . $userid . "' AND FOLLOWS.USERID1 = WEIBO.USERID) ;
";
else
$sql="
SELECT COUNT(WEIBO.WEIBOID) 
FROM WEIBO;
";

$r = mysqli_query($con,$sql);

while($row = mysqli_fetch_array( $r ) )
{
	$count_weibo_index = intval($row["COUNT(WEIBO.WEIBOID)"]);
}

//每页显示的文章数
$weibocount_peer_page = 10;
//计算微博的页数
$count_page= intval($count_weibo_index / $weibocount_peer_page);

if($count_weibo_index % $weibocount_peer_page >= 1)
	$count_page= $count_page + 1;

//设置页面的页面号，默认为第一页，即0
$page_num = 0;
if(!empty($_GET['page']))
{
	$page_num = intval($_GET['page']) - 1;
}

$weibo_startid=$page_num * $weibocount_peer_page;
$weibo_endid=$weibo_startid + $weibocount_peer_page;

//查找微博信息
if($islogin==True)
$sql = "
SELECT WEIBOID,WEIBO.USERID,USERNAME,CONTENT,TIME FROM WEIBO,FOLLOWS,USERINFO 
WHERE (WEIBO.USERID = '" . $userid . "'  OR (FOLLOWS.USERID0='" . $userid . "' AND FOLLOWS.USERID1 = WEIBO.USERID)) AND WEIBO.USERID = USERINFO.USERID
ORDER BY TIME DESC 
LIMIT ".$weibo_startid.",".$weibo_endid.";
";
else
$sql = "
SELECT WEIBOID,WEIBO.USERID,USERNAME,CONTENT,TIME FROM WEIBO,FOLLOWS,USERINFO 
ORDER BY TIME DESC 
LIMIT ".$weibo_startid.",".$weibo_endid.";
";

$r = mysqli_query($con,$sql);

$i_weibo=0;
while($i_weibo < $weibocount_peer_page && $row = mysqli_fetch_array( $r ) )
{
	$weibo_id = $row["WEIBOID"];
	$user_id = $row["USERID"];
	$user_name = $row["USERNAME"];
	$weibo_content = $row["CONTENT"];
	$weibo_time = $row["TIME"];
	
?>
							<div class="space-bottom"></div>
							<div class="well">
								<div class="testimonial clearfix">
									<div class="testimonial-image">
										<img src="images/testimonial-2.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle">
									</div>
									<div class="testimonial-body">
										<h4 class="title"><?php echo $user_name ?></h4>
										<h6>@<?php echo $user_id ?></h6>
										<h5><div class="testimonial-info-1"><?php echo $weibo_time ?></div></h5>
										<p><?php echo $weibo_content ?></p>
										
										<img src="images/logo_red.png">
										<i class="fa fa-heart-o pr-5"><a href="#"> 赞(2) </a></i>
										<!--<i class="fa fa-heart pr-5"><a href="#"> 取消赞(2) </a></i>-->
										<i class="fa fa-comments-o pr-5"><a href="#"> 评论(2) </a></i>
										<i class="fa fa-retweet pr-5"><a href="#"> 转发(2) </a></i>
										<i class="fa fa-envelope-o pr-5"><a href="#"> 私信 </a></i>
										<?php 
										if($user_id == $userid){
										?>
										<i class="fa fa-trash-o pr-5"><a href="post.php?action=delweibo&weibo_id=<?php echo $weibo_id ?>"> 删除 </a></i>
										<?php
										}
										?>
									</div>
								</div>
							</div>
							
<?php
$i_weibo ++;
} 

?>

							

							<!-- pagination start -->
<?php 
require 'includes/pagination.php';
?>
							<!-- pagination end -->

						</div>
						<!-- main end -->

						<!-- sidebar start -->
						<aside class="col-md-3 col-md-offset-1">
							<div class="sidebar">
								<?php
								if($islogin==True){
								?>
								<div class="block clearfix">
									<div class="col-md-12">
										<div class="testimonial clearfix">
											<img src="images/testimonial-1.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle">
											<div class="testimonial-body">
												<h2 class="title"><?php echo $username ?></h2>
												<div class="testimonial-info-1">@<?php echo $userid ?></div>
												<div class="testimonial-info-2">微博 <?php echo $count_weibo ?> 关注 <?php echo $count_following ?> 粉丝 <?php echo $count_follower ?></div>
												<hr>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								?>
								<div class="block clearfix">
									<form role="search">
										<div class="form-group has-feedback">
											<input type="text" class="form-control" placeholder="Search">
											<i class="fa fa-search form-control-feedback"></i>
										</div>
									</form>
								</div>
								
								<div class="block clearfix">
									<h3 class="title">当前热搜</h3>
									<div class="separator"></div>
									<nav>
										<ul class="nav nav-pills nav-stacked">
											<li><a href="#">#SoftwareDevelopment</a></li>
											<li><a href="#">#ArtificialItenlengence</a></li>
											<li><a href="#">#软件开发</a></li>
											<li><a href="#">#人工智能</a></li>
											<li><a href="#">#技术流</a></li>
											<?php for($i =0;$i<3;$i++)
											{
											?>
											<li><a href="#">#测试内容</a></li>
											<?php
											}
											?>
										</ul>
									</nav>
								</div>
								
								
								<div class="block clearfix">
									<!--<h3 class="title">广告位待售</h3>-->
									<div class="separator"></div>
									<p>Copyright © 2018.Open-MicroBlog All rights reserved.</p>
								</div>
								<div class="block clearfix">
									<h3 class="title">广告位待售</h3>
									<div class="separator"></div>
									<p>这里可用来作为广告展示，也可以用来显示关于信息</p>
								</div>
								
								
								
							</div>
						</aside>
						<!-- sidebar end -->

					</div>
				</div>
			</section>
			<!-- main-container end -->



		</div>
		<!-- page-wrapper end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster
		================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>

		<!-- Isotope javascript -->
		<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>

		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

		<!-- Appear javascript -->
		<script type="text/javascript" src="plugins/jquery.appear.js"></script>

		<!-- Count To javascript -->
		<script type="text/javascript" src="plugins/jquery.countTo.js"></script>

		<!-- Parallax javascript -->
		<script src="plugins/jquery.parallax-1.1.3.js"></script>

		<!-- Contact form -->
		<script src="plugins/jquery.validate.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/custom.js"></script>
		<script src="js/md5.js"></script>
		<script>
			function func_login()
			{
				var input_pswdbox = document.getElementById(\'pswdbox\')
				var passwd = input_pswdbox.value
				var passwd_md5 = MD5(passwd)
				input_pswdbox.value = passwd_md5
			}
		</script>
		
	</body>
</html>
<?php
mysqli_close($con);
?>