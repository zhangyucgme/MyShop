<?php if(!function_exists('tpl_function_widgets')){ require(CORE_DIR.'/include_v5/smartyplugins/function.widgets.php'); }  echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'."block/header.html")?('user:'.$this->theme.'/'."block/header.html"):('shop:'."block/header.html"), array());?> <div class="AllWrapInside clearfix"> <div class="mainColumn pageMain"><?php echo tpl_function_widgets(array('id' => "nav"), $this); echo $this->_fetch_compile_include($this->template_exists('user:'.$this->theme.'/view/'.$this->_vars['_MAIN_'])?'user:'.$this->theme.'/view/'.$this->_vars['_MAIN_']:'shop:'.$this->_vars['_MAIN_'], array());?> </div> <div class="sideColumn pageSide"> <?php echo tpl_function_widgets(array('id' => "sideritems"), $this);?> </div> </div> <?php echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'."block/footer.html")?('user:'.$this->theme.'/'."block/footer.html"):('shop:'."block/footer.html"), array());?>