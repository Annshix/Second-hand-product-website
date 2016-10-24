<?php 

		
			$product_in_cart = array();
			foreach ($_SESSION['cart'] as $key => $value) {
				$sql = "select product_name, cost, photo from product where product_id='$key'";
				$result = mysqli_query($connection, $sql);
				if(mysqli_num_rows($result)>0){
					if($db_field = mysqli_fetch_assoc($result)){
						$product_in_cart['product'][] = array(
							'product_name' => $db_field['product_name'],
							'product_id' => $key,
							'cost' =>$db_field['cost'],
							'photo' => $db_field['photo']
							);
					}
					
				}
			}

?>