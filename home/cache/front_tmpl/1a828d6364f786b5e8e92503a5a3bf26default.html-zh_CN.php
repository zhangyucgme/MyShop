<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_modifier_styleset')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.styleset.php'); } if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); } if(!function_exists('tpl_modifier_cut')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.cut.php'); } ?><div class="RankingList"> <ul> <?php foreach ((array)$this->_vars['data'] as $this->_vars['key'] => $this->_vars['data1']){  if( $this->_vars['data1']['goods_id'] > 0 ){  if( $this->_vars['setting']['showPic']=="on" ){  if( $this->_vars['key'] == 0 ){ ?> <div class="pic" style="overflow:hidden;text-align:center;vertical-align: <?php if( $this->_env_vars['thumbnail_pic_width']>0 && $this->_env_vars['thumbnail_pic_height']>0 ){ ?>width:<?php echo $this->_env_vars['thumbnail_pic_width']; ?>px;height:<?php echo $this->_env_vars['thumbnail_pic_height']; ?>px;<?php } ?>><a href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['data1']['goods_id']), $this);?>" target="_blank" title="<?php echo $this->_vars['data1']['name']; ?>"> <a href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['data1']['goods_id']), $this);?>" target="_blank" title="<?php echo $this->_vars['data1']['name']; ?>" style="color:<?php echo $this->_vars['setting']['fontColor']; ?>;<?php echo tpl_modifier_styleset($this->_vars['setting']['fontStyle']); ?>"> <img src="<?php echo tpl_modifier_storager(((isset($this->_vars['data1']['thumbnail_pic']) && ''!==$this->_vars['data1']['thumbnail_pic'])?$this->_vars['data1']['thumbnail_pic']:$this->system->getConf('site.default_thumbnail_pic'))); ?>"> </a> </a></div> <?php }  }  if( $this->_vars['key'] <= $this->_vars['setting']['showing']-1 ){ ?> <li class="l<?php echo $this->_vars['key']+1; ?> dotsep hl" style="color:<?php echo $this->_vars['setting']['fontColor']; ?>;<?php echo $this->_vars['setting']['fontStyle']; ?>"><span><?php echo $this->_vars['key']+1; ?></span>&nbsp;<a href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['data1']['goods_id']), $this);?>" target="_blank" title="<?php echo $this->_vars['data1']['name']; ?>" style="color:<?php echo $this->_vars['setting']['fontColor']; ?>;<?php echo tpl_modifier_styleset($this->_vars['setting']['fontStyle']); ?>"><?php echo tpl_modifier_cut($this->_vars['data1']['name'],$this->_vars['setting']['maxlength']); ?></a></li> <?php }else{ ?> <li class="l<?php echo $this->_vars['key']+1; ?> dotsep" style="color:<?php echo $this->_vars['setting']['fontColor2']; ?>;<?php echo $this->_vars['setting']['fontStyle2']; ?>"><span><?php echo $this->_vars['key']+1; ?></span>&nbsp;<a href="<?php echo tpl_function_link(array('ctl' => "product",'act' => "index",'arg0' => $this->_vars['data1']['goods_id']), $this);?>" target="_blank" title="<?php echo $this->_vars['data1']['name']; ?>" style="color:<?php echo $this->_vars['setting']['fontColor2']; ?>;<?php echo tpl_modifier_styleset($this->_vars['setting']['fontStyle2']); ?>"> <?php echo tpl_modifier_cut($this->_vars['data1']['name'],$this->_vars['setting']['maxlength']); ?></a></li> <?php }  }  } ?> </ul> </div> <?php if( $this->_vars['setting']['showMore'] == "on" ){ ?> <div class="more clearfix"><a href="<?php echo $this->_vars['data']['link']; ?>">更多...</a></div> <?php } ?> 