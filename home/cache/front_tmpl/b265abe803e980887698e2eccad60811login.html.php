<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" dir="ltr"> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> <title>ShopEx网上商店系统</title> <link rel="shortcut icon" href="../favicon.gif" type="image/gif" /> <link href="images/png.css" rel="stylesheet" type="text/css" /> <link href="images/login.css" rel="stylesheet" type="text/css" /> </head> <body> <div class="content"> <h1 class="png">欢迎使用ShopEx网上商店系统</h1> <?php if( $this->_vars['authstate'] ){ ?> <div class="button"><div class="<?php if( $this->_vars['authtype']=='commercial' ){ ?>authorize<?php }else{ ?>noauthorize<?php } ?>"><?php echo $this->_vars['authstate']; ?></div></div> <?php }  if( $this->_vars['message'] ){ ?> <div class="message"> <?php echo $this->_vars['message']; ?>&nbsp; </div> <?php } ?> <div class="body"> <form name="form1" action="index.php?ctl=passport&act=dologin" method="post" class="formstyle"> <?php if( $this->_vars['return'] ){ ?> <input type="hidden" name="return" value="<?php echo $this->_vars['return']; ?>" /> <?php } ?> <ul> <li> <input id="usrname" type="text" name="usrname" class="inputstyle" maxlength="50" autocomplete="off" value="<?php echo ((isset($this->_vars['username']) && ''!==$this->_vars['username'])?$this->_vars['username']:'请输入用户名'); ?>" onfocus="if(this.value=='请输入用户名') this.value='';this.className='inputstylefocus';return true;" onblur="if(this.value=='') this.value='请输入用户名';this.className='inputstyle';return true;" > </li> <li> <input id="password" type="password" name="passwd" class="inputstyle" maxlength="20" value="+_-_-_+" onfocus="if(this.value=='+_-_-_+') this.value='';this.className='inputstylefocus';return true;" onblur="if(this.value=='') this.value='+_-_-_+';this.className='inputstyle';return true;" > </li> <li style="position:relative"> <?php if( $this->_vars['show_varycode'] ){ ?> <input class="inputstyle" autocomplete="off" size=8 name="verifycode" id="verifycode" value="请输入验证码" onfocus="if(this.value=='请输入验证码') this.value=''; this.className='inputstylefocus';return true;" onblur="if(this.value=='') this.value='请输入验证码'; this.className='inputstyle';return true;" > &nbsp; <img src="index.php?ctl=passport&act=verifycode&<?php echo time(); ?>" align="top" class="verifycodeimg"></li> <?php } ?> 记住用户名：<input type="checkbox" name="save_login_name" checked> <li class="btn png"> <input name="login" type="submit" class="loginbtn" value=" " onmousedown="this.className='loginbtnfocus';return true;" > </li> </ul> </form> </div> <div class="foot"></div> </div> </body> </html>