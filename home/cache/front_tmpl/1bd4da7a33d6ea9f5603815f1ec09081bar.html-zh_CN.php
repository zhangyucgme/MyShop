<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } ?>您好<span id="uname_<?php echo $this->_vars['widgets_id']; ?>"><?php if( $_COOKIE['UNAME'] ){ ?>：<?php echo $_COOKIE['UNAME'];  } ?></span>！ <?php if( !$_COOKIE['MEMBER'] ){ ?> <span id="loginBar_<?php echo $this->_vars['widgets_id']; ?>"> <?php foreach ((array)$this->_vars['data']['login_content'] as $this->_vars['login']){  echo $this->_vars['login'];  } ?> <a href="<?php echo tpl_function_link(array('ctl' => passport,'act' => login), $this);?>">[请登录]</a>&nbsp;&nbsp; <?php if( $this->_vars['data']['open_id_open'] ){ ?> [<a class="trustlogin trust__login" href="javascript:void(0)">信任登录</a>]&nbsp;&nbsp; <div id="accountlogin" ><h5>您还可以使用以下帐号登录：</h5><div class="logoimg"><span><img src="statics/accountlogos/trustlogo1_small.gif" /></span><span><img src="statics/accountlogos/trustlogo2_small.gif" /></span><span><img src="statics/accountlogos/trustlogo3_small.gif" /></span><span><img src="statics/accountlogos/trustlogo4_small.gif" /></span><span><img src="statics/accountlogos/trustlogo5_small.gif" /></span></div><div class="more"><a href="#">更多»</a></div> </div> <?php } ?> <a href="<?php echo tpl_function_link(array('ctl' => passport,'act' => signup), $this);?>">[免费注册]</a> </span> <?php }else{ ?> <span id="memberBar_<?php echo $this->_vars['widgets_id']; ?>"> <a href="<?php echo tpl_function_link(array('ctl' => member,'act' => index), $this);?>">[会员中心]</a>&nbsp;&nbsp; <a href="<?php echo tpl_function_link(array('ctl' => passport,'act' => logout), $this);?>">[退出]</a> </span> <?php }  if( $this->_vars['data']['open_id_open'] && !$_COOKIE['MEMBER'] ){ ?> <style id='thridpartystyle'> .trustlogin { background:url(statics/icons/thridparty1.gif) no-repeat left; padding-left:18px; height:20px; line-height:20px; } #accountlogin{visibility:hidden;cursor:pointer;padding-top:0px; } </style> <script>
(function(){
    var loginBtn=$ES('.trust__login','loginBar_<?php echo $this->_vars['widgets_id']; ?>'),timer;
	$$(loginBtn,$('accountlogin')).addEvents({'mouseenter':function(){
			if(timer)$clear(timer);
			$('accountlogin').setStyles({'visibility':'visible','top':'20','left':'10'});
		},'mouseleave':function(){
			timer=function(){$('accountlogin').setStyle('visibility','hidden')}.delay(200);
		}
	});
	$('accountlogin').addEvent('click',function(e){loginBtn.fireEvent('click');})
})();
</script> <?php } ?> 