<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } ?><form method="post" action='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verify"), $this);?>' class='mini-loginbuyform' id='mini-loginbuyform'> <input type='hidden' name='from_minipassport' value=1 /> <div class="RegisterWrap"> <div class="form"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td colspan=2><h4>已注册用户，请登录</h4></td> <td class='row-span' rowspan='<?php if( $this->_vars['valideCode'] ){ ?>5<?php }else{ ?>4<?php } ?>'> <div class='span-auto' style='width:160px; text-align:left;'><h4 style="padding-top:0;">还不是会员?</h4></div><div class='span-auto close' style='width:25px'>X</div> <div class='clear'></div> <ul class="list fast-login"> <li><span>没有账号？</span><a href='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "signup"), $this);?>' class="actbtn btn-newregister">立即注册</a></li> <?php if( !$this->_vars['mustMember'] ){ ?> <li><span>您还可以...</span><a class="actbtn btn-buynow" href="<?php echo tpl_function_link(array('ctl' => cart,'act' => checkout), $this);?>" onclick="Cookie.set('S[ST_ShopEx-Anonymity-Buy]', 'true');$(this).getParent('.dialog').retrieve('chain',$empty)();return false;" >无需注册直接快读购买</a></li> <?php } ?> <ul> </td> </tr> <tr> <th><i>*</i>用户名：</th> <td><?php echo tpl_input_default(array('name' => "login",'class' => "inputstyle",'required' => "true",'id' => "in_login",'tabindex' => "1",'value' => $this->_vars['loginName']), $this);?><a style="margin-left:6px; " href="<?php echo tpl_function_link(array('ctl' => 'passport','act' => 'signup'), $this);?>">立即注册</a></td> </tr> <tr> <th><i>*</i>密码：</th> <td><?php echo tpl_input_default(array('name' => "passwd",'class' => "inputstyle",'type' => "password",'required' => "true",'id' => "in_passwd",'tabindex' => "2"), $this);?><a style="margin-left:6px;" href="<?php echo tpl_function_link(array('ctl' => 'passport','act' => 'lost'), $this);?>">忘记密码？</a></td> </tr> <?php if( $this->_vars['valideCode'] ){ ?> <tr> <th><i>*</i>验证码：</th> <td><?php echo tpl_input_default(array('size' => "8",'class' => "inputstyle",'type' => "digits",'required' => "true",'name' => "loginverifycode",'id' => "iptlogin",'tabindex' => "3"), $this);?> <span class='verifyCode' style='display:none;'><img src="#" border="1" codesrc='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode",'arg0' => "l"), $this);?>'/><a href="javascript:void(0)">&nbsp;看不清楚?换个图片</a> </span> </td> </tr> <?php } ?> <tr> <th></th> <td><input class="actbtn btn-login" type="submit" value="登录" tabindex="4" /> <div class="app-login-wrapper"><?php foreach ((array)$this->_vars['mini_login_content'] as $this->_vars['con']){ ?><div class="app-login-item"><?php echo $this->_vars['con']; ?></div><?php } ?></div> </td> </tr> </table> </div> </div> </form> <?php if( $this->_vars['valideCode'] ){ ?> <script>
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
   
   }('mini-loginbuyform');
</script> <?php } ?> 