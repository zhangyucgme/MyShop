<?php if(!function_exists('tpl_function_widgets')){ require(CORE_DIR.'/include_v5/smartyplugins/function.widgets.php'); } if(!function_exists('tpl_function_footer')){ require(CORE_DIR.'/include_v5/smartyplugins/function.footer.php'); } ?><div id="Foot"> <div class="AllWrap"> <div class="footArticle clearfix"> <div class="span-5"><?php echo tpl_function_widgets(array('id' => "footarticle1"), $this);?></div> <div class="span-6"><?php echo tpl_function_widgets(array('id' => "footarticle2"), $this);?></div> <div class="span-6"><?php echo tpl_function_widgets(array('id' => "footarticle3"), $this);?></div> <div class="span-6 last"><?php echo tpl_function_widgets(array('id' => "footarticle4"), $this);?></div> </div> <div class="footPicInfo clearfix"> <?php echo tpl_function_widgets(array('id' => "footpic"), $this);?> </div> <div class="footCopyright"> <?php echo tpl_function_widgets(array('id' => "footCopyright"), $this);?> </div> </div> <script type="text/javascript" src="<?php echo $this->_plugins['function']['respath'][0]->_respath(array('type' => "user",'name' => "purple"), $this);?>images/site.js"></script> <?php echo tpl_function_footer(array(), $this);?> </div> </body></html>