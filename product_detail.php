<?php session_start(); 
header("content-type:text/html;charset=utf-8");?>
<!DOCTYPE HTML>
<html>
	<head>	

	
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
  	<meta content="utf-8" http-equiv="encoding">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/support.css">
	<link rel="stylesheet" type="text/css" href="assets/css/support_destop.css">

	<script type="text/javascript" src = "assets/js/jquery.min.js"></script>
	<script type="text/javascript" src = "assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src = "assets/js/bootbox.min.js"></script>




	</head>

	
	
	

	<body >
<!-- header -->
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
			<p id = "wlc_header">Welcome, <?php 
			if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
				echo  $_SESSION['username'];
			}else{
				echo "Guest";
			}?>
			</p>
		</div>

		<div class = "product_detail">
			<?php 
			include("connect_database.php"); 
			$id=$_GET['product_id'];
			if($db_found){
				$sql = "select cost,time,place,description,userid,product_name,photo from product where product_id = '$id'";
				$result = mysqli_query($connection, $sql);
				if(mysqli_num_rows($result) > 0){
					$return = array();
					while($db_field = mysqli_fetch_assoc($result)){
						$userid = $db_field['userid'];
						$product_name = $db_field['product_name'];
						$des = $db_field['description'];	
						$cost = $db_field['cost'];
						$time = $db_field['time'];
						$place=$db_field['place'];
						$photo=$db_field['photo'];
					}
					$sql2 = "select username,phone from common_user where userid ='$userid'";
					$result2 = mysqli_query($connection, $sql2);
					$db_field2=  mysqli_fetch_assoc($result2);
					$username = $db_field2['username'];
					$phone=$db_field2['phone'];
				}					
			}
			?>

			<div class = "img_div floatleft">
				<img src="<?php echo $photo; ?>" > 
				
			</div>
			<div class = "ly_div floatright" style="height:480px">
				<img  class = "floatleft" src="images/arrow.png" id = "arrow">
				<h4 class = "floatleft"><?php echo $product_name;?></h4>
				<div class = "clear"></div>
				<h4>价格： <?php echo $cost;?></a> 元</h4>
				<h4>描述： <?php echo $des;?></a> </h4>
				<h4>发布者： <?php echo $username;?></a> </h4>
				<h4>地点： <?php echo $place;?></a> </h4>
				<h4>时间： <?php echo $time;?></a> </h4>
				<h4>手机： <?php echo $phone;?></a> </h4>
				<h1> </h1>
				<h1> </h1>
				<h1> </h1>
				<?PHP if(isset($_SESSION['username']) && !empty($_SESSION['username'])){?>
				<form action = "#" method = "post" id = "addForm" >
					<input  type = "hidden"   name = "product_id" value="<?php echo $id ?>" id = "hidden_product_id"/>
        				<input type="submit" id = "addToChart" class = "floatleft  addToChart_play btn btn-primary"  value = "加入购物车" /> 
        				
      				
   					</form><?php }else{ ?>
   					<form action = "#" method = "post" id = "addForm2" >
						<input  type = "hidden"   name = "product_id" value="<?php echo $id ?>" id = "hidden_product_id"/>

        				<button  id = "addToChart_ses_button" class = "  addToChart_play btn btn-primary" style="margin-left: 50px;" >加入购物车</button>
        				      				
   					</form>
   					<?php } ?>
   					
   					<div class = "clear">
				</div>
				<div class = "clear"></div>
			</div>
		</div>
	</div>
		<div class = "footer"> 
			<ul>
				<li><p >Copyright © 孙世超 、施璇.</p> 
					<p>All Rights Reserved</p></li>
								
			</ul>
		</div>



		
		<script type="text/javascript" src = "assets/js/support.js">
		</script>

		<script type="text/javascript">
		var pro_id = $("#hidden_product_id").val();
		

		
		$("#addToChart").click(function(event) {
			event.preventDefault();
			$.ajax({ url: 'addToChart_session.php', 
					dataType:'json',
					type: 'post', 
					data:  { product_id: pro_id} , 
					
					success: function( data, textStatus, jQxhr ){ 
						bootbox.alert("添加成功！");	
						console.log(data);				 
					 }, 
					error: function( jqXhr, textStatus, errorThrown ){ 
						console.log(errorThrown);
					} 
				});
		});

		$("#addToChart_ses_button").click(function(event) {
			event.preventDefault();
			$.ajax({
				url: "addToChart_session.php",
				dataType:'json',
				data:  { product_id: pro_id},
				type: 'POST', 
				success: function(data){
					console.log(data);
					bootbox.dialog({
						message: "添加成功！",
						
						buttons: {
							success: {
								label: "继续购物",
								className: "btn-primary",
								callback: function() {
									
								}
							},
							main: {
								label: "登入",
								className: "btn-primary",
								callback: function() {
									window.location.href='login.php';
								}
							}
						}
					});
				}, error: function(jqXhr, textStatus, errorThrown ){
					console.log(errorThrown);
				}
			});
		});
			
		</script>

	</body>
</html>
