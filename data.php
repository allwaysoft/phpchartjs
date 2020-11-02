<?php
header('Content-Type: application/json');
 
$conn = mysqli_connect("localhost","phpsamples","phpsamples","phpsamples");
mysqli_query($conn, "set names utf8"); //**设置字符集*** 不设置插入数据库就是乱码
$sqlQuery = "SELECT student_id,student_name,marks FROM tbl_marks ORDER BY student_id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
//中文
?>