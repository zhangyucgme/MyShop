<?php if(!function_exists('tpl_input_object')){ require(CORE_DIR.'/admin/smartyplugin/input.object.php'); } ?><h3>相关商品</h3> <?php echo tpl_input_object(array('multiple' => "true",'rowselect' => "true",'value' => $this->_vars['goods']['glink']['items'],'name' => "linkid",'view' => "product/detail/rel_items.html",'key' => null,'object' => 'goods/products'), $this);?>