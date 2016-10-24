<?php
include_once('connect.php');

$page = intval($_POST['pageNum']);

$result = mysql_query("select product_id from product");
$total = mysql_num_rows($result);//总记录数

$pageSize = 6; //每页显示数
$totalPage = ceil($total/$pageSize); //总页数

$startPage = $page*$pageSize;
$arr['total'] = $total;
$arr['pageSize'] = $pageSize;
$arr['totalPage'] = $totalPage;
$query = mysql_query("select product_id,product_name,photo from product order by product_id desc limit $startPage,$pageSize");
while($row=mysql_fetch_array($query)){
	 $arr['list'][] = array(
	 	'product_id' => $row['product_id'],
		'product_name' => $row['product_name'],
		'photo' => $row['photo'],
	 );
}
//print_r($arr);
echo json_encode($arr);
?>