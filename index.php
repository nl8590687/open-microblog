
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
													<button type="button" class="btn btn-group btn-default btn-sm" onclick="location.replace ('signup.php')">Sing Up</button>
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
										<!--<ul class="dropdown-menu dropdown-menu-right dropdown-animation cart">
											<li>
												
												<div class="panel-body text-right">	
												
												<a href="logout.php" class="btn btn-group btn-default btn-sm">注销登录</a>
												</div>
											</li>
										</ul>-->
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
													<li class="active">
														<a href="." class="dropdown-toggle">主页</a>
														
													</li>
													<?php
													if($islogin==True){
													?>
													<!-- menu start -->
													<li>
														<a href="" class="dropdown-toggle">通知</a>
														
													</li>
													<!-- menu end -->
													<li>
														<a href="" class="dropdown-toggle">私信</a>
														
													</li>
													<!-- menu start -->
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">个人管理</a>
														<ul class="dropdown-menu">
															<div class="col-sm-8 col-md-6">
															<h4><?php echo $username ?></h4>
															<h6>@<?php echo $userid ?></h6>
															<div class="divider"></div>
															</div>
															
															<!--<li class="active"><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>-->
															<li><a href="">我的主页</a></li>
															<li><a href="">个人资料</a></li>
															<li><a href="">我的关注</a></li>
															<li><a href="">我的粉丝</a></li>
															<li><a href="">个人设置</a></li>
															<li><a href="logout.php">注销登录</a></li>
															
														</ul>
													</li>
													<!-- menu end -->
													<?php
													}
													?>
													
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
if($islogin==True AND False)
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
if($islogin==True AND False)
$sql = "
SELECT WEIBOID,WEIBO.USERID,USERNAME,CONTENT,TIME FROM WEIBO,FOLLOWS,USERINFO 
WHERE (WEIBO.USERID = '" . $userid . "'  OR (FOLLOWS.USERID0='" . $userid . "' AND FOLLOWS.USERID1 = WEIBO.USERID)) AND WEIBO.USERID = USERINFO.USERID
ORDER BY TIME DESC 
LIMIT ".$weibo_startid.",".$weibo_endid.";
";
else
$sql = "
SELECT WEIBOID,WEIBO.USERID,USERNAME,CONTENT,TIME FROM WEIBO,FOLLOWS,USERINFO 
WHERE WEIBO.USERID=USERINFO.USERID
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
										
										<!--<img src="images/logo_red.png">-->
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
										<form role="form" id="dw_post" action="post.php?action=comment&weibo_id=<?php echo $weibo_id ?>&response_id=0" method="post" accept-charset="utf-8">
											<textarea id="textarea_comment" name="weibo_comment" class="form-control" rows="1"></textarea>
											<button id="submit_comment" type="submit" class="btn btn-default">评论</button>
										</form>
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
				var input_pswdbox = document.getElementById('pswdbox')
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