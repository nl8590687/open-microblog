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
`WEIBOID` INT(10) NOT NULL,                   -- article id
`CID` INT(10) NOT NULL,      -- comment id   AUTO_INCREMENT 
`CORR_ID` INT(10) NOT NULL,                 -- the corresponding reply comment id
`USERID` VARCHAR(30) NOT NULL,
`CONTENT` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
`TIME` DATETIME NOT NULL,
CONSTRAINT CO_CONS PRIMARY KEY(WEIBOID,CID),
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





//创建存储过程 ADD_ARTIINFO
$sql = "
CREATE PROCEDURE ADD_ARTIINFO(
IN TITLE VARCHAR(30),
IN ID INT(10),
IN CATEGORY VARCHAR(10),
IN CONTENT TEXT) COMMENT ' 向文章表中添加信息 '
begin
INSERT INTO ARTIINFO(TITLE,ID,CATEGORY,CONTENT,TIME)
VALUES(TITLE,ID,CATEGORY,CONTENT,NOW());
end;
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


//创建存储过程 ADD_COMMENT
$sql = "
CREATE PROCEDURE ADD_COMMENT(
IN AID INT(10),
IN CID INT(10),
IN CORR_ID INT(10),
IN ID INT(10),
IN CONTENT TEXT) COMMENT ' 向评价表中添加信息 '
begin
INSERT INTO COMMINFO
VALUES(AID,CID,CORR_ID,ID,CONTENT,NOW());
end;
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
INSERT INTO USERINFO(USERID,USERNAME,PASSWORD) VALUES('admin','admin_weibo','3FB302986B41040D67332E52F26919F1');
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
INSERT INTO COMMENTS VALUES('1','1','0','admin','Comment Test',NOW());
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


?>