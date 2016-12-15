<?php
$id = $_REQUEST ['id'];
$password = $_REQUEST ['password'];
$conn=mysql_connect("localhost","root","qwe2721080");
if(!$conn){
	die("连接失败".mysql_error());
	
}
mysql_query("set names utf8",$conn) or die(mysql_error());
//选择数据库
mysql_select_db("manage",$conn) or die(mysql_error());
//发送sql语句验证
$sql="select password,name from admin where id=$id";
//通过输入的id来获取数据库的密码，然后和输入的密码对比
$res=mysql_query($sql,$conn);
//查询到
if($row=mysql_fetch_assoc($res)){
	//取出数据库的密码￥row['password']
	if($row['password']==md5($password)){
		$name=$row['name'];
		header ( "Location: empManage.php?name=$name" );
		exit ();
	}
}
	header ( "Location: login.php?errno=2" );
	exit ();
	mysql_free_result($res);
	mysql_close($conn);
	

/*if ($id == "100" && $password == "123") {
	header ( "Location: empManage.php" );
	exit ();
} else {
	header ( "Location: login.php" );
	exit();
}*/

?>