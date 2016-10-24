<?php session_start();?>
<!DOCTYPE HTML>
<html>

<head>	

	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  	<meta content="utf-8" http-equiv="encoding">
	
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/uploadify.css" >
	<link rel="stylesheet" type="text/css" href="assets/css/support.css">
	<link rel="stylesheet" type="text/css" href="assets/css/support_destop.css">

	<script type="text/javascript" src = "assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "assets/js/jquery.uploadify.min.js"></script>
	<script type="text/javascript" src = "assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src = "assets/js/bootbox.min.js"></script>


</head>
<body >

	<!-- header -->
	<div id = "header-wrapper-support">  			
		<div class = "header-col-2 floatleft">
			<img id = "logo" src="images/logo.png">
		</div>
		<div class = "header-col-4 floatleft">
			<ul>
				<li><a href="index.php">主页</a></li>
				<li><a href="add_product.php">我要卖</a></li>
				<li><a href="product_list.php">我要买</a></li>
			</ul>

		</div>
		




		<div class = "header-col-2 floatleft">
			<input placeholder = "找找看" id = "search" type = "search">
		</div>
		<div class = "header-col-2 floatleft">
			<div class="dropdown">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					购物车
					<span class="caret"></span>
				</button>
				<!-- if there is something in shopping cart -->
	
				
				<ul class="dropdown-menu sc_dropdown" role="menu" aria-labelledby="dropdownMenu1">
					
					<?php 
					if(isset($_SESSION['cart'])){
					include("connect_database.php"); 
					include("sc_products_list.php");
					
					for ($i=0; $i < count($product_in_cart['product']); $i++) { ?>
						<li role = "presentati on" class = "li_down_list">
							<a class = "links_down_list floatcenter" href="product_detail.php?product_id=<?php echo $product_in_cart['product'][$i]['product_id'];?>"><?php echo $product_in_cart['product'][$i]['product_name']; ?></a>
							<img class = "redline_list" src="images/line_list.png">
							
						</li>
					<?php }	?>
				
				<!-- if there is nothing in shopping cart -->
					<?php } else { echo "<span class = 'empty_cart_span'>还没有东西，快去看看吧！<span>"; }?>
				</ul>
			</div>
		</div>
		<div class = "clear"></div>
		<!-- End of header -->
	</div>



<div class = "content">

		<div class = "welcome_title">
			<p id = "wlc_header">欢迎来到易书网！</p>

		</div>
		<form class = "product-form " id="product-form" method = "post" style="margin-left: 299px;margin-right: 299px;margin-top: 25px;">
					<div class="form-group">
						<input name = "name" type = "text" class="form-control" id="Inputname" placeholder="商品名" >
					</div>
					<div class="form-group">
						<input name = "cost" type="text" class="form-control" id="Inputcost" placeholder="价格">
					</div>
					<div class="form-group">
						<input name = "des" type = "text" class="form-control" id="Inputdes" placeholder="描述" >
					</div>
					<div class="form-group">
						<input name = "place" type = "text" class="form-control" id="Inputplace" placeholder="地点" >
					</div>
					
					<input type="submit" name = "submit" value= "提交" class="btn btn-default"  id = "submitbutton"> </input>	
		</form>
				
	<div class = "the-return"></div>	
</div>

    <div class = "footer"> 
			<ul>
				<li><p >Copyright © 孙世超 、施璇.</p> 
					<p>All Rights Reserved</p></li>
								
			</ul>
		</div>
	<script type="text/javascript">
        $("#submitbutton").click(function(event){
        	event.preventDefault();
        	var name = $('#Inputname').val();
        	var des = $('#Inputdes').val();
        	var cost = $('#Inputcost').val();
        	var place = $('#Inputplace').val();
        	if( name== ''||des == ''|| cost == ''||place==''){
        		$(".the-return").html("请填写完整信息！")
        	}
        	else{
	        	$.ajax({
	        			url:"add_product_process.php",
	                	dataType: 'json',
	                	type: "POST",
	                	data:  {
	                		"name": name,
	                		"des": des,
	                		"cost": cost,
	                		"place": place },
	                	success: function(data, textStatus, jQxhr ){
	                		
	                		if(!data["status"]){
	                			bootbox.dialog({
									message: "添加成功！",
									
									buttons: {
										success: {
											label: "继续添加",
											className: "btn-primary",
											callback: function() {
												window.location.href='add_product.php';
											}
										},
										main: {
											label: "返回首页",
											className: "btn-primary",
											callback: function() {
												window.location.href='index.php';
											}
										}
									}
								});
	                		}

	                		

	               		},
	               		error:function(jqXhr,testStatus,errorThrown){
	               			console.log("OK");
	               			console.log(errorThrown);
	               			console.log(testStatus);
	     				}
                });
	    	}
	});
	</script>
</body>
</html>
















