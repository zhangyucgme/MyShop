<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } ?><div class="ShopCartWrap"> <a href="<?php echo tpl_function_link(array('ctl' => "cart",'act' => "index"), $this);?>" class="cart-container">购物车中有<b class="cart-number"> <script>document.write(Cookie.get('S[CART_COUNT]')?Cookie.get('S[CART_COUNT]'):0);</script></b>件商品</a> </div> 