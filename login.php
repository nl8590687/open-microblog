<?php

require 'includes/sqlmng.php';

$weburl='weibo_ailemon_wang';

$uPwd='';
$username = "UserName";
$userid = "userid";

$islogin = False;

// 如果cookie存在，那么用户已经登陆，直接跳转
if (!empty($_COOKIE[$weburl.'_userid'])&&!empty($_COOKIE[$weburl.'_password']))
{
	$userid=$_COOKIE[$weburl.'_userid'];
	$uPwd=$_COOKIE[$weburl.'_password'];
	
	$islogin = True;
	//echo 'cookie 存在';
	//$uPwd=md5(uniqid($uPwd,true));
	echo'<script> location.replace (".") </script>'; 
	exit();
}
//echo 'cookie 不存在';



$con = mysqli_connect($sql_host,$sql_username,$sql_pswd);
if (!$con)
{
  die('Could not connect: ' . mysqli_error());
}
mysqli_set_charset($con, 'utf8');
//选取数据库 open_microblog
mysqli_select_db($con,"open_microblog");



//首先检查是否有POST登陆
if(!empty($_POST['uID'])&& !empty($_POST['uPwd']))
{
	$userid=$_POST['uID'];
	$uPwd=$_POST['uPwd'];
	//echo $uPwd.'\n';
	$uPwd=strtoupper($uPwd);
	$uPwd=md5('weibouser' . $uPwd . 'pwd');    //加盐
	
	//echo $uPwd;
	
	$sql = "
	SELECT * FROM USERINFO
	WHERE USERID = '" . $userid . "'
	;
	";
	$r = mysqli_query($con,$sql);
	
	if ($r)
	{
		//echo '成功';
	}
	else
	{
		//echo '失败';
	}
	
	//$rows=mysqli_affected_rows($conn);//获取行数  
	//$colums=mysqli_num_fields($res);//获取列数  
	
	$passwd='';
	while( $row = mysqli_fetch_array( $r ) )
	{
		$passwd = $row["PASSWORD"];
		//echo( "password: " .  $passwd);
		//echo( " - FIRST NAME: "  .$row["first_name"] . "<br>" );
		if(strtoupper($uPwd) == strtoupper($passwd))
		{
			//设置cookie
			
			setcookie($weburl.'_userid',$userid,time()+2*7*24*3600,'/');
			//setcookie($weburl.'_password',md5(uniqid($GLOBALS['uPwd'])),time()+2*7*24*3600,'/');
			//setcookie($weburl.'_password',$GLOBALS['uPwd'],time()+2*7*24*3600,'/');
			setcookie($weburl.'_password',strtoupper($uPwd),time()+2*7*24*3600,'/');
			//echo'<script> alert("您已登陆，欢迎您!"); location.replace (".") </script>'; 
			//exit();
			echo'<script> location.replace (".") </script>'; 
			exit();
			//echo '登陆成功！';
		}
		else
		{
			//echo '<script> alert("1   '.$uPwd.'"); </script>';
			//echo '<script> alert("2   '.$uPwd_tmp.'") </script>';
			echo '<script> alert("密码错误 !"); location.replace (".") </script>';  
			//echo '密码错误 !\n';
			//echo $uPwd . '\n';
			//echo $passwd . '\n';
			exit();
		}
	}
	
	//$islogin = False;

	//检查用户是否存在  
	if($passwd == '')
	{   
		echo '<script> alert("用户不存在 !"); location.replace (".") </script>';  
		$islogin = False;
		exit();    
	}
	else
	{
		$islogin = True;
	}
}

mysqli_close($con);

?>