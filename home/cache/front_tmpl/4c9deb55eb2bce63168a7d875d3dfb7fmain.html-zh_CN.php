<?php if(!function_exists('tpl_function_javascript')){ require(CORE_DIR.'/include_v5/smartyplugins/function.javascript.php'); } if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } ?><script >

window.addEvent("domready",function() {

  $$(".MemberMenuList span")[0].setStyle("border-top","none");

  $$(".MemberMenu span div").each(function(item,index) {

    //item.setStyle("background-image","url(statics/icons/member" + index + "_grey.gif)");

  });


$$(".MemberMenuList").each(function(item,index) {

  item.addEvents({

    mouseenter:function() { 
      this.getElement('span').addClass('hover');
      $$(".MemberMenuList ul")[index].setStyle("background","#f2f2f2");
    },
    mouseleave:function() {
      this.getElement('span').removeClass('hover');
      $$(".MemberMenuList ul")[index].setStyle("background","#fff");
    }
  });

});

$$(".memberlist tr").each(function(item,index) {

  if(index>0&&index%2==0) { item.setStyle("background","#f7f7f7");}

});

/*$$(".memberlist .intro").each(function(item,index) {
  new Tips(item, {
    className: 'memberlist-tip'
  });
    item.store('tip:text',"<img src='http://www.shopex.cn/images/xxxlogo01.gif' />");
  
});*/

});

</script> <?php echo tpl_function_javascript(array('file' => 'formplus.js'), $this);?> <style> body { font-size:12px; font-family:Arial, Helvetica, sans-serif;} </style> <div style="margin:auto; width:950px;"> <div class="MemberCenter"> <div class="siteparttitle"> <?php if( $this->_vars['sex'] == 1 ){ ?> <div class="gender"></div> <?php }else{ ?> <div class="female"></div> <?php } ?> <div class="info"> <strong>您好：<?php echo $this->_vars['member']['uname']; ?></strong>&nbsp;&nbsp;[<a class="lnk" href="<?php echo tpl_function_link(array('ctl' => member), $this);?>">会员中心</a>]&nbsp;&nbsp;[<a class="lnk" href="<?php echo tpl_function_link(array('ctl' => passport,'act' => logout), $this);?>">退出</a>] </div> <div class="time"></div> <div style="clear:both;"></div> </div> <div class="MemberSidebar"> <div class="MemberMenu"> <div class="title"></div> <div class="body"> <ul> <?php foreach ((array)$this->_vars['cpmenu'] as $this->_vars['menus']){ ?> <li class="MemberMenuList"><span><div class="m_<?php echo $this->_vars['menus']['mid']; ?>" style="font-size:14px;"><?php echo $this->_vars['menus']['label']; ?></div></span> <ul> <?php foreach ((array)$this->_vars['menus']['items'] as $this->_vars['items']){ ?> <li <?php if( $this->_vars['current'] == $this->_vars['items']['link'] ){ ?> class="current"<?php } ?>><a href="<?php echo tpl_function_link(array('ctl' => "member",'act' => $this->_vars['items']['link']), $this);?>" target="<?php echo ((isset($this->_vars['items']['target']) && ''!==$this->_vars['items']['target'])?$this->_vars['items']['target']:"_self"); ?>"><?php if( $this->_vars['items']['label']=='我的订单' ){ ?><b><?php }  echo $this->_vars['items']['label'];  if( $this->_vars['items']['label']=='我的订单' ){ ?></b><?php } ?></a></li> <?php } ?> </ul> </li> <?php } ?> </ul> </div> <div class="foot"></div> </div> </div> <?php echo $this->_fetch_compile_include($this->_get_resource('user:'.$this->theme.'/'.$this->_vars['_PAGE_'])?('user:'.$this->theme.'/'.$this->_vars['_PAGE_']):('shop:'.$this->_vars['_PAGE_']), array());?> <div class="clear"></div> </div> </div> <div style="display:none;"> <div class="memberlist-tip"> <div class="tip"> <div class="tip-title"></div> <div class="tip-text"></div> </div> </div> </div> 