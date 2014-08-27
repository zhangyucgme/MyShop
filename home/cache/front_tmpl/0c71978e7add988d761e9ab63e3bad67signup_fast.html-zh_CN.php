<?php if(!function_exists('tpl_function_link')){ require(CORE_DIR.'/include_v5/smartyplugins/function.link.php'); } if(!function_exists('tpl_input_default')){ require(CORE_DIR.'/include_v5/smartyplugins/input.default.php'); } ?><form method="post" action='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "create"), $this);?>' class='mini-signupform' id='mini-signupform'> <input type='hidden' name='from_minipassport' value=1 /> <div class="RegisterWrap"> <iframe id="iframemask" style="position:absolute;top:0;left:0;" frameborder="0" ></iframe> <div class="form" style="display:block; position:relative"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td colspan=2> <h4>用户注册</h4> <i>{register_message}</i> </td> <td class='row-span' rowspan='<?php if( $this->_vars['valideCode'] ){ ?>8<?php }else{ ?>7<?php } ?>'> <div class='span-auto' style='width:160px'>&nbsp;</div><div class='span-auto close' style='width:25px'>X</div> <div class='clear'></div><br /><br /><br /><br /><br /> 已有账号？现在<a href='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "login"), $this);?>' class='lnk'>登陆</a></div> <?php foreach ((array)$this->_vars['regist_content'] as $this->_vars['con']){  echo $this->_vars['con'];  } ?> </td> </tr> <tr> <th><i>*</i>用户名：</th> <td><?php echo tpl_input_default(array('class' => "inputstyle",'name' => "uname",'required' => "true",'id' => "reg_user",'maxlength' => "50",'onchange' => "nameCheck(this)"), $this);?><span></span></td> </tr> <tr> <th><i>*</i>密码：</th> <td><?php echo tpl_input_default(array('class' => "inputstyle",'name' => "passwd",'type' => "password",'required' => "true",'id' => "reg_passwd"), $this);?></td> </tr> <tr> <th><i>*</i>确认密码：</th> <td><?php echo tpl_input_default(array('class' => "inputstyle",'name' => "passwd_r",'type' => "password",'required' => "true",'id' => "reg_passwd_r"), $this);?></td> </tr> <tr> <th><i>*</i>电子邮箱：</th> <td><?php echo tpl_input_default(array('class' => "inputstyle",'name' => "email",'type' => "email",'required' => "true",'id' => "reg_email",'maxlength' => "200"), $this);?></td> </tr> <?php if( $this->_vars['valideCode'] ){ ?> <tr> <th><i>*</i>验证码：</th> <td><?php echo tpl_input_default(array('size' => "8",'class' => "inputstyle",'type' => "digits",'required' => "true",'name' => "signupverifycode",'id' => "iptsingup"), $this);?> <span class='verifyCode' style='display:none;'><img src="#" border="1" codesrc='<?php echo tpl_function_link(array('ctl' => "passport",'act' => "verifyCode",'arg0' => "s"), $this);?>'/><a href="javascript:void(0)">&nbsp;看不清楚?换个图片</a> </span> </td> </tr> <?php } ?> <tr> <th></th> <td><label for="license" class="nof" style="width:auto; text-align:left; font-weight:normal;"> <input type="checkbox" id="license" name="license" value="agree" checked="checked"/> 我已阅读并同意 <a href="<?php echo tpl_function_link(array('ctl' => page,'act' => license), $this);?>" id="terms_error" class="lnk" target='_blank'><span class="FormText" id="terms_error_sym">会员注册协议</span></a>和<a href="<?php echo tpl_function_link(array('ctl' => page,'act' => privacy), $this);?>" id="privacy_error" class="lnk" target='_blank'><span class="FormText" id="privacy_error_sym">隐私保护政策</span></a>。 </label></td> </tr> <tr> <th></th> <td> <input class="actbtn btn-register" type="submit" value="注册新用户" /> </td> </tr> </table> </div> </div> <?php if( $this->_vars['to_buy'] ){ ?><input type='hidden' name='regType' value='buy'> <?php }  if( $this->_vars['isfastbuy'] ){ ?><input type='hidden' name='isfastbuy' value='yes'><?php } ?> </form> <script>


window.addEvent('domready',function() {
$('iframemask').width= $('mini-signupform').getCoordinates().width;
$('iframemask').height= $('mini-signupform').getCoordinates().height;

});
<?php if( $this->_vars['valideCode'] ){ ?>

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
   
   }('mini-signupform');

<?php } ?>
function nameCheck(input){
  new Request.HTML({update:$(input).getNext(),data:'name='+encodeURIComponent(input.value=input.value.trim())}).post('<?php echo tpl_function_link(array('ctl' => passport,'act' => namecheck), $this);?>');
}
</script> 