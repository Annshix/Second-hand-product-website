<?php session_start();?>

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


	<!-- banner -->
	<div id = "banner-support">
		<div id = "bannerleft" class = "floatleft bannerhanddler">
			<a href="#" id = "abannerleft"><img src="images/banner/Slice1.png"></a>
		</div>
		<img src="images/demo1/1.jpg" class = "floatleft" name = "banner" id = "bannerimage">
		<div id = "bannerright" class = "floatleft bannerhanddler"><a href="#" id = "abannerright"><img src="images/banner/Slice2.png"></a></div>
		<div class ="clear"></div>
	</div>
	<div class = "content"> 
		<div class = "content-tables floatleft" style="height :580px">
			<div class = "content-table recommend"> 
				<div class = "table_header">
					<a href="#" class = "table_header_first floatleft"></a>
					<div class = "header_tabs floatleft">
						<a href="product_list.php">最新商品</a>
						<!--<span>|</span>
						<a href="#">二手货</a>
						<span>|</span>
						<a href="#">社区</a>
						<span>|</span>-->
						<!--<a href="#"></a>
						<span>|</span>-->
					</div>
					<div class = "clear"></div>
				</div>
				

				<div class = "table-list-cover">
					<div id="list">
    					<ul></ul>
    				</div>
   					<div id="pagecount"></div>
				</div>


			</div>
		</div>




		<div class = "content-productlists floatleft" style="height: 680px;">	
		<div class = "right-login-area">
			<?PHP if(isset($_SESSION['username']) ){?>
			<div class="the-return">
				<h2>你好， <?php echo $_SESSION['username'];?>！</h2>
					<form action='logout.php'>
					<input id = "logoutbuttone" type="submit" class="btn btn-primary" value='登出'></input>
					</form>					
			</div>
				<?PHP }else{ ?>
				<p id = "logintext" class = "beforelogin">还没登陆，快登陆吧</p>
				<button id = "loginbuttone" type="button" class="btn btn-primary beforelogin">登陆</button>
				<p id = "logintext" class = "beforelogin">还没注册？你OUT啦！</p>
				<form action='regist.php'>
					<input id = "registbutton" type="submit" class="btn btn-primary beforelogin" value='注册'></input>
				</form>
				<form class = "login-form "  method = "post" >
					<div class="form-group">
						<input name = "userid" type = "text" class="form-control" id="InputUserid" placeholder="学号" >
					</div>
					<div class="form-group">
						<input name = "password" type="password" class="form-control" id="InputPassword" placeholder="密码">
					</div>  						
					<input id='loginbuttontwo' class="btn btn-default "type="submit" value = "登入"> </input>
					<span id = "loginhint"></span>		
				</form>
				<div class = "the-return"></div>	
					<?php }						?>
				</div>
				<div class = "right-recommend-notice">
					<h2>公告栏</h2>							
					<P> &nbsp&nbsp&nbsp&nbsp本网站由孙世超、施璇制作！</p>

				</div>
			</div>
			<div class = "clear"></div>
		</div>
		<div class = "footer"> 
			<ul>
				<li><p >Copyright © 孙世超 、施璇.</p> 
					<p>All Rights Reserved</p></li>
								
			</ul>
		</div>
	</div>

	<script type="text/javascript" src = "assets/js/support.js"></script>
	
	<script type="text/javascript" src = "assets/js/page.js"></script>


</body>
</html>
