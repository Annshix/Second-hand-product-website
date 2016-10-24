$(document).ready(function() {

			// banner swap function
			var bannerId = 1;
			var setTime = setInterval(function(){
				if(bannerId<=5){
					changeImage(bannerId);
					// changeBannerBg(bannerId);
					bannerId= bannerId+1;
				}else{
					bannerId=1;
				}
			},10000);

			// left right link-- banner
			$(".bannerhanddler").click(function(event) {
				event.preventDefault();
			});

			$("#abannerleft").click(function(event) {

				var currentBannerId = getCurrentId();

				if(currentBannerId >1){
					currentBannerId = currentBannerId-1;
					changeImage(currentBannerId);
				}
			});

			$("#abannerright").click(function(event) {
				var currentBannerId = getCurrentId();
				if(currentBannerId < 5){
					currentBannerId = currentBannerId + 1;
					changeImage(currentBannerId);
				}
			});

		
			$("#loginbuttone").click(function(event) {
				$(".beforelogin").hide('fast', function() {
				});
				if($('.login-form').css('display') == 'none'){ 
   				$('.login-form').show('slow'); 
				} else { 
  				 $('.login-form').hide('fast'); 
				}
			});
		});





		$("#loginbuttontwo").click(function(event) {
			event.preventDefault();
			var formUserid = $('#InputUserid').val();
			var password = $('#InputPassword').val();
			if(formUserid == '' || password == ''){
				$(".the-return").html("慢慢来，先输入！")
			}
			else{
				$.ajax({ url: "login_process.php", 
						dataType:'json',//坑爹的bug!!!!
						type: "POST", //坑坑坑！！！！
						data:  {
							"userid": formUserid, 
							"password": password }, 
						
						success: function( data, textStatus, jQxhr ){ 
							if(data["matchCheck"] =='NotMatch'){
								$("#loginhint").html('失败了，再试一次！');
							}else{
								$('.login-form').hide('fast');
								$('.the-return').append('<h2>你好！' + data["username"]+'</h2>').append("<form action='logout.php'><input id = 'logoutbuttone' type='submit' class='btn btn-primary' value='登出'></input></form>	");
								// $("#logined").append('Welcome back, ' +  data['username']);
							}
							 
						 }, 
						error: function( jqXhr, textStatus, errorThrown ){
							$("#loginhint").html('请再试一次！');
						} 
				});
			}
		});
		function changeBannerBg(id){
			var bg_src = "images/banner/banner_bg_" +bg_src + ".jpg";
			 $("#banner-support").css('background-image', bg_src);
		}


		function changeImage(i){
			var srcString = "images/demo1/"+ i+".jpg";
			$("#bannerimage").attr('src', srcString);
		}

		function getCurrentId(){
			var currentBannerSrc = $("#bannerimage")[0]['src'];
			var currentBannerId = currentBannerSrc.charAt(currentBannerSrc.length -5);
			return parseInt(currentBannerId);
		}
