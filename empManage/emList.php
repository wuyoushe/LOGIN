<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>雇员信息列表</title>
</head>

<?php
//1,$pageNow 显示第几页
//2,$pageCount 共有几页
//3,$rowCount 共有多少记录，这个数据从数据库获取
//4，$pageSize 每页显示多少条记录
$conn=mysql_connect("localhost","root","qwe2721080") or die(mysql_error());
mysql_query("set name utf8");
mysql_select_db("manage",$conn);
$pageSize=2;
$rowCount=0;
$pageNow=3;//这是一个变量用户定义

//判断是否有这个pageNow发送
if(!empty($_GET['pageNow'])){
	$pageNow=$_GET['pageNow'];
}
//这里需要根据用户的点击来修改$pageNow这个值
$pageCount=0;//这个表示有多少页是计算出来的

$sql="select count(id) from emp";
$res1=mysql_query($sql);
if($row=mysql_fetch_row($res1)){
	$rowCount=$row[0];}
	//ceil进1去整，计算有多少页
$pageCount=ceil($rowCount/$pageSize);	
//limit x,y;x表示从第几条取出，y表示取出多少条
$sql="select * from  emp limit ".($pageNow-1)*$pageSize.",$pageSize";/*算法记住*/

$res2=mysql_query($sql,$conn);

echo "<table border='1px'bordercolor='lightblue'cellspacing='0px'  width='700px'>";
echo "<tr><th>id</th> <th>name</th> <th>grade</th> <th>email</th> <th>salary</th> <th>删除用户</th> <th>修改用户</th><tr>";
while($row=mysql_fetch_assoc($res2)){
echo "<tr><td>{$row['id']}</td> <td>{$row['name']}</td> <td>{$row['grade']}</td> <td>{$row['email']}</td> <td>{$row['salary']}</td>"."
		<td><a href='#'>删除用户</a></td> <td><a href='#'>修改用户</a></td> </tr>";
}
echo "<h1>雇员信息类表</h1>";
echo "</table>";
//打印出页面的超链接
//for($i=1;$i<=$pageCount; $i++){
//	echo "<a href='empList.php?pageNow=$i'>$i</a>&nbsp";
	
//}
//分页关键点
if($pageNow>1){
	$PrePage=$pageNow-1;
	echo "<a href='emList.php?pageNow=$PrePage'>上一页</a>&nbsp;";
	}
if($pageNow<$pageCount){
		$nextPage=$pageNow+1;
		echo "<a href='emList.php?pageNow=$nextPage'>下一页</a>&nbsp;";	
	}
	//{}有间隔的作用
	echo "当前页{$pageNow}/共{$pageCount}页";
	echo "<br/><br/>";
	?>
	<form action="emList.php">
	跳转到:<input type="text" name="pageNow"/>
	<input type="submit" value="GO">
	</form>
	
	<?php
mysql_free_result($res2);
mysql_close($conn);
?>

</html>
