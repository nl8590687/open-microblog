<?php

require 'includes/checklogin.php';

if($islogin==True){
	
	$content=''; // 存储微博内容
	
	require 'includes/sqlmng.php';
	$con = mysqli_connect($sql_host,$sql_username,$sql_pswd);
	mysqli_set_charset($con, 'utf8');
	if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}
	//选取数据库 open_microblog
	mysqli_select_db($con,"open_microblog");
	
	if(empty($_GET["action"])|| $_GET["action"] == 'new')
	{
		$weibo_content='';
		if(empty($_POST['weibo_content']))
		{
			echo'<script> location.replace (".") </script>'; 
			exit();
		}
		$weibo_content = $_POST['weibo_content'];
		//发布微博
		$sql = "
		INSERT INTO WEIBO(USERID,CONTENT,TIME) VALUES('" . $userid . "','" . $weibo_content . "',NOW());
		";
		$r = mysqli_query($con,$sql);
		
		if ($r)
		{
			//echo '发布成功';
			echo '<script> alert("发布成功 !"); location.replace (".") </script>'; 
		}
		else
		{
			//echo '发布失败';
			echo '<script> alert("发布失败 !"); location.replace (".") </script>';  
		}
	}
	else if($_GET["action"] == 'comment')
	{
		//评论微博
		$weibo_comment='';
		$weibo_id='';
		if(empty($_POST['weibo_comment']) || empty($_POST['weibo_id'])|| empty($_POST['response_id']))
		{
			echo'<script> location.replace (".") </script>'; 
			exit();
		}
		$weibo_comment = $_POST['weibo_comment'];
		$weibo_id = $_POST['weibo_id'];
		$response_id = $_POST['response_id'];
		//发布微博
		$sql = "
		INSERT INTO COMMENTS(WEIBOID,CORR_ID,USERID,CONTENT,TIME) VALUES('" . $weibo_id . "','" . $response_id . "','" . $userid . "','" . $weibo_comment . "',NOW());
		";
		$r = mysqli_query($con,$sql);
		
		if ($r)
		{
			//echo '评论成功';
			echo '<script> alert("评论成功 !"); location.replace (".") </script>'; 
		}
		else
		{
			//echo '评论失败';
			echo '<script> alert("评论失败 !"); location.replace (".") </script>';  
		}
	}
	else if($_GET["action"] == 'delweibo')
	{
		//删除微博
		$weibo_id='';
		if(empty($_GET['weibo_id']))
		{
			echo'<script> location.replace (".") </script>'; 
			exit();
		}
		$weibo_id = $_GET['weibo_id'];
		
		$sql = "
		DELETE FROM COMMENTS WHERE WEIBOID=" . $weibo_id . ";
		";
		$r = mysqli_query($con,$sql);
		
		$sql = "
		DELETE FROM WEIBO WHERE WEIBOID=" . $weibo_id . ";
		";
		$r = mysqli_query($con,$sql);
		
		if ($r)
		{
			//echo '删除成功';
			echo '<script> alert("删除成功 !"); location.replace (".") </script>'; 
		}
		else
		{
			//echo '评论失败';
			echo '<script> alert("删除失败 !"); location.replace (".") </script>';  
		}
		
	}
	else if($_GET["action"] == 'delcomm')
	{
		//删除评论
		$response_id = '';
		if(empty($_POST['response_id']))
		{
			echo'<script> location.replace (".") </script>'; 
			exit();
		}
		$response_id = $_POST['response_id'];
		$sql = "
		DELETE FROM COMMENTS WHERE CID='" . $response_id . "';
		";
		$r = mysqli_query($con,$sql);
		
		if ($r)
		{
			//echo '删除成功';
			echo '<script> alert("删除成功 !"); location.replace (".") </script>'; 
		}
		else
		{
			//echo '评论失败';
			echo '<script> alert("删除失败 !"); location.replace (".") </script>';  
		}
	}
}
else
{
	echo'<script> alert("请登录后再进行操作！"); location.replace (".") </script>'; 
	exit();
}

?>