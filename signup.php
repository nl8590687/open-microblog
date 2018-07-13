
<?php

$weburl='weibo_ailemon_wang';

$userid='';
$username='';
$uPwd='';

//首先检查是否有POST注册
if(!empty($_POST['userid'])&& !empty($_POST['passwd'])&& !empty($_POST['passwd2'])&& !empty($_POST['uSex'])&& !empty($_POST['username'])&& !empty($_POST['realname'])&& !empty($_POST['telnum'])&& !empty($_POST['email'])&& !empty($_POST['address']))
{
	//echo 'test page';
	
	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$uPwd = $_POST['passwd'];
	
	$uPwd=strtoupper($uPwd);
	//echo $uPwd;
	$uPwd=md5('weibouser' . $uPwd . 'pwd');    //加盐
	$uPwd=strtoupper($uPwd);
	//echo $uPwd;
	
	require 'includes/sqlmng.php';
	$con = mysqli_connect($sql_host,$sql_username,$sql_pswd);
	if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}
	mysqli_set_charset($con, 'utf8');
	//选取数据库 open_microblog
	mysqli_select_db($con,"open_microblog");
	
	//添加用户数据在userinfo:  user information
	$sql = "
	INSERT INTO USERINFO(USERID,USERNAME,PASSWORD) VALUES('" . $userid . "','" . $username . "','" . $uPwd . "');
	";
	$r = mysqli_query($con,$sql);
	
	if ($r)
	{
		//echo '注册成功';
		echo '<script> alert("注册成功 !"); location.replace (".") </script>'; 
		
		//设置cookie
		setcookie($weburl.'_userid',$userid,time()+2*7*24*3600,'/');
		setcookie($weburl.'_password',strtoupper($uPwd),time()+2*7*24*3600,'/');
	}
	else
	{
		//echo '失败';
		echo '<script> alert("注册失败 !"); location.replace ("signup.php") </script>';  
	}
	
	mysqli_close($con);
	
	exit;
}

?>

<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

	<head>
		<meta charset=\"utf-8\">
		<title>用户注册 | Open MicroBlog</title>
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
	<body id="signup">
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
														
													</li>
													<!-- mega-menu start -->
													<li class="dropdown mega-menu">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">通知</a>
														
													</li>
													<!-- mega-menu end -->
													<li class="dropdown">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">私信</a>
														
													</li>
													<!-- mega-menu start -->
													<li class="dropdown mega-menu">
														<a href="#" class="dropdown-toggle" data-toggle="dropdown">个人管理</a>
														
													</li>
													<!-- mega-menu end -->
													
													
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
							
							<form class="form-horizontal" role="form" action="signup.php" method="post" accept-charset="utf-8">
								<center><h1>新用户注册</h1></center>
								<div id = "alertbox" class="alert alert-danger" role="alert" style="visibility: hidden;" >
									您两次输入的<strong>密码不一致</strong> ，请再次检查。
								</div>
										
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">用户ID</label>
									<div class="col-sm-10">
										<input name="userid" type="text" class="form-control" id="inputUserID" placeholder="用户唯一标识，一经注册，不可修改">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">密码</label>
									<div class="col-sm-10">
										<input name="passwd" type="password" class="form-control" id="inputPassword" placeholder="Password" onblur="checkpswd()">
									</div>
								</div>
								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>
									<div class="col-sm-10">
										<input name="passwd2" type="password" class="form-control" id="inputPassword2" placeholder="Password" onblur="checkpswd()">
										
									</div>
									
								</div>
								
								<div class="separator-2"></div>
								<div class="form-group">
								
									<label for="inputEmail3" class="col-sm-2 control-label">性别</label>

									<div class="col-sm-10">
										<label for="radio-01" class="label_radio" id="genderbox" name="uGender">
										<input type="radio" id="genderbox0" name="uSex" value="male" checked> Male
										<input type="radio" id="genderbox1" name="uSex" value="female"> Female
										</label>
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
									<div class="col-sm-10">
										<input name="username" type="text" class="form-control" id="inputUsername" placeholder="用户名">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
										<input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">手机号</label>
									<div class="col-sm-10">
										<input name="telnum" type="text" class="form-control" id="inputPhoneNum" placeholder="手机号">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">真实姓名</label>
									<div class="col-sm-10">
										<input name="realname" type="text" class="form-control" id="inputRealName" placeholder="真实姓名">
									</div>
								</div>
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">地区</label>
									<div class="col-sm-10">
										<input name="address" type="text" class="form-control" id="inputAddress" placeholder="地区">
									</div>
								</div>
								<div class="separator-2"></div>
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<div class="checkbox">
											<label>
												<input type="checkbox" value="agree this condition" id="checkbox1" onclick="func_agree()"> <label for="checkbox1">我同意<a href="#">《服务条款和用户隐私策略》</a></label>
											</label>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button id="submit_signup" type="submit" class="btn btn-default" disabled="disabled" onclick="myfunction()">确认注册</button>
									</div>
								</div>
							</form>
							
							
							

							
							


							



						</div>
						<!-- main end -->

						

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
		
		<script type="text/javascript" src="js/md5.js"></script>
		<script language=javascript>
			
			function func_agree()
			{
				var submit_signup = document.getElementById('submit_signup')
				var checkbox1 = document.getElementById('checkbox1')
				if(checkbox1.checked)
				{
					submit_signup.disabled=""
				}
				else
				{
					submit_signup.disabled="disabled"
					
				}
			}
			
			function myfunction()
			{
				var input_pswdbox = document.getElementById('inputPassword')
				var input_pswdbox2 = document.getElementById('inputPassword2')
				var passwd = input_pswdbox.value
				var passwd2 = input_pswdbox2.value
				if(passwd == passwd2)
				{
					var passwd_md5 = MD5(passwd)
					input_pswdbox.value = passwd_md5
					input_pswdbox2.value = passwd_md5
				}
				else
				{
					input_pswdbox.value = ""
					input_pswdbox2.value = ""
				}
	
			}
			function checkpswd()
			{
				var input_pswdbox = document.getElementById('inputPassword')
				var input_pswdbox2 = document.getElementById('inputPassword2')
				var alertbox = document.getElementById('alertbox')
				
				var passwd = input_pswdbox.value
				var passwd2 = input_pswdbox2.value
				if(passwd != passwd2)
				{
					
					alertbox.style="visibility: visible;"
				}
				else
				{
					alertbox.style="visibility: hidden;"
				}
			}
		</script>
	</body>
</html>
