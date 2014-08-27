<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } ?><form method="post" action='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verify"), $this);?>' class='loginform'> <input type="hidden" name="isfastbuy" value="<?php echo $_POST['isfastbuy']; ?>"> <?php if( $this->_vars['mini'] ){ ?> <input type='hidden' name='from_minipassport' value=1 /><?php } ?> <div class="RegisterWrap" style="width:420px; float:left; padding:5px;"> <h4 style="float:left;">已注册用户，请登录</h4> <?php if( $this->_vars['openid_open'] ){  }else{  if( $this->_vars['mini'] ){ ?> <div class="dialog-title clearfix" style="float:right; display:block; border-bottom:none;"><div class='dialog-close-btn close' id='dialog__close'>X</div></div> <?php }  } ?> <div style="clear:both;"></div> <div class="intro" ><div class="customMessages">{login_message}</div></div> <?php if( $this->_vars['err_msg'] != '' ){ ?> <div class="error"><?php echo $this->_vars['err_msg']; ?></div> <?php } ?> <div id="formlogin" class="form"> <input name="forward" type="hidden" value="<?php echo $this->_vars['options']['url']; ?>"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <th><i>*</i>用户名：</th> <td><?php echo tpl_input_default(array('name' => "login",'class' => "inputstyle",'required' => "true",'id' => "in_login",'tabindex' => "1",'value' => $this->_vars['loginName']), $this);?><a style="margin-left:6px; " href="<?php echo tpl_function_link(array('ctl' => 'passport','act' => 'signup'), $this);?>">立即注册</a></td> </tr> <tr> <th><i>*</i>密码：</th> <td><?php echo tpl_input_default(array('name' => "passwd",'class' => "inputstyle",'type' => "password",'required' => "true",'id' => "in_passwd",'tabindex' => "2"), $this);?><a style="margin-left:6px;" href="<?php echo tpl_function_link(array('ctl' => 'passport','act' => 'lost'), $this);?>">忘记密码？</a></td> </tr> <?php if( $this->_vars['LogInvalideCode'] ){ ?> <tr> <th><i>*</i>验证码：</th> <td><?php echo tpl_input_default(array('size' => "8",'class' => "inputstyle",'type' => "digits",'required' => "true",'name' => "loginverifycode",'id' => "iptlogin",'tabindex' => "3"), $this);?> <span class='verifyCode' style='display:none;'><img src="#" codesrc='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode",'arg0' => "l"), $this);?>' border="1" /><a href="javascript:void(0)">&nbsp;看不清楚?换个图片</a> </span> </td> </tr> <?php } ?> <tr> <th></th> <td><input class="actbtn btn-login" type="submit" value="登录" tabindex="4" /> <input type="hidden" name="forward" value="<?php echo $this->_vars['forward']; ?>"> </td> </tr> </table> <?php echo $this->_vars['redirectInfo']; ?> </div> <input type='hidden' name='ref_url' value='<?php echo $this->_vars['ref_url']; ?>'/> </div> <?php if( $this->_vars['openid_open'] ){ ?> <div class="RegisterWrap" style="width:420px; float:left; padding:5px;"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td><h4 class="thridpartyicon">信任登录</h4> </td> <td><?php if( $this->_vars['mini'] ){ ?> <div class="dialog-title clearfix" style="float:right; display:block; border-bottom:none;"><div class='dialog-close-btn close'>X</div></div> <?php } ?></td> </tr> </table> <div class="intro"> <div class="customMessages">您还可以使用以下帐号登录：</div> </div> <div id="formthridlogin" class="form"> <ul class="trustlogos"> <li><img src="statics/accountlogos/trustlogo1.gif"/></li> <li><img src="statics/accountlogos/trustlogo2.gif"/></li> <li><img src="statics/accountlogos/trustlogo3.gif"/></li> <li><img src="statics/accountlogos/trustlogo4.gif"/></li> <li><img src="statics/accountlogos/trustlogo5.gif"/></li> </ul> <div class="more"><a href="#">更多»</a></div> <center><input type="button" tabindex="4" value="登录" class="actbtn btn-login trust__login"></center> </div> </div> <?php } ?> <div class="clearfix"></div> </form> <?php foreach ((array)$this->_vars['login_content'] as $this->_vars['no']){  echo $this->_vars['no'];  } ?> <script>
window.addEvent('domready',function() {
	<?php if( $this->_vars['openid_open'] ){ ?> if(RemoteLogin){RemoteLogin.init();}<?php } ?>

	if(!$('iframemask'))return;
$('iframemask').width= $('mini-loginform').getCoordinates().width;
$('iframemask').height= $('mini-loginform').getCoordinates().height;
	
 

});

<?php if( $this->_vars['LogInvalideCode'] ){ ?>
   void function(formclz){
         var vcodeBox = $E('.'+formclz+' .verifyCode');
         var vcodeImg  =vcodeBox.getElement('img');
         var refreshVcodeBtn  = vcodeBox.getElement('a').addEvent('click',function(e){
              e.stop();
              vcodeImg.src = vcodeImg.get('codesrc')+'?'+$time();
         });
         $$('.'+formclz+' input').addEvent('focus',function(){
             if (this.form.retrieve('showvcode',false))return;
             vcodeBox.show();
             refreshVcodeBtn.fireEvent('click',{stop:$empty});
             this.form.store('showvcode',true);
         });
   
   }('loginform');
<?php } ?>
</script> 