<?php if(!function_exists('tpl_modifier_storager')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.storager.php'); }  if( $this->_vars['gimage']['gimage_id']>0 ){ ?> <span <?php if( $this->_vars['goods']['image_default']==$this->_vars['gimage']['gimage_id'] ){ ?>class="current"<?php } ?> onclick="goodsEditor.pic.setDefault('<?php echo $this->_vars['gimage']['gimage_id']; ?>','<?php if( $this->_vars['gimage']['small'] ){  echo tpl_modifier_storager($this->_vars['gimage']['small']);  }else{ ?>index.php?ctl=goods/product&act=view_src_img&p[0]=<?php echo $this->_vars['gimage']['gimage_id'];  } ?>')"> <img sn="_img_<?php echo $this->_vars['gimage']['gimage_id']; ?>" src='images/loading.gif' lsrc='<?php if( $this->_vars['gimage']['thumbnail'] ){  echo tpl_modifier_storager($this->_vars['gimage']['thumbnail']);  }else{ ?>index.php?ctl=goods/product&act=view_src_img&p[0]=<?php echo $this->_vars['gimage']['gimage_id'];  } ?>' onload='chainImgLoader(this);'> </span> <input name="goods[image_file][]" value="<?php echo $this->_vars['gimage']['gimage_id']; ?>" soucre="<?php echo $this->_vars['gimage']['source']; ?>" bigPic="<?php echo $this->_vars['gimage']['big']; ?>" type="hidden"> <div class="gpic-btn-bar"> <?php $this->_vars[gimageid]=$this->_vars['gimage']['gimage_id']; ?> <span class="gpic-btn-view" onclick="goodsEditor.pic.viewSource('index.php?ctl=goods/product&act=viewGimages&gimage_id=<?php echo $this->_vars['gimageid']; ?>')" title="查看路径"><i>查看路径</i></span>|<span class="gpic-btn-delete" onclick="goodsEditor.pic.del(<?php echo $this->_vars['gimage']['gimage_id']; ?>,this)" title="删除图片"><i>删除图片</i></span> </div> <?php } ?> 