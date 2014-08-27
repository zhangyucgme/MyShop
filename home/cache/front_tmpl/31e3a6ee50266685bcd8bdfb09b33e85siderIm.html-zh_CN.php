<?php if(!function_exists('tpl_modifier_escape')){ require(CORE_DIR.'/include_v5/smartyplugins/modifier.escape.php'); } ?><style id="siderIMchatStyle"> #siderIMchat_widgets{ z-index:65535; position:absolute;<?php echo ((isset($this->_vars['setting']['alignselect']) && ''!==$this->_vars['setting']['alignselect'])?$this->_vars['setting']['alignselect']:'left'); ?>:0 ;} #siderIMchat_hiddenbar_widgets{ background:url(<?php echo $this->_vars['system_url']; ?>plugins/widgets/im/images/siderIM_hiddenBar.gif); width:26px; height:136px;} #siderIMchat_main_widgets{width:170px; display:none; margin:0 10px} #siderIMchat_main_widgets .top{ background:url(<?php echo $this->_vars['system_url']; ?>plugins/widgets/im/images/siderIM_title.gif); height:34px;} #siderIMchat_main_widgets .infobox{ text-align:center; background:#bdc5cb; background-image:url(<?php echo $this->_vars['system_url']; ?>plugins/widgets/im/images/siderIM_infobox.gif); background-repeat:no-repeat; padding:5px; line-height:14px; color:#000; font-weight:700;} #siderIMchat_main_widgets .bg{ background:url(<?php echo $this->_vars['system_url']; ?>plugins/widgets/im/images/siderIM_bg.gif); padding:5px;} #siderIMchat_main_widgets ul li{ float:left; margin-right:5px; margin-bottom:6px;} #siderIMchat_main_widgets .bottom{ margin-top:0px;background:url(<?php echo $this->_vars['system_url']; ?>plugins/widgets/im/images/siderIM_bottom.gif); background-repeat:no-repeat; height:9px; overflow:hidden; } </style> <div id="siderIMchat_widgets"> <div id="siderIMchat_hiddenbar_widgets"></div> <div id="siderIMchat_main_widgets"> <div class="top"></div> <div class="infobox"> <?php echo $this->_vars['setting']['titleexp']; ?> </div> <div class="bg "> <ul class="clearfix"> <?php foreach ((array)$this->_vars['data'] as $this->_vars['key'] => $this->_vars['data']){ ?> <li> <?php if( $this->_vars['data']['type']==1 ){ ?> <a target="_blank" href="tencent://message/?uin=<?php echo $this->_vars['data']['link']; ?>&&Site=LICENSE_ShopEx&&Menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=1:<?php echo $this->_vars['data']['link']; ?>:1"/><?php echo $this->_vars['setting']['plug']; ?></a><br /><?php echo $this->_vars['data']['info'];  }elseif( $this->_vars['data']['type']==2 ){ ?> <a href="msnim:chat?contact=<?php echo $this->_vars['data']['link']; ?>"><img width="30" height="30" border="0" src="http://im.live.com/Messenger/IM/Images/Icons/Messenger.Logo.gif"/><?php echo $this->_vars['setting']['plug']; ?></a><br /><?php echo $this->_vars['data']['info'];  }elseif( $this->_vars['data']['type']==3 ){ ?> <a target="_blank" href="http://amos1.taobao.com/msg.ww?v=2&uid=<?php echo tpl_modifier_escape($this->_vars['data']['link'],'url'); ?>&s=1"><img border="0" src="http://amos1.taobao.com/online.ww?v=2&uid=<?php echo tpl_modifier_escape($this->_vars['data']['link'],'url'); ?>&s=1"/><?php echo $this->_vars['setting']['plug']; ?></a><br /><?php echo $this->_vars['data']['info'];  }elseif( $this->_vars['data']['type']==4 ){ ?> <a target="_blank" href="http://scs1.sh1.china.alibaba.com/msg.atc?v=1&uid=<?php echo $this->_vars['data']['link']; ?>"><img border="0" src="http://scs1.sh1.china.alibaba.com/online.atc?v=1&uid=<?php echo $this->_vars['data']['link']; ?>&s=102"/><?php echo $this->_vars['setting']['plug']; ?></a><br /><?php echo $this->_vars['data']['info'];  }elseif( $this->_vars['data']['type']==5 ){ ?> <a href="callto://<?php echo $this->_vars['data']['link']; ?>"><img border="0" src="http://goodies.skype.com/graphics/skypeme_btn_small_green.gif"/><?php echo $this->_vars['setting']['plug']; ?></a><br /><?php echo $this->_vars['data']['info'];  } ?> </li> <?php } ?> </ul> <div class="textcenter pushdown-2"><span id="closeSiderIMchat_widgets" class="lnk">关闭在线客服</span></div> </div> <div class="bottom"></div> </div> </div> <script>
window.addEvent('domready', function() {			
	
    $('siderIMchatStyle').inject($E('link'), 'before');
	

   $('siderIMchat_hiddenbar_widgets').addEvent('mouseover',function(){
				         this.setStyle('display','none');
						 $('siderIMchat_main_widgets').setStyle('display','block')
				         });
	
   $('closeSiderIMchat_widgets').addEvent('click',function(){
				         $('siderIMchat_main_widgets').setStyle('display','none');
						 $('siderIMchat_hiddenbar_widgets').setStyle('display','block')
				         })	;			
	

	
siderIMchatWidgetsetGoTop();	
});

function siderIMchatWidgetsetGoTop(){
	$('siderIMchat_widgets').tween('top',$E('body').getScroll().y+100)
  }	
	  
window.addEvent('scroll',function(){	
	  siderIMchatWidgetsetGoTop();
	})	
</script>