<?php
require 'includes/sqlmng.php';
$con = mysqli_connect($host,$username,$pswd);
mysqli_set_charset($con, 'utf8');
if (!$con)
{
  die('Could not connect: ' . mysqli_error());
}

if (mysqli_query($con,"CREATE DATABASE open_microblog;"))
{
  echo "Database created";
}
else
{
  echo "Error creating database: " . mysqli_error();
}

//选取数据库 open_microblog
mysqli_select_db($con,"open_microblog");



//创建数据表 userinfo:  user information
$sql = "
CREATE TABLE USERINFO(
`USERID` VARCHAR(30) NOT NULL PRIMARY KEY,
`USERNAME` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`PASSWORD` VARCHAR(32) NOT NULL
);
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}


//创建数据表 WEIBO:  WEIBO information
$sql = "
CREATE TABLE WEIBO(
`WEIBOID` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
`USERID` VARCHAR(30), -- author id
`CONTENT` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`TIME` DATETIME NOT NULL,
CONSTRAINT ID_CONS FOREIGN KEY (USERID) REFERENCES USERINFO(USERID)
);
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}


//创建数据表 COMMENTS:  COMMENTS information
$sql = "
CREATE TABLE COMMENTS(
`CID` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,      -- comment id   AUTO_INCREMENT 
`WEIBOID` INT(10) NOT NULL,                   -- article id
`CORR_ID` INT(10) NOT NULL,                 -- the corresponding reply comment id
`USERID` VARCHAR(30) NOT NULL,
`CONTENT` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`TIME` DATETIME NOT NULL,
-- CONSTRAINT CO_CONS PRIMARY KEY(WEIBOID,CID),
CONSTRAINT AID_CONS FOREIGN KEY (WEIBOID) REFERENCES WEIBO(WEIBOID),
CONSTRAINT ID2_CONS FOREIGN KEY (USERID) REFERENCES USERINFO(USERID)
);
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}


//创建数据表 FOLLOWS:  FOLLOWS information
$sql = "
CREATE TABLE FOLLOWS(
`USERID0` VARCHAR(30) NOT NULL,
`USERID1` VARCHAR(30) NOT NULL,
CONSTRAINT ID_CONS0 FOREIGN KEY (USERID0) REFERENCES USERINFO(USERID),
CONSTRAINT ID_CONS1 FOREIGN KEY (USERID1) REFERENCES USERINFO(USERID)
);
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}

//创建数据表 LIKES:  LIKES information
$sql = "
CREATE TABLE LIKES(
`USERID` VARCHAR(30) NOT NULL,
`WEIBOID` INT(10) NOT NULL,
CONSTRAINT ID_USER FOREIGN KEY (USERID) REFERENCES USERINFO(USERID),
CONSTRAINT ID_WEIBO FOREIGN KEY (WEIBOID) REFERENCES WEIBO(WEIBOID)
);
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}


// **************** 数据库信息初始化部分 ********************

//添加一个初始用户，管理员 初始密码12345
$sql = "
INSERT INTO USERINFO(USERID,USERNAME,PASSWORD) VALUES('admin','admin_weibo','A3BB16EBE1F003DC414C4F37B74AF755');
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}

//添加一个初始的微博内容
$sql = "
INSERT INTO WEIBO(USERID,CONTENT,TIME) VALUES('admin','Weibo Test',NOW());
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}

//添加一个初始的用户评论
$sql = "
INSERT INTO COMMENTS(WEIBOID,CORR_ID,USERID,CONTENT,TIME) VALUES('1','0','admin','comment test',NOW());
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}

//添加一个初始的用户关注
$sql = "
INSERT INTO FOLLOWS VALUES ('admin','admin');
";
$r = mysqli_query($con,$sql);
if ($r)
{
	echo '成功';
}
else
{
	echo '失败';
}


mysqli_close($con);

echo '<script> alert("网站安装完毕 !"); location.replace (".") </script>'; 

?>