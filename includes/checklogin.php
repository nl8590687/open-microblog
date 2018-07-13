<?php


$weburl='weibo_ailemon_wang';

$userid='userid';
$uPwd='';

$islogin = False;

// 如果cookie存在，那么用户已经登陆，直接跳转
if (!empty($_COOKIE[$weburl.'_userid'])&&!empty($_COOKIE[$weburl.'_password']))
{
	$userid=$_COOKIE[$weburl.'_userid'];
	$uPwd=$_COOKIE[$weburl.'_password'];
	
	$islogin = True;
}


?>